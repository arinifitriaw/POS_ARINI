@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')

@include('layouts.navbar')

<!-- CDN FontAwesome untuk Icon Modern -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body {
        /* Background aplikasi Slate Grey sangat muda */
        background-color: #f1f5f9;
        color: #334155;
    }

    /* Hero Header Banner - Tema Slate Grey Modern */
    .hero-banner-create-user {
        background: linear-gradient(135deg, #334155 0%, #475569 100%);
        border-radius: 24px;
        color: white;
        padding: 2rem 2.5rem;
        box-shadow: 0 10px 25px -5px rgba(51, 65, 85, 0.25);
    }

    .hero-banner-create-user .text-white-50 {
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

    /* Styling Kartu Form */
    .form-card {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        overflow: hidden;
    }

    .form-card-header {
        background-color: #f8fafc;
        color: #1e293b;
        border-bottom: 1px solid #e2e8f0 !important;
        padding: 1.25rem 1.5rem;
    }

    /* Style Tombol Kembali Header */
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
</style>

<div class="container py-4">

    <!-- 1. Hero Header Section - Slate Grey Theme -->
    <div class="hero-banner-create-user mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-box-banner">
                        <i class="fa-solid fa-user-pen fa-2x text-white"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-1">Edit User</h2>
                        <p class="mb-0 text-white-50">Perbarui informasi dan hak akses pengguna di bawah ini</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('admin.users') }}" 
                   class="btn btn-gradient-light rounded-pill px-4 py-2.5 fw-bold shadow-sm">
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
                    <strong>Terjadi Kesalahan!</strong> Mohon periksa kembali inputan form Anda.
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- 3. Form Card Container -->
    <div class="card form-card mb-4" style="border: 1px solid #e2e8f0 !important;">
        <div class="form-card-header d-flex align-items-center">
            <i class="fa-solid fa-id-card text-slate-500 me-2 fs-5"></i>
            <h5 class="fw-bold mb-0 fs-6">Formulir Data Pengguna</h5>
        </div>
        
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                
                {{-- Memanggil Partial Form --}}
                @include('users._form')

            </form>
        </div>
    </div>

</div>

@endsection