<?php

namespace App\Http\Controllers;

use App\Models\ItemPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:produk,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        try {
            DB::transaction(function () use ($request) {

                $sale = Penjualan::where('user_id', Auth::id())
                    ->where('status', 'OPEN')
                    ->firstOrFail();

                $product = Produk::lockForUpdate()
                    ->findOrFail($request->product_id);

                // ==========================================
                // CEK STOK
                // ==========================================
                if ($product->stok < $request->quantity) {
                    throw new \Exception(
                        'Stok produk "' .
                        $product->nama .
                        '" tidak mencukupi. Stok tersedia: ' .
                        $product->stok .
                        ' unit.'
                    );
                }

                // ==========================================
                // KURANGI STOK
                // ==========================================
                $product->decrement(
                    'stok',
                    $request->quantity
                );

                // ==========================================
                // UPDATE / INSERT ITEM PENJUALAN
                // ==========================================
                $item = ItemPenjualan::where(
                    'penjualan_id',
                    $sale->id
                )
                ->where(
                    'produk_id',
                    $product->id
                )
                ->lockForUpdate()
                ->first();

                if ($item) {

                    // UPDATE
                    $item->kuantitas += $request->quantity;

                } else {

                    // CREATE
                    $item = new ItemPenjualan([
                        'penjualan_id' => $sale->id,
                        'produk_id'    => $product->id,
                        'kuantitas'    => $request->quantity,
                        'harga_satuan' => $product->harga_jual,
                    ]);
                }

                // ==========================================
                // HITUNG SUBTOTAL
                // ==========================================
                $item->subtotal =
                    $item->kuantitas * $item->harga_satuan;

                $item->save();

                // ==========================================
                // UPDATE TOTAL PEMBAYARAN
                // ==========================================
                $sale->total_pembayaran =
                    $sale->itemPenjualan()->sum('subtotal');

                $sale->save();
            });

        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }

        return back()
            ->with(
                'success',
                'Produk berhasil ditambahkan ke keranjang.'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        ItemPenjualan $itempenjualan
    ) {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        try {

            DB::transaction(function () use (
                $request,
                $itempenjualan
            ) {

                // ==========================================
                // AMBIL PRODUK DENGAN LOCK
                // ==========================================
                $produk = $itempenjualan
                    ->produk()
                    ->lockForUpdate()
                    ->first();

                if (!$produk) {
                    throw new \Exception(
                        'Produk tidak ditemukan.'
                    );
                }

                // ==========================================
                // HITUNG SELISIH QUANTITY
                // ==========================================
                $selisih =
                    $request->quantity -
                    $itempenjualan->kuantitas;

                // ==========================================
                // JIKA QTY BERTAMBAH
                // ==========================================
                if ($selisih > 0) {

                    if ($produk->stok < $selisih) {

                        throw new \Exception(
                            'Stok produk "' .
                            $produk->nama .
                            '" tidak mencukupi. ' .
                            'Stok tersedia: ' .
                            $produk->stok .
                            ' unit.'
                        );
                    }

                    // Kurangi stok sesuai tambahan qty
                    $produk->decrement(
                        'stok',
                        $selisih
                    );
                }

                // ==========================================
                // JIKA QTY BERKURANG
                // ==========================================
                if ($selisih < 0) {

                    // Kembalikan stok
                    $produk->increment(
                        'stok',
                        abs($selisih)
                    );
                }

                // ==========================================
                // UPDATE ITEM
                // ==========================================
                $itempenjualan->update([
                    'kuantitas' => $request->quantity,
                    'subtotal' =>
                        $request->quantity *
                        $itempenjualan->harga_satuan
                ]);

                // ==========================================
                // UPDATE TOTAL PENJUALAN
                // ==========================================
                $itempenjualan->penjualan->update([
                    'total_pembayaran' =>
                        $itempenjualan
                            ->penjualan
                            ->itemPenjualan()
                            ->sum('subtotal')
                ]);
            });

        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }

        return back()
            ->with(
                'success',
                'Jumlah produk berhasil diperbarui.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemPenjualan $itempenjualan)
    {
        $this->authorize('delete', $itempenjualan);

        try {

            DB::transaction(function () use ($itempenjualan) {

                $produk = $itempenjualan->produk;
                $sale = $itempenjualan->penjualan;

                // ==========================================
                // KEMBALIKAN STOK
                // ==========================================
                if ($produk) {
                    $produk->increment(
                        'stok',
                        $itempenjualan->kuantitas
                    );
                }

                // ==========================================
                // HAPUS ITEM
                // ==========================================
                $itempenjualan->delete();

                // ==========================================
                // UPDATE TOTAL PENJUALAN
                // ==========================================
                $sale->update([
                    'total_pembayaran' =>
                        $sale
                            ->itemPenjualan()
                            ->sum('subtotal')
                ]);
            });

        } catch (\Exception $e) {

            return back()
                ->with('error', $e->getMessage());
        }

        return back()
            ->with(
                'success',
                'Produk berhasil dihapus dari keranjang.'
            );
    }
}