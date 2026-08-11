@extends('layouts.app')

@section('title', 'Detail Produk')

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
    .hero-banner-detail-produk {
        background: linear-gradient(135deg, #334155 0%, #475569 100%);
        border-radius: 24px;
        color: white;
        padding: 2rem 2.5rem;
        box-shadow: 0 10px 25px -5px rgba(51, 65, 85, 0.25);
    }

    .hero-banner-detail-produk .text-white-50 {
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

    /* Header Card Detail */
    .card-header-slate {
        background-color: #f8fafc;
        color: #1e293b;
        border-bottom: 1px solid #e2e8f0 !important;
        padding: 1rem 1.5rem;
        border-top-left-radius: 16px !important;
        border-top-right-radius: 16px !important;
    }

    /* Button Transparan di Banner */
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

    /* Card Wrapper Foto - Dibuat presisi agar gambar dekat & jelas */
    .product-img-wrapper {
        background: #ffffff;
        border: 2px dashed #cbd5e1;
        border-radius: 20px;
        padding: 0.75rem;
        min-height: 320px;
    }

    /* Styling Gambar Produk Utuh & Dekat */
    .detail-product-img {
        max-height: 340px;
        width: 100%;
        object-fit: contain;
        border-radius: 14px;
    }

    /* Format Label Informasi */
    .info-label {
        color: #64748b;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Soft Badges Warna Stok */
    .badge-soft-warning {
        background-color: #fef9c3;
        color: #854d0e;
    }
    .badge-soft-success {
        background-color: #dcfce7;
        color: #166534;
    }
    .badge-soft-danger {
        background-color: #fee2e2;
        color: #991b1b;
    }
</style>

<div class="container py-4">

    <!-- 1. Banner Header - Slate Grey Theme -->
    <div class="hero-banner-detail-produk mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-box-banner">
                        <i class="fa-solid fa-box-archive fa-2x text-white"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-1">Detail Produk</h2>
                        <p class="mb-0 text-white-50">Informasi lengkap dan spesifikasi produk POS</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('produk.index') }}" class="btn btn-gradient-light rounded-pill px-4 py-2.5 fw-bold shadow-sm">
                    <i class="fa-solid fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- 2. Main Card Informasi Produk -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4" style="border: 1px solid #e2e8f0 !important;">
        <div class="card-header card-header-slate d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 fs-6">
                <i class="fa-solid fa-list-check text-slate-500 me-2"></i>Informasi Detail Produk
            </h5>
            <span class="badge bg-white text-dark border rounded-pill px-3 py-1.5 fw-bold" style="font-size: 0.75rem;">
                Status Active
            </span>
        </div>

        <div class="card-body p-4 p-md-5">
            <div class="row g-4 align-items-center">

                <!-- Preview Foto Produk -->
                <div class="col-lg-5 text-center">
                    <div class="product-img-wrapper d-flex flex-column align-items-center justify-content-center shadow-sm">
                        @if($produk->foto)
                            <img src="{{ asset('storage/' . $produk->foto) }}"
                                 alt="{{ $produk->nama }}"
                                 class="detail-product-img">
                        @else
                            <div class="py-5 text-muted">
                                <i class="fa-solid fa-image fa-4x mb-3 text-slate-400 opacity-50"></i>
                                <p class="mb-0 small fw-bold">Tidak ada foto produk</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Detail Atribut Produk -->
                <div class="col-lg-7">
                    <div class="ps-lg-3">
                        <table class="table table-borderless align-middle mb-0">
                            <tbody>
                                <!-- Nama Produk -->
                                <tr class="border-bottom" style="border-color: #f1f5f9 !important;">
                                    <th width="180" class="info-label py-3">
                                        <i class="fa-solid fa-tag me-2 text-slate-400"></i>Nama Produk
                                    </th>
                                    <td class="py-3 fs-5 fw-bold text-dark">
                                        {{ $produk->nama }}
                                    </td>
                                </tr>

                                <!-- Harga Beli -->
                                <tr class="border-bottom" style="border-color: #f1f5f9 !important;">
                                    <th class="info-label py-3">
                                        <i class="fa-solid fa-wallet me-2 text-slate-400"></i>Harga Beli
                                    </th>
                                    <td class="py-3">
                                        <span class="fw-bold fs-6 text-dark">
                                            Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}
                                        </span>
                                    </td>
                                </tr>

                                <!-- Harga Jual -->
                                <tr class="border-bottom" style="border-color: #f1f5f9 !important;">
                                    <th class="info-label py-3">
                                        <i class="fa-solid fa-money-bill-wave me-2 text-slate-400"></i>Harga Jual
                                    </th>
                                    <td class="py-3">
                                        <span class="fw-bold fs-6 text-success">
                                            Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}
                                        </span>
                                    </td>
                                </tr>

                                <!-- Stok Produk -->
                                <tr class="border-bottom" style="border-color: #f1f5f9 !important;">
                                    <th class="info-label py-3">
                                        <i class="fa-solid fa-cubes me-2 text-slate-400"></i>Stok
                                    </th>
                                    <td class="py-3">
                                        @if($produk->stok <= 10)
                                            <span class="badge badge-soft-danger border border-danger-subtle rounded-pill px-3 py-1.5 fw-bold fs-6">
                                                {{ $produk->stok }}
                                            </span>
                                        @elseif($produk->stok <= 30)
                                            <span class="badge badge-soft-warning border border-warning-subtle rounded-pill px-3 py-1.5 fw-bold fs-6">
                                                {{ $produk->stok }}
                                            </span>
                                        @else
                                            <span class="badge badge-soft-success border border-success-subtle rounded-pill px-3 py-1.5 fw-bold fs-6">
                                                {{ $produk->stok }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>

                                <!-- User Penginput -->
                                <tr>
                                    <th class="info-label py-3">
                                        <i class="fa-solid fa-user me-2 text-slate-400"></i>Penginput
                                    </th>
                                    <td class="py-3 fw-bold text-dark">
                                        <i class="fa-solid fa-circle-user me-1 text-slate-400"></i>
                                        {{ $produk->user->name ?? 'System' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection