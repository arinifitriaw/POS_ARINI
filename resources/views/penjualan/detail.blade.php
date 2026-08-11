@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

@include('layouts.navbar')

<!-- FontAwesome untuk Icon -->
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

    /* Icon Box di Banner */
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

    /* Header Card Slate */
    .card-header-slate {
        background-color: #f8fafc;
        color: #1e293b;
        border-bottom: 1px solid #e2e8f0 !important;
        padding: 1.25rem 1.5rem;
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

    /* Label Field Information */
    .info-label {
        color: #64748b;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>

<div class="container py-4">

    <!-- 1. Banner Header - Slate Grey Theme -->
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
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100" style="border: 1px solid #e2e8f0 !important;">
                <div class="card-header card-header-slate">
                    <h5 class="fw-bold mb-0 fs-6">
                        <i class="fa-solid fa-circle-info text-slate-500 me-2"></i>Informasi Transaksi
                    </h5>
                </div>
                <div class="card-body p-4">

                    <!-- Kasir -->
                    <div class="mb-3 pb-3 border-bottom">
                        <span class="info-label d-block mb-1">
                            <i class="fa-solid fa-user me-1 text-secondary"></i>Kasir
                        </span>
                        <span class="fw-bold text-dark fs-6">
                            <i class="fa-solid fa-circle-user me-1 text-secondary"></i>{{ $sale->user?->name ?? 'Pengguna Terhapus' }}
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
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1.5 fw-bold">
                                    <i class="fa-solid fa-money-bill-wave me-1"></i>CASH
                                </span>
                            @elseif($sale->metode_pembayaran === 'QRIS')
                                <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle rounded-pill px-3 py-1.5 fw-bold">
                                    <i class="fa-solid fa-qrcode me-1"></i>QRIS
                                </span>
                            @else
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1.5 fw-bold">
                                    <i class="fa-solid fa-building-columns me-1"></i>TRANSFER
                                </span>
                            @endif
                        </div>
                        <div class="text-end">
                            <span class="info-label d-block mb-1">Status</span>
                            @if($sale->status === 'COMPLETED')
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1.5 fw-bold">
                                    <i class="fa-solid fa-circle-check me-1"></i>COMPLETED
                                </span>
                            @else
                                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-3 py-1.5 fw-bold">
                                    <i class="fa-solid fa-clock-rotate-left me-1"></i>OPEN
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Total Pembayaran -->
                    <div>
                        <span class="info-label d-block mb-1">Total Pembayaran</span>
                        <span class="fs-3 fw-bold text-success">
                            Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                        </span>
                    </div>

                </div>
            </div>
        </div>

        <!-- 3. Card Tabel Daftar Produk Dibeli -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100" style="border: 1px solid #e2e8f0 !important;">
                <div class="card-header card-header-slate d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0 fs-6">
                        <i class="fa-solid fa-cart-shopping text-slate-500 me-2"></i>Daftar Produk Dibeli
                    </h5>
                    <span class="badge bg-white text-dark border rounded-pill px-3 py-1 fw-bold" style="font-size: 0.75rem;">
                        {{ count($sale->itemPenjualan) }} Item
                    </span>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-slate-50 text-uppercase fs-7" style="background-color: #f8fafc; color: #64748b;">
                                <tr>
                                    <th class="ps-4 py-3" width="70">NO</th>
                                    <th class="py-3" width="100">FOTO</th>
                                    <th class="py-3">NAMA PRODUK</th>
                                    <th class="py-3 text-center" width="120">QTY</th>
                                    <th class="pe-4 py-3 text-end" width="160">HARGA SATUAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @forelse($sale->itemPenjualan as $item)
                                <tr class="border-bottom" style="border-color: #f1f5f9 !important;">
                                    <td class="ps-4 fw-bold text-muted">{{ $i++ }}</td>

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

                                    <!-- Kuantitas/Qty -->
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark border px-3 py-1.5 fw-bold rounded-pill">
                                            {{ $item->kuantitas ?? 1 }}
                                        </span>
                                    </td>

                                    <!-- Harga Satuan -->
                                    <td class="pe-4 text-end fw-bold text-success">
                                        Rp {{ number_format($item->harga_satuan ?? $item->produk->harga_jual ?? 0, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="fa-solid fa-cart-flatbed fa-3x mb-3 text-slate-400 opacity-50"></i>
                                        <p class="mb-0 fw-bold">Tidak ada produk dalam transaksi ini</p>
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