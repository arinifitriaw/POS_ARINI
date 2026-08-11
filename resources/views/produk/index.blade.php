@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')

@include('layouts.navbar')

<!-- CDN FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body {
        background-color: #f1f5f9;
        color: #334155;
    }
    
    /* Hero Header Banner Slate Grey Monokrom */
    .hero-banner {
        background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #475569 100%);
        border-radius: 20px;
        color: white;
        padding: 2.2rem;
        box-shadow: 0 10px 25px -5px rgba(30, 41, 59, 0.25);
    }

    .hero-banner .text-white-50 {
        color: #cbd5e1 !important;
    }

    /* Form Pencarian Modern */
    .search-card {
        background: #ffffff;
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        transition: all 0.3s ease;
    }
    .search-card:focus-within {
        border-color: #64748b;
        box-shadow: 0 0 0 4px rgba(100, 116, 139, 0.15);
    }

    /* Custom Grey Buttons */
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

    .btn-dark-gray {
        background-color: #334155;
        color: white;
        border: none;
        transition: all 0.3s ease;
    }
    .btn-dark-gray:hover {
        background-color: #0f172a;
        color: white;
    }

    /* Card Produk styling */
    .product-card {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        border: 1px solid #e2e8f0 !important;
        background: #ffffff;
    }
    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 25px -5px rgba(51, 65, 85, 0.1) !important;
    }

    /* Mengubah object-fit menjadi contain agar foto kelihatan full */
    .product-card-img {
        height: 190px;
        object-fit: contain;
        width: 100%;
        background-color: #f8fafc;
        border-radius: 16px 16px 0 0;
        padding: 8px;
    }

    .product-card-placeholder {
        height: 190px;
        background-color: #f8fafc;
        border-radius: 16px 16px 0 0;
    }

    .fs-7 {
        font-size: 0.825rem;
    }

    /* Style Judul Supaya Tidak Terpotong */
    .product-title {
        word-wrap: break-word;
        overflow-wrap: break-word;
        white-space: normal;
        line-height: 1.4;
        min-height: 2.8rem;
    }

    /* Custom Badges Monokrom Abu-abu */
    .badge-grey-dark {
        background-color: #0f172a;
        color: #ffffff;
    }

    .badge-grey-medium {
        background-color: #475569;
        color: #ffffff;
    }

    .badge-grey-light {
        background-color: #94a3b8;
        color: #ffffff;
    }

    /* Custom Outline Button Monokrom untuk Hapus */
    .btn-outline-slate-danger {
        color: #334155;
        border-color: #94a3b8;
        transition: all 0.2s ease;
    }
    .btn-outline-slate-danger:hover {
        background-color: #0f172a;
        border-color: #0f172a;
        color: #ffffff;
    }
</style>

<div class="container py-4">

    <!-- 1. Hero Header Section -->
    <div class="hero-banner mb-4">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 bg-white bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-box-archive fa-2x text-white"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-0">Halaman Produk</h2>
                        <p class="mb-0 text-white-50">Kelola data produk aplikasi POS</p>
                    </div>
                </div>
            </div>
            <div class="col-md-5 text-md-end mt-3 mt-md-0">
                @can('create', App\Models\Produk::class)
                <a href="{{ route('produk.create') }}" 
                   class="btn btn-gradient-light rounded-pill px-4 py-2.5 fw-bold shadow-sm">
                    <i class="fa-solid fa-plus-circle me-2"></i>Tambah Produk
                </a>
                @endcan
            </div>
        </div>
    </div>

    <!-- 2. Search Box & Header Counter -->
    <div class="row align-items-center mb-4 g-3">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-2">
                    <form action="{{ route('produk.index') }}" method="GET">
                        <div class="input-group search-card p-1">
                            <span class="input-group-text bg-transparent border-0 text-secondary ps-3">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}" 
                                class="form-control border-0 shadow-none bg-transparent" 
                                placeholder="Cari nama produk...">
                            <button class="btn btn-dark-gray rounded-3 px-4 fw-bold" type="submit">
                                Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-md-end">
            <span class="badge bg-white text-secondary border shadow-sm rounded-pill px-4 py-3 fw-bold fs-6">
                <i class="fa-solid fa-boxes-stacked me-2 text-secondary"></i>Total: {{ $products->total() }} Produk
            </span>
        </div>
    </div>

    <!-- 3. Grid Produk Ke Samping -->
    <div class="row g-4 mb-4">
        @forelse ($products as $product)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow-sm rounded-4 h-100 product-card overflow-hidden">
                    
                    <!-- Foto & Badge Stok Monokrom -->
                    <div class="position-relative">
                        @if($product->foto)
                            <img src="{{ asset('storage/'.$product->foto) }}" class="product-card-img" alt="{{ $product->nama }}">
                        @else
                            <div class="product-card-placeholder d-flex flex-column align-items-center justify-content-center text-muted">
                                <i class="fa-regular fa-image fa-2x mb-1 opacity-50"></i>
                                <span class="fs-7 fw-semibold">No Image</span>
                            </div>
                        @endif

                        <div class="position-absolute top-0 end-0 m-2">
                            @if($product->stok <= 10)
                                <span class="badge badge-grey-dark rounded-pill px-3 py-1.5 fw-bold fs-7 shadow-sm">
                                    Stok: {{ $product->stok }}
                                </span>
                            @elseif($product->stok <= 30)
                                <span class="badge badge-grey-medium rounded-pill px-3 py-1.5 fw-bold fs-7 shadow-sm">
                                    Stok: {{ $product->stok }}
                                </span>
                            @else
                                <span class="badge badge-grey-light rounded-pill px-3 py-1.5 fw-bold fs-7 shadow-sm">
                                    Stok: {{ $product->stok }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Detail Informasi Produk -->
                    <div class="card-body d-flex flex-column justify-content-between p-3">
                        <div>
                            <!-- Judul Tampil Penuh -->
                            <h6 class="fw-bold text-dark product-title mb-2">
                                {{ $product->nama }}
                            </h6>
                            <p class="text-secondary fs-7 mb-3">
                                <i class="fa-solid fa-circle-user me-1 text-secondary"></i>{{ $product->user->name }}
                            </p>

                            <!-- Menampilkan Harga Jual dengan Warna Abu-abu Gelap -->
                            <div class="bg-light p-3 rounded-3 mb-3 border d-flex justify-content-between align-items-center">
                                <span class="fs-7 fw-semibold text-muted">Harga</span>
                                <span class="fw-bold text-dark fs-6">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex gap-1 pt-2 border-top">
                            @can('view', $product)
                            <a href="{{ route('produk.show', $product) }}" 
                               class="btn btn-sm btn-outline-secondary rounded-pill flex-fill fw-bold px-1">
                                Detail
                            </a>
                            @endcan

                            @can('update', $product)
                            <a href="{{ route('produk.edit', $product) }}" 
                               class="btn btn-sm btn-outline-dark rounded-pill flex-fill fw-bold px-1">
                                Edit
                            </a>
                            @endcan

                            @can('delete', $product)
                            <form action="{{ route('produk.destroy', $product) }}" method="POST" class="flex-fill">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-slate-danger rounded-pill w-100 fw-bold px-1" 
                                        onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')">
                                    Hapus
                                </button>
                            </form>
                            @endcan
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 text-center py-5">
                    <i class="fa-solid fa-box-open fa-3x mb-3 text-secondary opacity-50"></i>
                    <p class="mb-0 fw-semibold text-muted">Data produk tidak tersedia.</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-end">
        {{ $products->links() }}
    </div>

</div>

@endsection