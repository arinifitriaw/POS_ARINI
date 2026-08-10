@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')

@include('layouts.navbar')

<!-- CDN FontAwesome untuk Icon Header & Search -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body {
        background-color: #f3f4f6;
    }
    
    /* Hero Header Banner Colorful */
    .hero-banner {
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 50%, #ec4899 100%);
        border-radius: 20px;
        color: white;
        padding: 2rem;
        box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.4);
    }

    /* Form Pencarian Modern */
    .search-card {
        background: #ffffff;
        border: 2px solid #e5e7eb;
        border-radius: 16px;
        transition: all 0.3s ease;
    }
    .search-card:focus-within {
        border-color: #8b5cf6;
        box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.15);
    }

    /* Custom Gradient Buttons */
    .btn-gradient-light {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.4);
        transition: all 0.3s ease;
    }
    .btn-gradient-light:hover {
        background: white;
        color: #7c3aed;
        transform: translateY(-2px);
    }

    .btn-gradient-purple {
        background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
        color: white;
        border: none;
    }
    .btn-gradient-purple:hover {
        background: linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%);
        color: white;
    }

    /* Table Header Gradient */
    .table-header-gradient {
        background: linear-gradient(90deg, #4f46e5 0%, #7c3aed 100%);
        color: white;
    }

    .product-img {
        width: 55px;
        height: 55px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    /* Style Tombol Aksi Berteks */
    .btn-action-text {
        font-size: 0.825rem;
        font-weight: 600;
        padding: 0.35rem 0.85rem;
        border-radius: 50rem;
        transition: all 0.2s ease-in-out;
    }
    .btn-action-text:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="container py-4">

    <!-- 1. Colorful Hero Header Section -->
    <div class="hero-banner mb-4">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="p-3 bg-white bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center">
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

    <!-- 2. Colorful Search Box Section -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">
            <form action="{{ route('produk.index') }}" method="GET">
                <div class="input-group search-card p-1">
                    <span class="input-group-text bg-transparent border-0 text-purple ps-3">
                        <i class="fa-solid fa-magnifying-glass text-primary"></i>
                    </span>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        class="form-control border-0 shadow-none bg-transparent" 
                        placeholder="Search nama produk">
                    <button class="btn btn-gradient-purple rounded-3 px-4 fw-bold" type="submit">
                        Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 3. Colorful Data Table Section -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        
        <div class="card-header table-header-gradient py-3 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">
                <i class="fa-solid fa-list-check me-2"></i>Daftar Produk
            </h5>
            <span class="badge bg-white text-dark rounded-pill px-3 py-2 fw-bold">
                Total: {{ $products->total() }} Produk
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary text-uppercase fs-7">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Pengguna</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th class="text-center" width="220">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td class="ps-4 fw-bold text-muted">{{ $products->firstItem() + $loop->index }}</td>
                        <td>
                            <span class="fw-semibold text-dark">
                                <i class="fa-solid fa-circle-user text-secondary me-1"></i>{{ $product->user->name }}
                            </span>
                        </td>
                        <td>
                            @if($product->foto)
                                <img src="{{ asset('storage/'.$product->foto) }}" class="product-img" alt="{{ $product->nama }}">
                            @else
                                <div class="product-img bg-light d-flex align-items-center justify-content-center text-muted">
                                    <i class="fa-regular fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-bold text-dark">{{ $product->nama }}</td>
                        <td>Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                        <td>
                            @if($product->stok <= 10)
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1 fw-bold">
                                    {{ $product->stok }}
                                </span>
                            @elseif($product->stok <= 30)
                                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-3 py-1 fw-bold">
                                    {{ $product->stok }}
                                </span>
                            @else
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fw-bold">
                                    {{ $product->stok }}
                                </span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-inline-flex gap-1">
                                @can('view', $product)
                                <a href="{{ route('produk.show', $product) }}" 
                                   class="btn btn-info btn-action-text text-white shadow-sm">
                                    Detail
                                </a>
                                @endcan

                                @can('update', $product)
                                <a href="{{ route('produk.edit', $product) }}" 
                                   class="btn btn-warning btn-action-text text-dark shadow-sm">
                                    Edit
                                </a>
                                @endcan

                                @can('delete', $product)
                                <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-action-text text-white shadow-sm" 
                                            onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')">
                                        Hapus
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-box-open fa-3x mb-3 text-secondary opacity-50"></i>
                            <p class="mb-0">Data produk tidak tersedia.</p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-end">
        {{ $products->links() }}
    </div>

</div>

@endsection