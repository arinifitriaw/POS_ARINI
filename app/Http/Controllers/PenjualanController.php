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
            // 🔧 Load relasi user untuk cegah N+1 Query & error null
            ->with('user')
            // Filter berdasarkan role
            ->when($user->role && $user->role->name === 'kasir', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            // Search nama user kasir
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
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
        $query->where('nama', 'like', '%' . $keyword . '%');
        })
        ->orderBy('nama')
        ->get();
    
        $mode = 'create';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:produks,id',
            'quantity'   => 'required|integer|min:1'
        ]);

        try {
            DB::transaction(function () use ($request) {
                $sale = Penjualan::where('user_id', Auth::id())
                    ->where('status', 'OPEN')
                    ->firstOrFail();

                $product = Produk::lockForUpdate()->findOrFail($request->product_id);

                // Cek stok
                if ($product->stok < $request->quantity) {
                    throw new \Exception('Stok produk tidak mencukupi');
                }

                // Kurangi stok
                $product->decrement('stok', $request->quantity);

                // Update / insert item penjualan
                $item = ItemPenjualan::where('penjualan_id', $sale->id)
                    ->where('produk_id', $product->id)
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

                $item->subtotal = $item->kuantitas * $item->harga_satuan;
                $item->save();

                // TOTAL PEMBAYARAN
                $sale->total_pembayaran = $sale->itemPenjualan()->sum('subtotal');
                $sale->save();
            });
        } catch (\Exception $e) {
            // 🔧 Ganti 'errors' jadi 'error'
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjualan $penjualan)
    {
        $sale = $penjualan;
        $sale->load('itemPenjualan.produk');
        $products = Produk::orderBy('nama')->get();
        $mode = 'view';

        return view('penjualan.detail', compact('sale', 'products', 'mode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        $sale = $penjualan;

        abort_if($sale->status === 'COMPLETED', 403);

        $sale->load('itemPenjualan.produk');
        $products = Produk::orderBy('nama')->get();
        $mode = 'edit';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'payment_method' => 'required',
            'ukuran_baju' => 'required|in:S,M,L,XL,XXL',
        ]);

        if ($penjualan->status !== 'OPEN') {
            return back()->with('error', 'Transaksi sudah diproses');
        }

        if ($penjualan->itemPenjualan()->count() === 0) {
            return back()->with('error', 'Keranjang masih kosong');
        }

        DB::transaction(function () use ($penjualan, $request) {
            $total = $penjualan->itemPenjualan()->sum('subtotal');

            $penjualan->update([
                'metode_pembayaran' => $request->payment_method,
                'ukuran_baju'       => $request->ukuran_baju,
                'total_pembayaran'  => $total,
                'status'            => 'COMPLETED'
            ]);
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil diselesaikan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        $this->authorize('delete', $penjualan);

        if ($penjualan->status !== 'OPEN') {
            return redirect()
                ->route('penjualan.index')
                ->with('error', 'Transaksi yang sudah selesai tidak bisa dibatalkan');
        }

        DB::transaction(function () use ($penjualan) {
            foreach ($penjualan->itemPenjualan as $item) {
                if ($item->produk) {
                    $item->produk->increment('stok', $item->kuantitas);
                }
            }

            $penjualan->itemPenjualan()->delete();
            $penjualan->delete();
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil dibatalkan');
    }
}