@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')

@include('layouts.navbar')

<!-- CDN FontAwesome untuk Icon Modern -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body {
        background-color: #f3f4f6;
    }

    /* Hero Banner Gradien Oranye-Merah-Pink (Persis Halaman Users) */
    .hero-banner-create-user {
        background: linear-gradient(135deg, #ff6b35 0%, #e63946 50%, #d62828 100%);
        border-radius: 20px;
        color: white;
        padding: 2rem;
        box-shadow: 0 10px 25px -5px rgba(230, 57, 70, 0.4);
    }

    /* Header Form Card */
    .bg-gradient-header {
        background: linear-gradient(90deg, #e63946 0%, #d62828 100%);
        color: white;
    }

    /* Style Tombol Kembali Header */
    .btn-gradient-light {
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(8px);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.4);
        transition: all 0.3s ease;
    }
    .btn-gradient-light:hover {
        background: white;
        color: #d62828;
        transform: translateY(-2px);
    }
</style>

<div class="container py-4">

    <!-- 1. Hero Header Section -->
    <div class="hero-banner-create-user mb-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="p-3 bg-white bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-user-plus fa-2x text-white"></i>
                </div>
                <div>
                    <h2 class="fw-bold mb-0">Tambah User Baru</h2>
                    <p class="mb-0 text-white-50">Isi formulir di bawah untuk menambahkan pengguna baru ke sistem POS</p>
                </div>
            </div>
            <div>
                <!-- Menggunakan route('admin.users') sesuai konfigurasi route Anda -->
                <a href="{{ route('admin.users') }}" 
                   class="btn btn-gradient-light rounded-pill px-4 py-2 fw-bold shadow-sm">
                    <i class="fa-solid fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- 2. Alert Validasi Error Global -->
    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 alert-dismissible fade show">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-triangle-exclamation fa-lg me-3"></i>
                <div>
                    <strong>Terjadi Kesalahan!</strong> Mohon periksa kembali inputan formulir Anda.
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- 3. Form Card Container -->
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-gradient-header py-3 px-4 border-0 d-flex align-items-center">
                    <i class="fa-solid fa-id-card me-2 fs-5 text-white"></i>
                    <h6 class="fw-bold mb-0 text-white">Formulir Pendaftaran User Baru</h6>
                </div>
                
                <div class="card-body p-4 p-md-5 bg-white">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf

                        {{-- Memanggil Partial Form --}}
                        @include('users._form')

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection