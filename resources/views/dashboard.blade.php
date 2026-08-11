@extends('layouts.app')

{{-- Title Halaman --}}
@section('title', 'Beranda - Ringkasan Hari Ini')

@section('content')
@include('layouts.navbar')

<!-- CDN FontAwesome untuk Icon Modern -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body {
        /* Background aplikasi Abu-abu Muda */
        background-color: #f1f5f9;
        color: #334155;
    }

    /* Hero Header Banner - Tema Serba Abu-abu Modern */
    .hero-banner-dashboard {
        background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #475569 100%);
        border-radius: 24px;
        color: #ffffff;
        padding: 2.25rem 2.5rem;
        box-shadow: 0 12px 28px -5px rgba(30, 41, 59, 0.25);
        position: relative;
        overflow: hidden;
    }

    .hero-banner-dashboard::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 280px;
        height: 280px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        pointer-events: none;
    }

    .hero-banner-dashboard .text-white-50 {
        color: #cbd5e1 !important;
    }

    /* Icon Box Banner */
    .icon-box-banner {
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(12px);
        width: 64px;
        height: 64px;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 16px rgba(0,0,0,0.08);
    }

    /* Stat Cards Styling - Serba Abu-abu */
    .stat-card {
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background-color: #ffffff;
        position: relative;
        overflow: hidden;
    }
    
    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 25px -5px rgba(51, 65, 85, 0.1) !important;
        border-color: #cbd5e1;
    }

    /* Aksen Garis Atas - Variasi Abu-abu */
    .stat-card.card-sales { border-top: 4px solid #0f172a; }
    .stat-card.card-orders { border-top: 4px solid #334155; }
    .stat-card.card-cash { border-top: 4px solid #64748b; }
    .stat-card.card-noncash { border-top: 4px solid #94a3b8; }

    /* Icon Box Stat Card Abu-abu */
    .stat-icon {
        width: 54px;
        height: 54px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        transition: all 0.3s ease;
        background-color: #f8fafc;
        color: #334155;
        border: 1px solid #e2e8f0;
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.1);
        background-color: #334155;
        color: #ffffff;
    }

    /* Text Metric */
    .text-metric {
        color: #0f172a;
        font-size: 1.6rem;
        letter-spacing: -0.5px;
    }

    /* Header Tabel Section Abu-abu */
    .card-header-slate {
        background-color: #f8fafc;
        border-bottom: 1px solid #e2e8f0 !important;
        color: #1e293b;
        padding: 1.25rem 1.5rem;
    }

    /* Custom Badges Monokrom Abu-abu */
    .badge-soft-dark {
        background-color: #334155;
        color: #ffffff;
    }

    .badge-soft-grey {
        background-color: #f1f5f9;
        color: #475569;
        border: 1px solid #cbd5e1;
    }

    .badge-outline-grey {
        background-color: transparent;
        color: #334155;
        border: 1px solid #94a3b8;
    }

    .fs-7 {
        font-size: 0.8rem;
    }
</style>

<div class="container py-4">

    <!-- 1. Hero Header Section -->
    <div class="hero-banner-dashboard mb-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box-banner">
                    <i class="fa-solid fa-chart-pie fa-2x text-white"></i>
                </div>
                <div>
                    <h2 class="fw-bold mb-1">Ringkasan Hari Ini</h2>
                    <p class="mb-0 text-white-50 d-flex align-items-center gap-2">
                        <i class="fa-regular fa-calendar-check text-slate-300"></i>
                        <span>{{ $tanggalHariIni->translatedFormat('l, d F Y') }}</span>
                    </p>
                </div>
            </div>
            <div class="d-none d-md-block">
                <div class="brand-icon">
                    <i class="fa-solid fa-shirt fa-2x text-white"></i>
                </div>
            </div>
        </div>
    </div>

    @can('viewAny', App\Models\User::class)
        <!-- 2. Sales & Cash Summary (Metric Cards Monochrome) -->
        <div class="mb-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="fw-bold text-dark mb-0">
                    <i class="fa-solid fa-chart-line text-secondary me-2"></i>Penjualan & Perputaran Kas
                </h5>
            </div>
            
            <div class="row g-3">
                <!-- Total Sales -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card stat-card card-sales shadow-sm h-100 p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted text-uppercase fw-bold fs-7 tracking-wider">Total Sales</span>
                                <h3 class="fw-bold text-metric my-1">
                                    Rp {{ number_format($ringkasan['total_penjualan'], 0, ',', '.') }}
                                </h3>
                                <div class="d-flex align-items-center gap-1 mt-1">
                                    <span class="badge badge-soft-grey rounded-pill px-2 py-0.5 fs-7">
                                        <i class="fa-solid fa-arrow-up me-1"></i>Omset
                                    </span>
                                    <small class="text-muted fs-7">Total transaksi</small>
                                </div>
                            </div>
                            <div class="stat-icon">
                                <i class="fa-solid fa-sack-dollar"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Transaksi -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card stat-card card-orders shadow-sm h-100 p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted text-uppercase fw-bold fs-7 tracking-wider">Total Transaksi</span>
                                <h3 class="fw-bold text-metric my-1">
                                    {{ number_format($ringkasan['total_transaksi']) }}
                                </h3>
                                <div class="d-flex align-items-center gap-1 mt-1">
                                    <span class="badge badge-soft-grey rounded-pill px-2 py-0.5 fs-7">
                                        <i class="fa-solid fa-receipt me-1"></i>Struk
                                    </span>
                                    <small class="text-muted fs-7">Berhasil terproses</small>
                                </div>
                            </div>
                            <div class="stat-icon">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Cash -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card stat-card card-cash shadow-sm h-100 p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted text-uppercase fw-bold fs-7 tracking-wider">Tunai (Cash)</span>
                                <h3 class="fw-bold text-metric my-1">
                                    Rp {{ number_format($ringkasan['total_cash'], 0, ',', '.') }}
                                </h3>
                                <div class="d-flex align-items-center gap-1 mt-1">
                                    <span class="badge badge-soft-grey rounded-pill px-2 py-0.5 fs-7">
                                        Fisik
                                    </span>
                                    <small class="text-muted fs-7">Di dalam laci kasir</small>
                                </div>
                            </div>
                            <div class="stat-icon">
                                <i class="fa-solid fa-money-bill-wave"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Non Tunai -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card stat-card card-noncash shadow-sm h-100 p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted text-uppercase fw-bold fs-7 tracking-wider">Non-Tunai</span>
                                <h3 class="fw-bold text-metric my-1">
                                    Rp {{ number_format($ringkasan['total_non_tunai'], 0, ',', '.') }}
                                </h3>
                                <div class="d-flex align-items-center gap-1 mt-1">
                                    <span class="badge badge-soft-grey rounded-pill px-2 py-0.5 fs-7">
                                        Digital
                                    </span>
                                    <small class="text-muted fs-7">QRIS / Transfer</small>
                                </div>
                            </div>
                            <div class="stat-icon">
                                <i class="fa-solid fa-qrcode"></i>
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
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden" style="border: 1px solid #e2e8f0 !important;">
                <div class="card-header card-header-slate d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0 fs-6">
                        <i class="fa-solid fa-triangle-exclamation text-secondary me-2"></i>Produk Stok Rendah
                    </h6>
                    <span class="badge badge-outline-grey rounded-pill px-2.5 py-1 font-monospace fs-7">Peringatan</span>
                </div>
                <div class="card-body p-0 bg-white">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-muted text-uppercase fs-7">
                                <tr>
                                    <th class="ps-4 py-3" width="10%">#</th>
                                    <th class="py-3">Nama Produk</th>
                                    <th width="35%" class="text-center py-3">Sisa Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkStokRendah as $index => $produk)
                                    <tr class="border-bottom" style="border-color: #f1f5f9 !important;">
                                        <td class="ps-4 fw-bold text-muted">{{ $produkStokRendah->firstItem() + $index }}</td>
                                        <td class="fw-semibold text-dark">
                                            <i class="fa-solid fa-box text-secondary me-2"></i>{{ $produk->nama }}
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-soft-grey px-3 py-1.5 rounded-pill fw-bold">
                                                <i class="fa-solid fa-layer-group me-1"></i>Sisa {{ $produk->stok }} Unit
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-muted text-center py-4 bg-white">
                                            <i class="fa-solid fa-circle-check text-secondary fa-2x mb-2 d-block opacity-75"></i>
                                            <span class="fw-medium">Seluruh produk berada dalam kondisi stok aman.</span>
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
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden" style="border: 1px solid #e2e8f0 !important;">
                <div class="card-header card-header-slate d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0 fs-6">
                        <i class="fa-solid fa-circle-xmark text-secondary me-2"></i>Produk Habis Stok
                    </h6>
                    <span class="badge badge-soft-dark rounded-pill px-2.5 py-1 font-monospace fs-7">Kritis</span>
                </div>
                <div class="card-body p-0 bg-white">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-muted text-uppercase fs-7">
                                <tr>
                                    <th class="ps-4 py-3" width="10%">#</th>
                                    <th class="py-3">Nama Produk</th>
                                    <th width="35%" class="text-center py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkStokHabis as $index => $produk)
                                    <tr class="border-bottom" style="border-color: #f1f5f9 !important;">
                                        <td class="ps-4 fw-bold text-muted">{{ $produkStokHabis->firstItem() + $index }}</td>
                                        <td class="fw-semibold text-dark">
                                            <i class="fa-solid fa-box text-secondary me-2"></i>{{ $produk->nama }}
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-soft-dark px-3 py-1.5 rounded-pill fw-bold">
                                                <i class="fa-solid fa-ban me-1"></i>Habis ({{ $produk->stok }})
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-muted text-center py-4 bg-white">
                                            <i class="fa-solid fa-circle-check text-secondary fa-2x mb-2 d-block opacity-75"></i>
                                            <span class="fw-medium">Tidak ada produk yang kehabisan stok.</span>
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
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="border: 1px solid #e2e8f0 !important;">
                <div class="card-header card-header-slate d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0 fs-6">
                        <i class="fa-solid fa-crown text-secondary me-2"></i>Produk Terlaris (Best Seller Hari Ini)
                    </h6>
                    <span class="badge badge-soft-grey rounded-pill px-3 py-1 fw-bold fs-7">
                        Top Performers
                    </span>
                </div>
                <div class="card-body p-0 bg-white">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-muted text-uppercase fs-7">
                                <tr>
                                    <th class="ps-4 py-3">Nama Produk</th>
                                    <th class="text-center py-3">Sisa Stok Saat Ini</th>
                                    <th class="text-end pe-4 py-3">Total Terjual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkTerlaris as $produk)
                                    <tr class="border-bottom" style="border-color: #f1f5f9 !important;">
                                        <td class="ps-4 fw-bold text-dark">
                                            <i class="fa-solid fa-fire text-secondary me-2"></i>{{ $produk->nama }}
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-soft-grey rounded-pill px-3 py-1 fw-bold">
                                                {{ $produk->stok }} Unit Tersedia
                                            </span>
                                        </td>
                                        <td class="text-end pe-4 fw-bold text-dark fs-6">
                                            <span class="badge badge-soft-dark rounded-pill px-3 py-1.5 me-1">
                                                <i class="fa-solid fa-cart-shopping me-1"></i>{{ $produk->total_terjual }} Unit
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-muted text-center py-5 bg-white">
                                            <i class="fa-solid fa-chart-line text-secondary fa-2x mb-2 d-block opacity-50"></i>
                                            <span class="fw-medium">Belum ada data penjualan produk terlaris hari ini.</span>
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