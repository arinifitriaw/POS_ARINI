@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

@include('layouts.navbar')

<!-- CDN FontAwesome untuk Icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body {
        background-color: #f3f4f6;
    }
    
    .hero-banner-sales {
        background: linear-gradient(135deg, #10b981 0%, #3b82f6 50%, #6366f1 100%);
        border-radius: 20px;
        color: white;
        padding: 2rem;
        box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4);
    }

    .search-card {
        background: #ffffff;
        border: 2px solid #e5e7eb;
        border-radius: 16px;
        transition: all 0.3s ease;
    }
    .search-card:focus-within {
        border-color: #10b981;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
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
        transform: translateY(-2px);
    }

    .btn-gradient-green {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border: none;
    }
    .btn-gradient-green:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        color: white;
    }

    .table-header-gradient {
        background: linear-gradient(90deg, #059669 0%, #2563eb 100%);
        color: white;
    }

    .btn-action-text {
        font-size: 0.825rem;
        font-weight: 600;
        padding: 0.35rem 0;
        width: 100%;
        text-align: center;
        border-radius: 50rem;
        transition: all 0.2s ease-in-out;
    }
    .btn-action-text:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .action-grid {
        display: inline-grid;
        grid-template-columns: repeat(3, 68px);
        gap: 6px;
        justify-content: center;
        align-items: center;
    }
</style>

<div class="container py-4">

    <!-- 🔧 PERBAIKAN: Alert Error handling (ganti errors jadi error) -->
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

    <!-- 1. Colorful Hero Header Section -->
    <div class="hero-banner-sales mb-4">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="p-3 bg-white bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-receipt fa-2x text-white"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-0">Halaman Penjualan</h2>
                        <p class="mb-0 text-white-50">Kelola dan pantau seluruh riwayat transaksi kasir POS</p>
                    </div>
                </div>
            </div>
            <div class="col-md-5 text-md-end mt-3 mt-md-0">
                <a href="{{ route('penjualan.create') }}" 
                   class="btn btn-gradient-light rounded-pill px-4 py-2.5 fw-bold shadow-sm">
                    <i class="fa-solid fa-plus-circle me-2"></i>Create Sale
                </a>
            </div>
        </div>
    </div>

    <!-- 2. Colorful Search Box Section -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">
            <form action="{{ route('penjualan.index') }}" method="GET">
                <div class="input-group search-card p-1">
                    <span class="input-group-text bg-transparent border-0 text-success ps-3">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request()->search }}" 
                        class="form-control border-0 shadow-none bg-transparent" 
                        placeholder="Search penjualan berdasarkan kasir...">
                    <button class="btn btn-gradient-green rounded-3 px-4 fw-bold" type="submit">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 3. Colorful Data Table Section -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        
        <div class="card-header table-header-gradient py-3 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">
                <i class="fa-solid fa-list-check me-2"></i>Daftar Penjualan
            </h5>
            <span class="badge bg-white text-dark rounded-pill px-3 py-2 fw-bold">
                Total: {{ $sales->total() }} Transaksi
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary text-uppercase fs-7">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Tanggal Transaksi</th>
                        <th>Kasir</th>
                        <th>Total Pembayaran</th>
                        <th>Metode Pembayaran</th>
                        <th>Status</th>
                        <th class="text-center" width="240">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($sales as $sale)
                    <tr>
                        <td class="ps-4 fw-bold text-muted">{{ $sales->firstItem() + $loop->index }}</td>
                        
                        <td class="fw-semibold text-dark">
                            <i class="fa-regular fa-clock text-secondary me-1"></i>
                            {{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}
                        </td>

                        <td>
                            <span class="fw-semibold text-dark">
                                <i class="fa-solid fa-user-tie text-secondary me-1"></i>
                                <!-- 🔧 PERBAIKAN: Tambah Optional Chaining ?-> agar tidak crash bila user null -->
                                {{ $sale->user?->name ?? 'User Terhapus' }}
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
                                   class="btn btn-info btn-action-text text-white shadow-sm">
                                    Detail
                                </a>

                                @can('view', $sale)
                                <a href="{{ route('penjualan.edit', $sale) }}" 
                                   class="btn btn-warning btn-action-text text-dark shadow-sm">
                                    Edit
                                </a>
                                @endcan

                                @can('delete', $sale)
                                <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-action-text text-white shadow-sm" 
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
                            <i class="fa-solid fa-receipt fa-3x mb-3 text-secondary opacity-50"></i>
                            <p class="mb-0">Data penjualan tidak ditemukan.</p>
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