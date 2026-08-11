@extends('layouts.app')

@section('title', 'Edit Produk')

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
    .hero-banner-edit-produk {
        background: linear-gradient(135deg, #334155 0%, #475569 100%);
        border-radius: 20px;
        color: white;
        padding: 2.2rem;
        box-shadow: 0 10px 25px -5px rgba(51, 65, 85, 0.25);
    }

    .hero-banner-edit-produk .text-white-50 {
        color: #94a3b8 !important;
    }

    /* Styling Kartu Form */
    .form-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        overflow: hidden;
    }

    .form-card-header {
        background-color: #f8fafc;
        color: #1e293b;
        border-bottom: 1px solid #e2e8f0 !important;
        border-radius: 20px 20px 0 0 !important;
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
    <div class="hero-banner-edit-produk mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 bg-white bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-pen-to-square fa-2x text-white"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-0">Edit Produk</h2>
                        <p class="mb-0 text-white-50">Perbarui data informasi produk dalam sistem POS</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('produk.index') }}" 
                   class="btn btn-gradient-light rounded-pill px-4 py-2.5 fw-bold shadow-sm">
                    <i class="fa-solid fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- 2. Form Card Container -->
    <div class="card form-card mb-4">
        <div class="form-card-header d-flex align-items-center">
            <i class="fa-solid fa-box-open text-slate-500 me-2 fs-5"></i>
            <h5 class="fw-bold mb-0">Form Edit Produk</h5>
        </div>
        
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('produk.update', $produk) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                @include('Produk._form')

            </form>
        </div>
    </div>

</div>

@endsection