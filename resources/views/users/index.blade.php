@extends('layouts.app')

@section('title', 'Users')

@section('content')

@include('layouts.navbar')

<!-- CDN FontAwesome untuk Icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body {
        background-color: #f3f4f6;
    }
    
    /* Hero Header Banner Colorful untuk Users (Aksen Oranye-Merah-Pink) */
    .hero-banner-users {
        background: linear-gradient(135deg, #f97316 0%, #ef4444 50%, #ec4899 100%);
        border-radius: 20px;
        color: white;
        padding: 2rem;
        box-shadow: 0 10px 25px -5px rgba(249, 115, 22, 0.4);
    }

    /* Form Pencarian Modern */
    .search-card {
        background: #ffffff;
        border: 2px solid #e5e7eb;
        border-radius: 16px;
        transition: all 0.3s ease;
    }
    .search-card:focus-within {
        border-color: #f97316;
        box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.15);
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
        color: #ea580c;
        transform: translateY(-2px);
    }

    .btn-gradient-orange {
        background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
        color: white;
        border: none;
    }
    .btn-gradient-orange:hover {
        background: linear-gradient(135deg, #ea580c 0%, #c2410c 100%);
        color: white;
    }

    /* Table Header Gradient */
    .table-header-gradient {
        background: linear-gradient(90deg, #ea580c 0%, #dc2626 100%);
        color: white;
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
    <div class="hero-banner-users mb-4">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="p-3 bg-white bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-users-gear fa-2x text-white"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-0">Halaman Users</h2>
                        <p class="mb-0 text-white-50">Kelola data hak akses dan akun pengguna aplikasi POS</p>
                    </div>
                </div>
            </div>
            <div class="col-md-5 text-md-end mt-3 mt-md-0">
                <a href="{{ route('admin.users.create') }}" 
                   class="btn btn-gradient-light rounded-pill px-4 py-2.5 fw-bold shadow-sm">
                    <i class="fa-solid fa-user-plus me-2"></i>Create User
                </a>
            </div>
        </div>
    </div>

    <!-- 2. Colorful Search Box Section -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">
            <form action="{{ route('admin.users') }}" method="GET">
                <div class="input-group search-card p-1">
                    <span class="input-group-text bg-transparent border-0 text-danger ps-3">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        class="form-control border-0 shadow-none bg-transparent" 
                        placeholder="Search username or email...">
                    <button class="btn btn-gradient-orange rounded-3 px-4 fw-bold" type="submit">
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
                <i class="fa-solid fa-users text-white me-2"></i>Daftar Users
            </h5>
            <span class="badge bg-white text-dark rounded-pill px-3 py-2 fw-bold">
                Total: {{ $users->total() }} User
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary text-uppercase fs-7">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th class="text-center" width="200">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <td class="ps-4 fw-bold text-muted">{{ $users->firstItem() + $loop->index }}</td>
                        
                        <td>
                            <span class="fw-bold text-dark">
                                <i class="fa-solid fa-circle-user text-secondary me-1"></i>{{ $user->name }}
                            </span>
                        </td>

                        <td>
                            <span class="text-muted">
                                <i class="fa-regular fa-envelope me-1"></i>{{ $user->email }}
                            </span>
                        </td>

                        <td>
                            @if($user->role->name == 'admin')
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1 fw-bold">
                                    <i class="fa-solid fa-user-shield me-1"></i>Admin
                                </span>
                            @else
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fw-bold">
                                    <i class="fa-solid fa-cash-register me-1"></i>Kasir
                                </span>
                            @endif
                        </td>

                        <td class="text-center">
                            <div class="d-inline-flex gap-1">
                                <a href="{{ route('admin.users.edit', $user) }}" 
                                   class="btn btn-warning btn-action-text text-dark shadow-sm">
                                    Edit
                                </a>

                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-action-text text-white shadow-sm" 
                                            onclick="return confirm('Yakin hapus user ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-user-slash fa-3x mb-3 text-secondary opacity-50"></i>
                            <p class="mb-0">Data user tidak ditemukan.</p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-end">
        {{ $users->links() }}
    </div>

</div>

@endsection