@extends('layouts.app')

@section('title', 'POS - Tambah & Edit Penjualan')

@section('content')

@include('layouts.navbar')

<!-- CDN FontAwesome untuk Icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body {
        background-color: #f3f4f6;
    }

    /* Hero Header Banner Colorful untuk Penjualan (Aksen Hijau-Biru-Ungu) */
    .hero-banner-sales {
        background: linear-gradient(135deg, #10b981 0%, #3b82f6 50%, #6366f1 100%);
        border-radius: 20px;
        color: white;
        padding: 1.75rem 2rem;
        box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4);
    }

    /* Form Pencarian Modern */
    .search-card {
        background: #ffffff;
        border: 2px solid #e5e7eb;
        border-radius: 14px;
        transition: all 0.3s ease;
    }
    .search-card:focus-within {
        border-color: #10b981;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
    }

    /* Table Header Gradient */
    .table-header-gradient {
        background: linear-gradient(90deg, #059669 0%, #2563eb 100%);
        color: white;
    }

    /* Custom Gradient Buttons */
    .btn-gradient-green {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border: none;
        transition: all 0.2s ease;
    }
    .btn-gradient-green:hover:not(:disabled) {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        color: white;
        transform: translateY(-1px);
    }

    .btn-gradient-light {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.4);
        transition: all 0.3s ease;
    }
    .btn-gradient-light:hover {
        background: white;
        color: #059669;
    }

    /* Scrollbar Halus untuk List Produk */
    .product-list-container {
        max-height: 580px;
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

    /* Total Price Box */
    .total-price-box {
        background: linear-gradient(135deg, #ecfdf5 0%, #e0f2fe 100%);
        border: 1px solid #a7f3d0;
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

    <!-- 1. Hero Header Section -->
    <div class="hero-banner-sales mb-4">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 bg-white bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-cash-register fa-2x text-white"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-0">Tambah dan Edit Penjualan</h2>
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

        {{-- =================== PRODUK =================== --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                <div class="card-header table-header-gradient py-3 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">
                        <i class="fa-solid fa-boxes-stacked me-2"></i>Katalog Produk
                    </h5>
                    <span class="badge bg-white text-dark rounded-pill px-3 py-1.5 fw-bold">Pilih Item</span>
                </div>

                <div class="card-body p-3">
                    <!-- Form Pencarian Produk -->
                    <div class="mb-3">
                        <form method="GET" action="{{ route('penjualan.create') }}">
                            <div class="input-group search-card p-1">
                                <span class="input-group-text bg-transparent border-0 text-success ps-3">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                                <input type="text"
                                       name="search"
                                       value="{{ request('search') }}"
                                       class="form-control border-0 shadow-none bg-transparent"
                                       placeholder="Cari produk..."
                                       onkeyup="this.form.submit()">
                            </div>
                        </form>
                    </div>

                    <!-- Scrollable Product List -->
                    <div class="product-list-container d-flex flex-column gap-2">
                        @foreach($products as $product)
                            <form method="POST" action="{{ route('itempenjualan.store') }}" class="row g-2 align-items-center bg-light rounded-3 p-2 border mx-0">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                {{-- Informasi Produk --}}
                                <div class="col-7">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ asset('storage/'.$product->foto) }}"
                                             alt="{{ $product->nama }}"
                                             class="rounded-3 border shadow-sm"
                                             style="width:48px; height:48px; object-fit:cover;">

                                        <div class="text-truncate">
                                            <div class="fw-bold text-dark text-truncate">{{ $product->nama }}</div>
                                            <small class="text-success fw-semibold">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</small>
                                        </div>
                                    </div>
                                </div>

                                {{-- Input Quantity --}}
                                <div class="col-3">
                                    <input type="number" name="quantity" value="1" min="1"
                                           class="form-control text-center rounded-3 shadow-none fw-semibold {{ $sale->status === 'COMPLETED' ? 'readonly' : ''}}">
                                </div>

                                {{-- Tombol Tambah --}}
                                <div class="col-2">
                                    <button class="btn btn-gradient-green w-100 rounded-3 py-2 fw-bold shadow-sm {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            </form>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>

        {{-- =================== KERANJANG =================== --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="card-header table-header-gradient py-3 px-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">
                            <i class="fa-solid fa-cart-shopping me-2"></i>Keranjang
                        </h5>
                        <span class="badge bg-white text-dark rounded-pill px-3 py-1.5 fw-bold">Item Pesanan</span>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-secondary text-uppercase fs-7">
                                <tr>
                                    <th class="ps-3">Produk</th>
                                    <th>Harga</th>
                                    <th width="85">Qty</th>
                                    <th>SubTotal</th>
                                    <th class="text-center" width="70">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sale->ItemPenjualan as $item)
                                <tr>
                                    <td class="ps-3 fw-semibold text-dark">{{ $item->produk->nama }}</td>
                                    <td class="text-muted">Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                            @csrf @method('PUT')
                                            <input type="number" name="quantity"
                                                   value="{{ $item->kuantitas }}"
                                                   class="form-control form-control-sm text-center rounded-3 shadow-none fw-semibold"
                                                   onchange="this.form.submit()">
                                        </form>
                                    </td>
                                    <td class="fw-bold text-success">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        @can('delete', $item)
                                        <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger btn-sm rounded-circle p-2 d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 32px; height: 32px;" title="Hapus">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="fa-solid fa-cart-flatbed fa-3x mb-3 text-secondary opacity-50"></i>
                                        <p class="mb-0">Keranjang masih kosong.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Footer Pembayaran & Aksi Transaksi -->
                <div class="card-footer bg-white p-3 border-top">
                    
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
                            <select name="payment_method" class="form-select rounded-3 py-2 shadow-none border-2" required>
                                <option value="">-- Pilih Pembayaran --</option>
                                <option value="CASH">CASH</option>
                                <option value="QRIS">QRIS</option>
                            </select>
                        </div>

                        <button class="btn btn-gradient-green w-100 rounded-pill py-2.5 fw-bold shadow-sm fs-6 mb-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                            <i class="fa-solid fa-circle-check me-2"></i>Checkout
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