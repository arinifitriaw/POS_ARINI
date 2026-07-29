@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')

@include('layouts.navbar')

<!-- FontAwesome untuk Icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body {
        background-color: #f8fafc;
    }

    /* Hero Banner Gradient Ungu - Pink (Persis seperti UI Gambar) */
    .hero-banner-purple {
        background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 50%, #ec4899 100%);
        border-radius: 24px;
        color: white;
        padding: 2rem 2.5rem;
        box-shadow: 0 10px 25px -5px rgba(139, 92, 246, 0.3);
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

    /* Header Card Tabel/Detail (Ungu Solid seperti 'Daftar Produk') */
    .card-header-purple {
        background: linear-gradient(90deg, #6366f1 0%, #7c3aed 100%);
        color: white;
        padding: 1rem 1.5rem;
        border-top-left-radius: 16px !important;
        border-top-right-radius: 16px !important;
    }

    /* Button Transparan di Banner */
    .btn-gradient-light {
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(8px);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.4);
        transition: all 0.3s ease;
    }
    .btn-gradient-light:hover {
        background: white;
        color: #7c3aed;
    }

    /* Card Wrapper Foto */
    .product-img-wrapper {
        background: #f1f5f9;
        border: 2px dashed #cbd5e1;
        border-radius: 20px;
        padding: 1.25rem;
    }

    /* Format Label Informasi */
    .info-label {
        color: #64748b;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Soft Badges Warna Stok & Harga */
    .badge-soft-cyan {
        background-color: #0ea5e9;
        color: #ffffff;
    }
    .badge-soft-warning {
        background-color: #fef08a;
        color: #854d0e;
    }
    .badge-soft-success {
        background-color: #d1fae5;
        color: #065f46;
    }
    .badge-soft-danger {
        background-color: #ffe4e6;
        color: #9f1239;
    }
</style>

<div class="container py-4">

    <!-- 1. Banner Header (Diselaraskan dengan Banner 'Halaman Product') -->
    <div class="hero-banner-purple mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-box-banner">
                        <i class="fa-solid fa-box-archive fa-2x text-white"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-1">Detail Product</h2>
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
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header card-header-purple d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 fs-6">
                <i class="fa-solid fa-list-check me-2"></i>Informasi Detail Produk
            </h5>
            <span class="badge bg-white text-dark rounded-pill px-3 py-1.5 fw-bold" style="font-size: 0.75rem;">
                Status Active
            </span>
        </div>

        <div class="card-body p-4">
            <div class="row g-4 align-items-center">

                <!-- Preview Foto Produk -->
                <div class="col-lg-4 text-center">
                    <div class="product-img-wrapper d-flex flex-column align-items-center justify-content-center">
                        @if($produk->foto)
                            <img src="{{ asset('storage/' . $produk->foto) }}"
                                 alt="{{ $produk->nama }}"
                                 class="img-fluid rounded-4 shadow-sm"
                                 style="max-height: 280px; width: 100%; object-fit: cover;">
                        @else
                            <div class="py-5 text-muted">
                                <i class="fa-solid fa-image fa-4x mb-3 opacity-25" style="color: #7c3aed;"></i>
                                <p class="mb-0 small fw-bold">Tidak ada foto produk</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Detail Atribut Produk -->
                <div class="col-lg-8">
                    <div class="ps-lg-3">
                        <table class="table table-borderless align-middle mb-0">
                            <tbody>
                                <!-- Nama Produk -->
                                <tr class="border-bottom">
                                    <th width="180" class="info-label py-3">
                                        <i class="fa-solid fa-tag me-2 text-primary"></i>Nama Produk
                                    </th>
                                    <td class="py-3 fs-5 fw-bold text-dark">
                                        {{ $produk->nama }}
                                    </td>
                                </tr>

                                <!-- Harga Beli -->
                                <tr class="border-bottom">
                                    <th class="info-label py-3">
                                        <i class="fa-solid fa-wallet me-2 text-secondary"></i>Harga Beli
                                    </th>
                                    <td class="py-3">
                                        <span class="fw-bold fs-6 text-dark">
                                            Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}
                                        </span>
                                    </td>
                                </tr>

                                <!-- Harga Jual -->
                                <tr class="border-bottom">
                                    <th class="info-label py-3">
                                        <i class="fa-solid fa-money-bill-wave me-2 text-success"></i>Harga Jual
                                    </th>
                                    <td class="py-3">
                                        <span class="fw-bold fs-6 text-dark">
                                            Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}
                                        </span>
                                    </td>
                                </tr>

                                <!-- Stok Produk (Menggunakan Style Badge Bulat Kuning/Hijau khas UI Gambar Anda) -->
                                <tr class="border-bottom">
                                    <th class="info-label py-3">
                                        <i class="fa-solid fa-cubes me-2 text-warning"></i>Stok
                                    </th>
                                    <td class="py-3">
                                        @if($produk->stok <= 10)
                                            <span class="badge badge-soft-danger rounded-pill px-3 py-1.5 fw-bold fs-6">
                                                {{ $produk->stok }}
                                            </span>
                                        @elseif($produk->stok <= 30)
                                            <span class="badge badge-soft-warning rounded-pill px-3 py-1.5 fw-bold fs-6">
                                                {{ $produk->stok }}
                                            </span>
                                        @else
                                            <span class="badge badge-soft-success rounded-pill px-3 py-1.5 fw-bold fs-6">
                                                {{ $produk->stok }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>

                                <!-- User Penginput -->
                                <tr>
                                    <th class="info-label py-3">
                                        <i class="fa-solid fa-user me-2 text-info"></i>Penginput
                                    </th>
                                    <td class="py-3 fw-bold text-dark">
                                        <i class="fa-solid fa-circle-user me-1 text-secondary"></i>
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