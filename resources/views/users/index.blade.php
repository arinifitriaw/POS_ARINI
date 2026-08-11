@extends('layouts.app')

@section('title', 'Pengguna')

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
    
    /* Hero Header Banner - Tema Slate Grey Modern */
    .hero-banner-users {
        background: linear-gradient(135deg, #334155 0%, #475569 100%);
        border-radius: 24px;
        color: white;
        padding: 2rem 2.5rem;
        box-shadow: 0 10px 25px -5px rgba(51, 65, 85, 0.25);
    }

    .hero-banner-users .text-white-50 {
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

    /* --- SKEMA TOMBOL AKSI SEJAJAR & RAPI --- */
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

    /* Styling Tombol Aksi Berteks (Outlined Pill Seragam) */
    .btn-action-outline {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 82px;            /* Lebar tombol seragam */
        height: 32px;           /* Tinggi tombol seragam */
        font-size: 0.8rem;
        font-weight: 700;
        border-radius: 50rem;   /* Bentuk pill lonjong */
        background-color: #ffffff;
        text-decoration: none;
        cursor: pointer;
        box-sizing: border-box;
        line-height: 1;
        white-space: nowrap;
        transition: all 0.2s ease-in-out;
    }

    /* Warna Border Slate (Edit) */
    .btn-outline-slate {
        border: 1.5px solid #94a3b8;
        color: #475569;
    }
    .btn-outline-slate:hover {
        background-color: #f8fafc;
        border-color: #475569;
        color: #0f172a;
    }

    /* Warna Border Merah Koridor (Hapus) */
    .btn-outline-danger-custom {
        border: 1.5px solid #f87171;
        color: #ef4444;
    }
    .btn-outline-danger-custom:hover {
        background-color: #fef2f2;
        border-color: #dc2626;
        color: #b91c1c;
    }

    /* Custom Badges Monokrom Elegan */
    .badge-mono-admin {
        background-color: #e2e8f0;
        color: #1e293b;
        border: 1px solid #cbd5e1;
    }

    .badge-mono-kasir {
        background-color: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
    }

    .fs-7 {
        font-size: 0.85rem;
    }
</style>

<div class="container py-4">

    <!-- 1. Hero Header Section - Slate Grey Theme -->
    <div class="hero-banner-users mb-4">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-box-banner">
                        <i class="fa-solid fa-users-gear fa-2x text-white"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-1">Halaman Pengguna</h2>
                        <p class="mb-0 text-white-50">Kelola data hak akses dan akun pengguna aplikasi POS</p>
                    </div>
                </div>
            </div>
            <div class="col-md-5 text-md-end mt-3 mt-md-0">
                <a href="{{ route('admin.users.create') }}" 
                   class="btn btn-gradient-light rounded-pill px-4 py-2.5 fw-bold shadow-sm">
                    <i class="fa-solid fa-user-plus me-2"></i>Tambah Pengguna
                </a>
            </div>
        </div>
    </div>

    <!-- 2. Search Box Section -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="border: 1px solid #e2e8f0 !important;">
        <div class="card-body p-3">
            <form action="{{ route('admin.users') }}" method="GET">
                <div class="input-group search-card p-1">
                    <span class="input-group-text bg-transparent border-0 text-secondary ps-3">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        class="form-control border-0 shadow-none bg-transparent" 
                        placeholder="Cari username atau email...">
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
                <i class="fa-solid fa-users text-slate-500 me-2"></i>Daftar Pengguna
            </h5>
            <span class="badge bg-white text-dark border rounded-pill px-3 py-1.5 fw-bold" style="font-size: 0.75rem;">
                Total: {{ $users->total() }} User
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-slate-50 text-uppercase fs-7" style="background-color: #f8fafc; color: #64748b;">
                    <tr>
                        <th class="ps-4 py-3">#</th>
                        <th class="py-3">Nama</th>
                        <th class="py-3">Email</th>
                        <th class="py-3">Role</th>
                        <th class="text-center py-3" width="220">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr class="border-bottom" style="border-color: #f1f5f9 !important;">
                        <td class="ps-4 fw-bold text-muted">{{ $users->firstItem() + $loop->index }}</td>
                        
                        <td>
                            <span class="fw-bold text-dark">
                                <i class="fa-solid fa-circle-user text-slate-400 me-1"></i>{{ $user->name }}
                            </span>
                        </td>

                        <td>
                            <span class="text-muted">
                                <i class="fa-regular fa-envelope text-slate-400 me-1"></i>{{ $user->email }}
                            </span>
                        </td>

                        <td>
                            @if($user->role->name == 'admin')
                                <span class="badge badge-mono-admin rounded-pill px-3 py-1 fw-bold">
                                    <i class="fa-solid fa-user-shield me-1"></i>Admin
                                </span>
                            @else
                                <span class="badge badge-mono-kasir rounded-pill px-3 py-1 fw-bold">
                                    <i class="fa-solid fa-cash-register me-1"></i>Kasir
                                </span>
                            @endif
                        </td>

                        <td class="text-center">
                            <div class="action-grid">
                                <a href="{{ route('admin.users.edit', $user) }}" 
                                   class="btn-action-outline btn-outline-slate">
                                    Edit
                                </a>

                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn-action-outline btn-outline-danger-custom" 
                                            onclick="return confirm('Yakin hapus user ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted bg-white">
                            <i class="fa-solid fa-user-slash fa-3x mb-3 text-slate-400 opacity-50"></i>
                            <p class="mb-0 fw-bold">Data user tidak ditemukan.</p>
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