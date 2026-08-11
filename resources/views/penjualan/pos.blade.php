@extends('layouts.app')

@section('title', 'POS - Tambah & Edit Penjualan')

@section('content')

@include('layouts.navbar')

<!-- CDN FontAwesome untuk Icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body {
        /* Background aplikasi Slate Grey sangat muda */
        background-color: #f1f5f9;
        color: #334155;
    }

    /* Hero Banner - Tema Slate Grey Modern */
    .hero-banner-sales {
        background: linear-gradient(135deg, #334155 0%, #475569 100%);
        border-radius: 24px;
        color: white;
        padding: 2rem 2.5rem;
        box-shadow: 0 10px 25px -5px rgba(51, 65, 85, 0.25);
    }

    .hero-banner-sales .text-white-50 {
        color: #94a3b8 !important;
    }

    /* Icon Box di Banner Header */
    .icon-box-banner {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        width: 60px;
        height: 60px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Button Light Transparan Header */
    .btn-gradient-light {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(8px);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
    }
    .btn-gradient-light:hover {
        background: white;
        color: #0f172a;
        transform: translateY(-2px);
    }

    /* Header Card Slate */
    .card-header-slate {
        background-color: #f8fafc;
        color: #1e293b;
        border-bottom: 1px solid #e2e8f0 !important;
        padding: 1.25rem 1.5rem;
    }

    /* Form Pencarian Modern Slate */
    .search-card {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        transition: all 0.3s ease;
    }
    .search-card:focus-within {
        border-color: #475569;
        box-shadow: 0 0 0 3px rgba(71, 85, 105, 0.15);
    }

    /* Custom Button Slate Primary */
    .btn-slate-primary {
        background-color: #334155;
        color: white;
        border: none;
        transition: all 0.2s ease;
    }
    .btn-slate-primary:hover:not(:disabled) {
        background-color: #1e293b;
        color: white;
        transform: translateY(-1px);
    }

    /* Scrollbar Halus untuk List Produk */
    .product-list-container {
        max-height: 520px;
        overflow-y: auto;
        padding-right: 4px;
    }
    .product-list-container::-webkit-scrollbar {
        width: 6px;
    }
    .product-list-container::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    /* Total Price Box - Tema Slate / Neutral Soft */
    .total-price-box {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
    }
</style>

<div class="container py-4">

    <!-- Alert Error handling -->
    @if(session('errors'))
        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 alert-dismissible fade show">
            <i class="fa-solid fa-circle-exclamation me-2"></i>{{ session('errors') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- 1. Hero Header Section - Slate Grey -->
    <div class="hero-banner-sales mb-4">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-box-banner">
                        <i class="fa-solid fa-cash-register fa-2x text-white"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-1">Tambah & Edit Penjualan</h2>
                        <p class="mb-0 text-white-50">Kelola item keranjang dan selesaikan transaksi kasir POS</p>
                    </div>
                </div>
            </div>
            <div class="col-md-5 text-md-end mt-3 mt-md-0">
                <a href="{{ route('penjualan.index') }}" class="btn btn-gradient-light rounded-pill px-4 py-2.5 fw-bold shadow-sm">
                    <i class="fa-solid fa-arrow-left me-2"></i>Kembali ke List
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content Row -->
    <div class="row g-4">

        {{-- =================== KATALOG PRODUK =================== --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100" style="border: 1px solid #e2e8f0 !important;">
                <div class="card-header card-header-slate d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0 fs-6">
                        <i class="fa-solid fa-boxes-stacked text-slate-500 me-2"></i>Katalog Produk
                    </h5>
                    <span class="badge bg-white text-dark border rounded-pill px-3 py-1.5 fw-bold" style="font-size: 0.75rem;">
                        Pilih Item
                    </span>
                </div>

                <div class="card-body p-3">
                    <!-- Form Pencarian Produk -->
                    <div class="mb-3">
                        <form method="GET" action="{{ route('penjualan.create') }}">
                            <div class="input-group search-card p-1">
                                <span class="input-group-text bg-transparent border-0 text-secondary ps-3">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                                <input type="text"
                                       name="search"
                                       value="{{ request('search') }}"
                                       class="form-control border-0 shadow-none bg-transparent"
                                       placeholder="Cari nama produk..."
                                       onkeyup="this.form.submit()">
                            </div>
                        </form>
                    </div>

                    <!-- Scrollable Product List -->
                    <div class="product-list-container d-flex flex-column gap-2">
                        @forelse($products as $product)
                            <form method="POST" action="{{ route('itempenjualan.store') }}" class="row g-2 align-items-center bg-white rounded-3 p-2 border mx-0" style="border-color: #f1f5f9 !important;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                {{-- Informasi Produk --}}
                                <div class="col-7">
                                    <div class="d-flex align-items-center gap-2">
                                        @if($product->foto)
                                            <img src="{{ asset('storage/'.$product->foto) }}"
                                                 alt="{{ $product->nama }}"
                                                 class="rounded-3 border shadow-sm"
                                                 style="width:48px; height:48px; object-fit:cover; border-color: #e2e8f0 !important;">
                                        @else
                                            <div class="rounded-3 bg-light border d-flex align-items-center justify-content-center" style="width:48px; height:48px;">
                                                <i class="fa-solid fa-image text-muted"></i>
                                            </div>
                                        @endif

                                        <div class="text-truncate">
                                            <div class="fw-bold text-dark text-truncate">{{ $product->nama }}</div>
                                            <small class="text-success fw-bold">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</small>
                                        </div>
                                    </div>
                                </div>

                                {{-- Input Quantity --}}
                                <div class="col-3">
                                    <input type="number" name="quantity" value="1" min="1"
                                           class="form-control text-center rounded-3 shadow-none fw-semibold border-secondary-subtle {{ $sale->status === 'COMPLETED' ? 'readonly' : ''}}">
                                </div>

                                {{-- Tombol Tambah --}}
                                <div class="col-2">
                                    <button class="btn btn-slate-primary w-100 rounded-3 py-2 fw-bold shadow-sm {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}" title="Tambah Ke Keranjang">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            </form>
                        @empty
                            <div class="text-center py-5 text-muted">
                                <i class="fa-solid fa-box-open fa-3x mb-3 text-secondary opacity-50"></i>
                                <p class="mb-0 fw-semibold">Produk tidak ditemukan</p>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>

        {{-- =================== KERANJANG PENJUALAN =================== --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 d-flex flex-column justify-content-between" style="border: 1px solid #e2e8f0 !important;">
                <div>
                    <div class="card-header card-header-slate d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0 fs-6">
                            <i class="fa-solid fa-cart-shopping text-slate-500 me-2"></i>Keranjang
                        </h5>
                        <span class="badge bg-white text-dark border rounded-pill px-3 py-1.5 fw-bold" style="font-size: 0.75rem;">
                            {{ count($sale->ItemPenjualan) }} Item
                        </span>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-slate-50 text-uppercase fs-7" style="background-color: #f8fafc; color: #64748b;">
                                <tr>
                                    <th class="ps-3 py-3">Produk</th>
                                    <th class="py-3">Harga</th>
                                    <th class="py-3 text-center" width="85">Qty</th>
                                    <th class="py-3">SubTotal</th>
                                    <th class="text-center py-3" width="70">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sale->ItemPenjualan as $item)
                                <tr class="border-bottom" style="border-color: #f1f5f9 !important;">
                                    <td class="ps-3 fw-bold text-dark">{{ $item->produk->nama }}</td>
                                    <td class="text-muted small">Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                            @csrf @method('PUT')
                                            <input type="number" name="quantity"
                                                   value="{{ $item->kuantitas }}"
                                                   class="form-control form-control-sm text-center rounded-3 shadow-none fw-bold"
                                                   onchange="this.form.submit()"
                                                   {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                                        </form>
                                    </td>
                                    <td class="fw-bold text-success">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        @can('delete', $item)
                                        @if($sale->status !== 'COMPLETED')
                                        <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm rounded-circle p-1 d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 32px; height: 32px;" title="Hapus">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                        @endif
                                        @endcan
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="fa-solid fa-cart-flatbed fa-3x mb-3 text-secondary opacity-50"></i>
                                        <p class="mb-0 fw-semibold">Keranjang masih kosong.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Footer Pembayaran & Aksi Transaksi -->
                <div class="card-footer bg-white p-3 border-top" style="border-color: #e2e8f0 !important;">
                    
                    <!-- Total Pembayaran Box -->
                    <div class="total-price-box p-3 mb-3 d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-dark mb-0">Total Pembayaran</span>
                        <h3 class="fw-bold text-success mb-0">Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</h3>
                    </div>

                    <!-- Form Checkout -->
                    <form method="POST" 
                          action="{{ route('penjualan.update', $sale->id) }}"
                          onsubmit="return confirm('Yakin ingin checkout?')">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary fs-7 text-uppercase mb-1">Metode Pembayaran</label>
                            <select name="payment_method" class="form-select rounded-3 py-2 shadow-none border-secondary-subtle" required {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                                <option value="">-- Pilih Pembayaran --</option>
                                <option value="CASH" {{ $sale->metode_pembayaran === 'CASH' ? 'selected' : '' }}>CASH</option>
                                <option value="QRIS" {{ $sale->metode_pembayaran === 'QRIS' ? 'selected' : '' }}>QRIS</option>
                            </select>
                        </div>

                        <button class="btn btn-success w-100 rounded-pill py-2.5 fw-bold shadow-sm fs-6 mb-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                            <i class="fa-solid fa-circle-check me-2"></i>Checkout Transaksi
                        </button>
                    </form>

                    <!-- Form Batal Transaksi -->
                    @can('delete', $sale)
                    <form action="{{ route('penjualan.destroy', $sale->id) }}" 
                          method="POST" 
                          onsubmit="return confirm('Yakin ingin membatalkan transaksi?')">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-outline-danger w-100 rounded-pill py-2 fw-semibold border-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                            <i class="fa-solid fa-xmark me-2"></i>Batal Transaksi
                        </button>
                    </form>
                    @endcan

                </div>
            </div>
        </div>

    </div>
</div>

@endsection