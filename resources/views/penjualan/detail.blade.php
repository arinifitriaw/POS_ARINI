@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

@include('layouts.navbar')

<!-- FontAwesome untuk Icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body {
        background-color: #f8fafc;
    }

    /* Hero Banner Gradient Hijau Toska - Biru (Sesuai Banner Halaman Penjualan) */
    .hero-banner-sales {
        background: linear-gradient(135deg, #10b981 0%, #06b6d4 50%, #3b82f6 100%);
        border-radius: 24px;
        color: white;
        padding: 2rem 2.5rem;
        box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.3);
    }

    /* Icon Box di Banner */
    .icon-box-banner {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        width: 60px;
        height: 60px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Header Card (Disesuaikan dengan Bar 'Daftar Penjualan') */
    .card-header-teal {
        background: linear-gradient(90deg, #0d9488 0%, #2563eb 100%);
        color: white;
        padding: 1rem 1.5rem;
        border-top-left-radius: 16px !important;
        border-top-right-radius: 16px !important;
    }

    /* Button Kembali Light Transparan */
    .btn-gradient-light {
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(8px);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.4);
        transition: all 0.3s ease;
    }
    .btn-gradient-light:hover {
        background: white;
        color: #0d9488;
    }

    /* Soft Badges Warna Metode Pembayaran & Status */
    .badge-soft-cash {
        background-color: #d1fae5;
        color: #047857;
    }
    .badge-soft-qris {
        background-color: #e0f2fe;
        color: #0369a1;
    }
    .badge-soft-open {
        background-color: #fef3c7;
        color: #b45309;
    }
    .badge-soft-completed {
        background-color: #d1fae5;
        color: #047857;
    }

    /* Label Field */
    .info-label {
        color: #64748b;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>

<div class="container py-4">

    <!-- 1. Banner Header (Diselaraskan dengan Banner 'Halaman Penjualan') -->
    <div class="hero-banner-sales mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-box-banner">
                        <i class="fa-solid fa-receipt fa-2x text-white"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-1">Penjualan Detail</h2>
                        <p class="mb-0 text-white-50">Rincian lengkap item & informasi transaksi penjualan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('penjualan.index') }}" class="btn btn-gradient-light rounded-pill px-4 py-2.5 fw-bold shadow-sm">
                    <i class="fa-solid fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">

        <!-- 2. Card Informasi Transaksi -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                <div class="card-header card-header-teal">
                    <h5 class="fw-bold mb-0 fs-6">
                        <i class="fa-solid fa-circle-info me-2"></i>Informasi Transaksi
                    </h5>
                </div>
                <div class="card-body p-4">

                    <!-- Kasir -->
                    <div class="mb-3 pb-3 border-bottom">
                        <span class="info-label d-block mb-1">
                            <i class="fa-solid fa-user me-1 text-secondary"></i>Kasir
                        </span>
                        <span class="fw-bold text-dark fs-6">
                            <i class="fa-solid fa-circle-user me-1 text-secondary"></i>{{ $sale->user->name }}
                        </span>
                    </div>

                    <!-- Tanggal Transaksi -->
                    <div class="mb-3 pb-3 border-bottom">
                        <span class="info-label d-block mb-1">
                            <i class="fa-regular fa-clock me-1 text-secondary"></i>Tanggal Transaksi
                        </span>
                        <span class="fw-semibold text-dark">
                            {{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}
                        </span>
                    </div>

                    <!-- Metode Pembayaran & Status -->
                    <div class="mb-3 pb-3 border-bottom d-flex justify-content-between align-items-center">
                        <div>
                            <span class="info-label d-block mb-1">Metode</span>
                            @if($sale->metode_pembayaran === 'CASH')
                                <span class="badge badge-soft-cash rounded-pill px-3 py-1.5 fw-bold">
                                    <i class="fa-solid fa-money-bill-wave me-1"></i>CASH
                                </span>
                            @else
                                <span class="badge badge-soft-qris rounded-pill px-3 py-1.5 fw-bold">
                                    <i class="fa-solid fa-qrcode me-1"></i>{{ $sale->metode_pembayaran }}
                                </span>
                            @endif
                        </div>
                        <div class="text-end">
                            <span class="info-label d-block mb-1">Status</span>
                            @if($sale->status === 'COMPLETED')
                                <span class="badge badge-soft-completed rounded-pill px-3 py-1.5 fw-bold">
                                    <i class="fa-solid fa-circle-check me-1"></i>COMPLETED
                                </span>
                            @else
                                <span class="badge badge-soft-open rounded-pill px-3 py-1.5 fw-bold">
                                    <i class="fa-solid fa-rotate me-1"></i>OPEN
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Total Pembayaran -->
                    <div>
                        <span class="info-label d-block mb-1">Total Pembayaran</span>
                        <span class="fs-3 fw-bold text-emerald" style="color: #059669;">
                            Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                        </span>
                    </div>

                </div>
            </div>
        </div>

        <!-- 3. Card Tabel Daftar Produk Dibeli -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                <div class="card-header card-header-teal d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0 fs-6">
                        <i class="fa-solid fa-cart-shopping me-2"></i>Daftar Produk Dibeli
                    </h5>
                    <span class="badge bg-white text-dark rounded-pill px-3 py-1 fw-bold" style="font-size: 0.75rem;">
                        {{ count($sale->itemPenjualan) }} Item
                    </span>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr class="text-secondary small fw-bold text-uppercase">
                                    <th class="ps-4" width="70">NO</th>
                                    <th width="100">FOTO</th>
                                    <th>NAMA PRODUK</th>
                                    <th width="120" class="text-center">QTY</th>
                                    <th width="160" class="pe-4 text-end">HARGA SATUAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @forelse($sale->itemPenjualan as $item)
                                <tr>
                                    <td class="ps-4 fw-bold text-secondary">{{ $i++ }}</td>

                                    <!-- Foto Produk -->
                                    <td>
                                        @if($item->produk && $item->produk->foto)
                                            <img src="{{ asset('storage/'.$item->produk->foto) }}"
                                                 alt="{{ $item->produk->nama }}"
                                                 width="55" height="55"
                                                 class="rounded-3 shadow-sm"
                                                 style="object-fit:cover; border: 1px solid #e2e8f0;">
                                        @else
                                            <div class="rounded-3 bg-light d-flex align-items-center justify-content-center border" style="width: 55px; height: 55px;">
                                                <i class="fa-solid fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>

                                    <!-- Nama Produk -->
                                    <td class="fw-bold text-dark">
                                        {{ $item->produk->nama ?? 'Produk Dihapus' }}
                                    </td>

                                    <!-- Kuantitas/Qty (Jika ada kolom kuantitas) -->
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark border px-3 py-1.5 fw-bold rounded-pill">
                                            {{ $item->kuantitas ?? 1 }}
                                        </span>
                                    </td>

                                    <!-- Harga Jual -->
                                    <td class="pe-4 text-end fw-bold text-emerald" style="color: #059669;">
                                        Rp {{ number_format($item->harga_satuan ?? $item->produk->harga_jual ?? 0, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        Tidak ada produk dalam transaksi ini
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