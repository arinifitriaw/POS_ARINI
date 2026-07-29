@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

@include('layouts.navbar')

<!-- CDN FontAwesome untuk Icon Modern -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body {
        background-color: #f3f4f6;
    }

    /* Hero Header Banner Colorful untuk Tambah Produk (Aksen Indigo-Purple-Pink) */
    .hero-banner-create {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #d946ef 100%);
        border-radius: 20px;
        color: white;
        padding: 2rem;
        box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.4);
    }

    /* Styling Kartu Form */
    .form-card {
        background: #ffffff;
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .form-card-header {
        background: linear-gradient(90deg, #4f46e5 0%, #7c3aed 100%);
        color: white;
        border-radius: 20px 20px 0 0 !important;
        padding: 1.25rem 1.5rem;
    }

    /* Style Tombol Aksi */
    .btn-gradient-light {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.4);
        transition: all 0.3s ease;
    }
    .btn-gradient-light:hover {
        background: white;
        color: #4f46e5;
        transform: translateY(-2px);
    }
</style>

<div class="container py-4">

    <!-- 1. Hero Header Section -->
    <div class="hero-banner-create mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 bg-white bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-folder-plus fa-2x text-white"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-0">Tambah Produk Baru</h2>
                        <p class="mb-0 text-white-50">Isi formulir di bawah untuk menambahkan item baru ke katalog inventaris</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('produk.index') }}" 
                   class="btn btn-gradient-light rounded-pill px-4 py-2 fw-bold shadow-sm">
                    <i class="fa-solid fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- 2. Alert Validasi Error Global (Opsional) -->
    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 alert-dismissible fade show">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-triangle-exclamation fa-lg me-3"></i>
                <div>
                    <strong>Terjadi Kesalahan!</strong> Mohon periksa kembali inputan form Anda.
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- 3. Form Card Container -->
    <div class="card form-card mb-4">
        <div class="form-card-header d-flex align-items-center">
            <i class="fa-solid fa-pen-to-square me-2 fs-5"></i>
            <h5 class="fw-bold mb-0">Formulir Data Produk</h5>
        </div>
        
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('produk.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                
                {{-- Memanggil Partial Form --}}
                @include('produk._form')

            </form>
        </div>
    </div>

</div>

@endsection