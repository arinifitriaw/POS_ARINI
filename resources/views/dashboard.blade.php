@extends('layouts.app')

{{-- Title Halaman --}}
@section('title', 'Beranda - Ringkasan Hari Ini')

@section('content')
@include('layouts.navbar')

<!-- CDN FontAwesome untuk Icon Modern -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body {
        background-color: #f3f4f6;
    }

    /* Hero Header Banner Colorful untuk Dashboard (Aksen Ungu-Indigo-Biru) */
    .hero-banner-dashboard {
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 50%, #ec4899 100%);
        border-radius: 20px;
        color: white;
        padding: 2rem;
        box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.4);
    }

    /* Stat Cards Styling */
    .stat-card {
        border: none;
        border-radius: 16px;
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 20px -5px rgba(0, 0, 0, 0.08) !important;
    }

    .stat-icon {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    /* Gradient Header Tabel */
    .bg-gradient-warning {
        background: linear-gradient(90deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }
    .bg-gradient-danger {
        background: linear-gradient(90deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }
    .bg-gradient-primary {
        background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%);
        color: white;
    }
</style>

<div class="container py-4">

    <!-- 1. Colorful Hero Header Section (Tanpa Badge Live Metric POS) -->
    <div class="hero-banner-dashboard mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="p-3 bg-white bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center">
                <i class="fa-solid fa-chart-pie fa-2x text-white"></i>
            </div>
            <div>
                <h2 class="fw-bold mb-0">Ringkasan Hari Ini</h2>
                <p class="mb-0 text-white-50">
                    <i class="fa-regular fa-calendar-check me-1"></i>
                    {{ $tanggalHariIni->translatedFormat('l, d F Y') }}
                </p>
            </div>
        </div>
    </div>

    @can('viewAny', App\Models\User::class)
        <!-- 2. Sales & Cash Summary (Metric Cards) -->
        <div class="mb-4">
            <h5 class="fw-bold text-dark mb-3">
                <i class="fa-solid fa-chart-line text-primary me-2"></i>Penjualan & Pembayaran
            </h5>
            
            <div class="row g-3">
                <!-- Total Sales -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card stat-card shadow-sm h-100 p-3 bg-white">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted text-uppercase fw-semibold fs-7">Total Sales</span>
                                <h3 class="fw-bold text-primary my-1">
                                    Rp {{ number_format($ringkasan['total_penjualan'], 0, ',', '.') }}
                                </h3>
                                <small class="text-muted">Total nilai transaksi</small>
                            </div>
                            <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                                <i class="fa-solid fa-sack-dollar"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Transaksi -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card stat-card shadow-sm h-100 p-3 bg-white">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted text-uppercase fw-semibold fs-7">Total Transaksi</span>
                                <h3 class="fw-bold text-info my-1">
                                    {{ number_format($ringkasan['total_transaksi']) }}
                                </h3>
                                <small class="text-muted">Transaksi berhasil</small>
                            </div>
                            <div class="stat-icon bg-info bg-opacity-10 text-info">
                                <i class="fa-solid fa-receipt"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Cash -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card stat-card shadow-sm h-100 p-3 bg-white">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted text-uppercase fw-semibold fs-7">Tunai (Cash)</span>
                                <h3 class="fw-bold text-success my-1">
                                    Rp {{ number_format($ringkasan['total_cash'], 0, ',', '.') }}
                                </h3>
                                <small class="text-muted">Metode pembayaran tunai</small>
                            </div>
                            <div class="stat-icon bg-success bg-opacity-10 text-success">
                                <i class="fa-solid fa-money-bill-wave"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Non Tunai -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card stat-card shadow-sm h-100 p-3 bg-white">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted text-uppercase fw-semibold fs-7">Non-Tunai</span>
                                <h3 class="fw-bold text-warning my-1">
                                    Rp {{ number_format($ringkasan['total_non_tunai'], 0, ',', '.') }}
                                </h3>
                                <small class="text-muted">E-Wallet / Transfer / QRIS</small>
                            </div>
                            <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                                <i class="fa-solid fa-credit-card"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    <!-- 3. Inventory Status Section -->
    <div class="row g-4 mb-4">
        <!-- Stok Rendah -->
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                <div class="card-header bg-gradient-warning py-3 px-4 border-0">
                    <h6 class="fw-bold mb-0">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i>Produk Stok Rendah
                    </h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-secondary text-uppercase fs-7">
                                <tr>
                                    <th class="ps-4" width="10%">#</th>
                                    <th>Nama Produk</th>
                                    <th width="30%" class="text-center">Sisa Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkStokRendah as $index => $produk)
                                    <tr>
                                        <td class="ps-4 fw-bold text-muted">{{ $produkStokRendah->firstItem() + $index }}</td>
                                        <td class="fw-semibold text-dark">{{ $produk->nama }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-3 py-1.5 rounded-pill fw-bold">
                                                <i class="fa-solid fa-box-open me-1"></i>{{ $produk->stok }} Unit
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-muted text-center py-4">
                                            <i class="fa-solid fa-circle-check text-success fa-2x mb-2 d-block"></i>
                                            Seluruh produk berada dalam kondisi stok aman.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($produkStokRendah->hasPages())
                    <div class="card-footer bg-white border-0 py-3">
                        {{ $produkStokRendah->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Stok Habis -->
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                <div class="card-header bg-gradient-danger py-3 px-4 border-0">
                    <h6 class="fw-bold mb-0">
                        <i class="fa-solid fa-circle-xmark me-2"></i>Produk Habis Stok
                    </h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-secondary text-uppercase fs-7">
                                <tr>
                                    <th class="ps-4" width="10%">#</th>
                                    <th>Nama Produk</th>
                                    <th width="30%" class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkStokHabis as $index => $produk)
                                    <tr>
                                        <td class="ps-4 fw-bold text-muted">{{ $produkStokHabis->firstItem() + $index }}</td>
                                        <td class="fw-semibold text-dark">{{ $produk->nama }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1.5 rounded-pill fw-bold">
                                                Habis ({{ $produk->stok }})
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-muted text-center py-4">
                                            <i class="fa-solid fa-circle-check text-success fa-2x mb-2 d-block"></i>
                                            Tidak ada produk yang kehabisan stok.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($produkStokHabis->hasPages())
                    <div class="card-footer bg-white border-0 py-3">
                        {{ $produkStokHabis->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- 4. Best Seller Section -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-gradient-primary py-3 px-4 border-0">
                    <h6 class="fw-bold mb-0">
                        <i class="fa-solid fa-crown text-warning me-2"></i>Produk Terlaris (Best Seller)
                    </h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-secondary text-uppercase fs-7">
                                <tr>
                                    <th class="ps-4">Nama Produk</th>
                                    <th class="text-center">Sisa Stok</th>
                                    <th class="text-end pe-4">Total Terjual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkTerlaris as $produk)
                                    <tr>
                                        <td class="ps-4 fw-bold text-dark">
                                            <i class="fa-solid fa-fire text-danger me-2"></i>{{ $produk->nama }}
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-3 py-1">
                                                {{ $produk->stok }} Unit
                                            </span>
                                        </td>
                                        <td class="text-end pe-4 fw-bold text-success">
                                            <i class="fa-solid fa-cart-shopping me-1"></i>{{ $produk->total_terjual }} Unit
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-muted text-center py-4">
                                            <i class="fa-solid fa-chart-line text-secondary fa-2x mb-2 d-block opacity-50"></i>
                                            Belum ada data penjualan produk terlaris hari ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection