@extends('layouts.app')

@section('title', 'Penjualan')

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

    /* Styling Box Pencarian */
    .search-card {
        background: #ffffff;
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        transition: all 0.3s ease;
    }
    .search-card:focus-within {
        border-color: #475569;
        box-shadow: 0 0 0 4px rgba(51, 65, 85, 0.12);
    }

    /* Button Transparan Header */
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

    /* Button Slate Grey */
    .btn-gradient-slate {
        background: linear-gradient(135deg, #334155 0%, #475569 100%);
        color: white;
        border: none;
        transition: all 0.3s ease;
    }
    .btn-gradient-slate:hover {
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        color: white;
    }

    /* Header Table Card */
    .card-header-slate {
        background-color: #f8fafc;
        color: #1e293b;
        border-bottom: 1px solid #e2e8f0 !important;
        padding: 1.25rem 1.5rem;
    }

    /* --- SKEMA TOMBOL AKSI SEJAJAR --- */
    .action-grid {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        gap: 6px; /* Jarak presisi antar tombol */
        width: 100%;
    }

    /* Menghilangkan margin bawaan tag form agar tidak merusak alignment Flexbox */
    .action-grid form {
        margin: 0 !important;
        padding: 0 !important;
        display: inline-flex;
    }

    /* Tampilan Utama Tombol Aksi (Gaya Produk / Pill Outlined) */
    .btn-action-outline {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 85px;            /* Lebar tombol seragam */
        height: 32px;           /* Tinggi tombol seragam */
        font-size: 0.8rem;
        font-weight: 700;
        border-radius: 50rem;   /* Bentuk lonjong membulat */
        background-color: #ffffff;
        text-decoration: none;
        cursor: pointer;
        box-sizing: border-box;
        line-height: 1;
        white-space: nowrap;
        transition: all 0.2s ease-in-out;
    }

    /* Warna Border Grey (Detail & Edit) */
    .btn-outline-slate {
        border: 1.5px solid #94a3b8;
        color: #475569;
    }
    .btn-outline-slate:hover {
        background-color: #f8fafc;
        border-color: #475569;
        color: #0f172a;
    }

    /* Warna Border Merah (Hapus) */
    .btn-outline-danger-custom {
        border: 1.5px solid #f87171;
        color: #ef4444;
    }
    .btn-outline-danger-custom:hover {
        background-color: #fef2f2;
        border-color: #dc2626;
        color: #b91c1c;
    }
</style>

<div class="container py-4">

    <!-- Alert Notifikasi -->
    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 alert-dismissible fade show">
            <i class="fa-solid fa-circle-exclamation me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 alert-dismissible fade show">
            <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- 1. Hero Header Section -->
    <div class="hero-banner-sales mb-4">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-box-banner">
                        <i class="fa-solid fa-receipt fa-2x text-white"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-1">Halaman Penjualan</h2>
                        <p class="mb-0 text-white-50">Kelola dan pantau seluruh riwayat transaksi kasir POS</p>
                    </div>
                </div>
            </div>
            <div class="col-md-5 text-md-end mt-3 mt-md-0">
                <a href="{{ route('penjualan.create') }}" 
                   class="btn btn-gradient-light rounded-pill px-4 py-2.5 fw-bold shadow-sm">
                    <i class="fa-solid fa-plus-circle me-2"></i>Tambah Penjualan
                </a>
            </div>
        </div>
    </div>

    <!-- 2. Search Box Section -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="border: 1px solid #e2e8f0 !important;">
        <div class="card-body p-3">
            <form action="{{ route('penjualan.index') }}" method="GET">
                <div class="input-group search-card p-1">
                    <span class="input-group-text bg-transparent border-0 text-slate-500 ps-3">
                        <i class="fa-solid fa-magnifying-glass text-secondary"></i>
                    </span>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request()->search }}" 
                        class="form-control border-0 shadow-none bg-transparent" 
                        placeholder="Cari penjualan berdasarkan nama kasir...">
                    <button class="btn btn-gradient-slate rounded-3 px-4 fw-bold" type="submit">
                        Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 3. Data Table Section -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4" style="border: 1px solid #e2e8f0 !important;">
        
        <div class="card-header card-header-slate d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 fs-6">
                <i class="fa-solid fa-list-check text-slate-500 me-2"></i>Daftar Penjualan
            </h5>
            <span class="badge bg-white text-dark border rounded-pill px-3 py-1.5 fw-bold" style="font-size: 0.75rem;">
                Total: {{ $sales->total() }} Transaksi
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-slate-50 text-uppercase fs-7" style="background-color: #f8fafc; color: #64748b;">
                    <tr>
                        <th class="ps-4 py-3">#</th>
                        <th class="py-3">Tanggal Transaksi</th>
                        <th class="py-3">Kasir</th>
                        <th class="py-3">Total Pembayaran</th>
                        <th class="py-3">Metode Pembayaran</th>
                        <th class="py-3">Status</th>
                        <th class="text-center py-3" width="290">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($sales as $sale)
                    <tr class="border-bottom" style="border-color: #f1f5f9 !important;">
                        <td class="ps-4 fw-bold text-muted">{{ $sales->firstItem() + $loop->index }}</td>
                        
                        <td class="fw-semibold text-dark">
                            <i class="fa-regular fa-clock text-slate-400 me-1"></i>
                            {{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}
                        </td>

                        <td>
                            <span class="fw-semibold text-dark">
                                <i class="fa-solid fa-user-tie text-slate-400 me-1"></i>
                                {{ $sale->user?->name ?? 'Pengguna Terhapus' }}
                            </span>
                        </td>

                        <td class="fw-bold text-success">
                            Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                        </td>

                        <td>
                            @if($sale->metode_pembayaran == 'CASH')
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fw-bold">
                                    <i class="fa-solid fa-money-bill-wave me-1"></i>CASH
                                </span>
                            @elseif($sale->metode_pembayaran == 'QRIS')
                                <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle rounded-pill px-3 py-1 fw-bold">
                                    <i class="fa-solid fa-qrcode me-1"></i>QRIS
                                </span>
                            @else
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1 fw-bold">
                                    <i class="fa-solid fa-building-columns me-1"></i>TRANSFER
                                </span>
                            @endif
                        </td>

                        <td>
                            @if($sale->status == 'COMPLETED')
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fw-bold">
                                    <i class="fa-solid fa-circle-check me-1"></i>COMPLETED
                                </span>
                            @else
                                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-3 py-1 fw-bold">
                                    <i class="fa-solid fa-clock-rotate-left me-1"></i>OPEN
                                </span>
                            @endif
                        </td>

                        <td class="text-center">
                            <div class="action-grid">
                                <a href="{{ route('penjualan.show', $sale) }}" 
                                   class="btn-action-outline btn-outline-slate">
                                    Detail
                                </a>

                                @can('view', $sale)
                                <a href="{{ route('penjualan.edit', $sale) }}" 
                                   class="btn-action-outline btn-outline-slate">
                                    Lanjutkan
                                </a>
                                @endcan

                                @can('delete', $sale)
                                <form action="{{ route('penjualan.destroy', $sale) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn-action-outline btn-outline-danger-custom" 
                                            onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                                        Hapus
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-receipt fa-3x mb-3 text-slate-400 opacity-50"></i>
                            <p class="mb-0 fw-bold">Data penjualan tidak ditemukan.</p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-end">
        {{ $sales->links() }}
    </div>

</div>

@endsection