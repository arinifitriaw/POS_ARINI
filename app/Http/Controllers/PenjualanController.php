<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Penjualan;
use App\Models\ItemPenjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $user = Auth::user();
        $keyword = $request->input('search');

        $sales = Penjualan::query()
            ->with('user')
            ->when(
                $user->role && $user->role->name === 'kasir',
                function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                }
            )
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where(
                        'name',
                        'like',
                        '%' . $keyword . '%'
                    );
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('penjualan.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(SearchRequest $request)
    {
        $sale = Penjualan::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'status'  => 'OPEN'
            ],
            [
                'total_pembayaran'  => 0,
                'metode_pembayaran' => null
            ]
        );

        $keyword = $request->input('search');

        $products = Produk::when($keyword, function ($query) use ($keyword) {
            $query->where(
                'nama',
                'like',
                '%' . $keyword . '%'
            );
        })
        ->orderBy('nama')
        ->get();

        $mode = 'create';

        return view(
            'penjualan.pos',
            compact('sale', 'products', 'mode')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:produk,id',
            'quantity'   => 'required|integer|min:1'
        ]);

        try {
            DB::transaction(function () use ($request) {

                $sale = Penjualan::where(
                    'user_id',
                    Auth::id()
                )
                ->where(
                    'status',
                    'OPEN'
                )
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
                    $item->kuantitas += $request->quantity;
                } else {
                    $item = new ItemPenjualan([
                        'penjualan_id' => $sale->id,
                        'produk_id'    => $product->id,
                        'kuantitas'    => $request->quantity,
                        'harga_satuan' => $product->harga_jual,
                    ]);
                }

                $item->subtotal =
                    $item->kuantitas *
                    $item->harga_satuan;

                $item->save();

                // ==========================================
                // TOTAL SEMENTARA
                // ==========================================

                $sale->total_pembayaran =
                    $sale->itemPenjualan()
                        ->sum('subtotal');

                $sale->save();
            });
        } catch (\Exception $e) {
            return back()
                ->with('error', $e->getMessage());
        }

        return back()
            ->with(
                'success',
                'Produk berhasil ditambahkan'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjualan $penjualan)
    {
        $sale = $penjualan;

        $sale->load(
            'itemPenjualan.produk'
        );

        $products = Produk::orderBy('nama')->get();

        $mode = 'view';

        return view(
            'penjualan.detail',
            compact(
                'sale',
                'products',
                'mode'
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        $sale = $penjualan;

        abort_if(
            $sale->status === 'COMPLETED',
            403
        );

        $sale->load(
            'itemPenjualan.produk'
        );

        $products = Produk::orderBy('nama')->get();

        $mode = 'edit';

        return view(
            'penjualan.pos',
            compact(
                'sale',
                'products',
                'mode'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        Penjualan $penjualan
    ) {
        // ==========================================
        // VALIDASI DASAR
        // ==========================================

        $rules = [
            'payment_method' => 'required',
            'ukuran_baju'    => 'required|in:S,M,L,XL,XXL',
        ];

        // Uang dibayar hanya wajib jika CASH
        if ($request->payment_method === 'CASH') {
            $rules['uang_dibayar'] =
                'required|numeric|min:0';
        }

        $request->validate($rules);

        // ==========================================
        // CEK STATUS TRANSAKSI
        // ==========================================

        if ($penjualan->status !== 'OPEN') {
            return back()
                ->with(
                    'error',
                    'Transaksi sudah diproses'
                );
        }

        // ==========================================
        // CEK KERANJANG
        // ==========================================

        if ($penjualan->itemPenjualan()->count() === 0) {
            return back()
                ->with(
                    'error',
                    'Keranjang masih kosong'
                );
        }

        try {
            DB::transaction(function () use (
                $penjualan,
                $request
            ) {

                // ==========================================
                // CEK STOK SAAT CHECKOUT
                // ==========================================

                $items = $penjualan
                    ->itemPenjualan()
                    ->with('produk')
                    ->get();

                foreach ($items as $item) {

                    if (!$item->produk) {
                        throw new \Exception(
                            'Produk pada keranjang sudah tidak tersedia.'
                        );
                    }

                    $produk = Produk::lockForUpdate()
                        ->find($item->produk_id);

                    if (!$produk) {
                        throw new \Exception(
                            'Produk "' .
                            $item->produk->nama .
                            '" sudah tidak tersedia.'
                        );
                    }

                    // Stok sudah dikurangi ketika barang
                    // dimasukkan ke keranjang.
                    // Jadi di checkout TIDAK mengurangi stok lagi.

                    if ($produk->stok < 0) {
                        throw new \Exception(
                            'Stok produk "' .
                            $item->produk->nama .
                            '" tidak mencukupi.'
                        );
                    }
                }

                // ==========================================
                // HITUNG TOTAL BELANJA
                // ==========================================

                $totalBelanja =
                    $penjualan
                        ->itemPenjualan()
                        ->sum('subtotal');

                // ==========================================
                // HITUNG DISKON OTOMATIS
                // ==========================================
                //
                // Jika total belanja Rp1.000.000 atau lebih,
                // maka mendapatkan diskon 10%.
                //

                $diskon = 0;

                if ($totalBelanja >= 1000000) {
                    $diskon =
                        $totalBelanja * 10 / 100;
                }

                // ==========================================
                // TOTAL SETELAH DISKON
                // ==========================================

                $totalAkhir =
                    $totalBelanja - $diskon;

                // ==========================================
                // PEMBAYARAN CASH
                // ==========================================

                if ($request->payment_method === 'CASH') {

                    $uangDibayar =
                        (float) $request->uang_dibayar;

                    // Cek uang cukup berdasarkan
                    // TOTAL SETELAH DISKON
                    if ($uangDibayar < $totalAkhir) {
                        throw new \Exception(
                            'Uang yang dibayar kurang dari total pembayaran setelah diskon.'
                        );
                    }

                    // Hitung kembalian berdasarkan
                    // TOTAL SETELAH DISKON
                    $kembalian =
                        $uangDibayar - $totalAkhir;

                    // CASH langsung selesai
                    $status = 'COMPLETED';

                } else {

                    // ==========================================
                    // PEMBAYARAN QRIS
                    // ==========================================

                    $uangDibayar = null;
                    $kembalian = null;

                    // QRIS tetap OPEN
                    // sampai dikonfirmasi
                    $status = 'OPEN';
                }

                // ==========================================
                // SIMPAN TRANSAKSI
                // ==========================================

                // total_pembayaran sekarang menyimpan
                // TOTAL SETELAH DISKON.
                //
                // Tidak perlu kolom diskon di database.

                $penjualan->update([
                    'metode_pembayaran' => $request->payment_method,
                    'ukuran_baju'       => $request->ukuran_baju,
                    'total_pembayaran'  => $totalAkhir,
                    'uang_dibayar'      => $uangDibayar,
                    'kembalian'         => $kembalian,
                    'status'            => $status
                ]);
            });

        } catch (\Exception $e) {

            return back()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }

        // ==========================================
        // QRIS
        // ==========================================

        if ($request->payment_method === 'QRIS') {

            return redirect()
                ->route(
                    'penjualan.show',
                    $penjualan->id
                )
                ->with(
                    'success',
                    'Silakan lakukan pembayaran melalui QRIS.'
                );
        }

        // ==========================================
        // CASH
        // ==========================================

        return redirect()
            ->route('penjualan.index')
            ->with(
                'success',
                'Transaksi berhasil diselesaikan'
            );
    }

    /**
     * Konfirmasi pembayaran QRIS.
     */
    public function konfirmasiPembayaran(
        Penjualan $penjualan
    ) {
        if ($penjualan->status !== 'OPEN') {
            return back()
                ->with(
                    'error',
                    'Transaksi sudah selesai.'
                );
        }

        if ($penjualan->metode_pembayaran !== 'QRIS') {
            return back()
                ->with(
                    'error',
                    'Konfirmasi ini hanya untuk pembayaran QRIS.'
                );
        }

        if ($penjualan->itemPenjualan()->count() === 0) {
            return back()
                ->with(
                    'error',
                    'Keranjang masih kosong.'
                );
        }

        $penjualan->update([
            'status' => 'COMPLETED'
        ]);

        return redirect()
            ->route(
                'penjualan.show',
                $penjualan->id
            )
            ->with(
                'success',
                'Pembayaran QRIS berhasil dikonfirmasi. Transaksi selesai.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        $this->authorize(
            'delete',
            $penjualan
        );

        if ($penjualan->status !== 'OPEN') {
            return redirect()
                ->route('penjualan.index')
                ->with(
                    'error',
                    'Transaksi yang sudah selesai tidak bisa dibatalkan'
                );
        }

        DB::transaction(function () use ($penjualan) {

            foreach ($penjualan->itemPenjualan as $item) {

                if ($item->produk) {
                    $item->produk->increment(
                        'stok',
                        $item->kuantitas
                    );
                }
            }

            $penjualan->itemPenjualan()->delete();
            $penjualan->delete();
        });

        return redirect()
            ->route('penjualan.index')
            ->with(
                'success',
                'Transaksi berhasil dibatalkan'
            );
    }
}