@extends('layouts.app')

@section('title', 'Login')

@section('content')

<!-- FontAwesome untuk Icon Field -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* Paksa body & html benar-benar full screen tanpa margin */
    html, body {
        height: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        overflow-x: hidden;
        background-color: #e2e8f0;
    }

    /* Override pembatas container bawaan layout.app */
    .container, .container-fluid {
        padding-left: 0 !important;
        padding-right: 0 !important;
        max-width: 100% !important;
    }

    /* Full Screen Wrapper dengan Background Terang & Depth 3D */
    .login-container-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: radial-gradient(circle at 10% 20%, #f1f5f9 0%, #e2e8f0 40%, #cbd5e1 100%);
        z-index: 9999;
        padding: 20px;
    }

    /* Element Dekorasi 3D Latar Belakang Floating */
    .bg-shape-1 {
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.8), rgba(203, 213, 225, 0.4));
        top: 10%;
        left: 15%;
        box-shadow: 0 20px 40px rgba(148, 163, 184, 0.3);
        filter: blur(2px);
    }

    .bg-shape-2 {
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 40px;
        background: linear-gradient(135deg, rgba(71, 85, 105, 0.15), rgba(255, 255, 255, 0.5));
        bottom: 12%;
        right: 15%;
        transform: rotate(25deg);
        box-shadow: 0 15px 35px rgba(100, 116, 139, 0.25);
    }

    /* Card Wrapper */
    .login-wrapper {
        width: 100%;
        max-width: 420px;
        position: relative;
        z-index: 10;
    }

    /* Card Login Modern Efek 3D */
    .login-card {
        background: #ffffff;
        border-radius: 28px;
        overflow: hidden;
        /* Double Shadow untuk Efek Timbul 3D */
        box-shadow: 
            0 20px 40px -10px rgba(51, 65, 85, 0.2), 
            0 10px 15px -5px rgba(51, 65, 85, 0.1),
            inset 0 2px 0 rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(226, 232, 240, 0.8);
        transition: transform 0.3s ease;
    }

    /* Header Card - Slate Grey Gradient Soft */
    .login-header {
        background: linear-gradient(135deg, #334155 0%, #475569 100%);
        color: white;
        padding: 35px 25px 30px;
        text-align: center;
        box-shadow: 0 8px 15px rgba(51, 65, 85, 0.15);
    }

    /* Icon 3D Box Timbul */
    .login-header .brand-icon {
        width: 65px;
        height: 65px;
        background: linear-gradient(145deg, rgba(255, 255, 255, 0.25), rgba(255, 255, 255, 0.08));
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 14px;
        box-shadow: 
            0 10px 20px rgba(15, 23, 42, 0.25),
            inset 0 2px 2px rgba(255, 255, 255, 0.4);
    }

    .login-header h3 {
        margin: 0;
        font-weight: 800;
        font-size: 1.55rem;
        letter-spacing: 0.5px;
    }

    .login-header p {
        margin: 6px 0 0;
        color: #cbd5e1;
        font-size: 0.875rem;
    }

    /* Body Card Form */
    .login-body {
        padding: 35px 30px;
        background: #ffffff;
    }

    .form-label {
        font-weight: 700;
        color: #475569;
        font-size: 0.825rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Input Custom dengan Soft Inset Shadow (Efek Cekung 3D) */
    .input-group-custom {
        position: relative;
    }

    .input-group-custom .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        z-index: 10;
        transition: all 0.3s ease;
    }

    .form-control-custom {
        height: 52px;
        border-radius: 16px;
        padding-left: 48px;
        border: 1.5px solid #cbd5e1;
        background-color: #f8fafc;
        font-weight: 600;
        color: #1e293b;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.04);
        transition: all 0.25s ease;
    }

    .form-control-custom:focus {
        background-color: #ffffff;
        border-color: #475569;
        box-shadow: 
            inset 0 1px 2px rgba(0, 0, 0, 0.02),
            0 0 0 4px rgba(71, 85, 105, 0.15);
    }

    .form-control-custom:focus + .input-icon {
        color: #334155;
    }

    /* Tombol Login 3D Tactile Button */
    .btn-login {
        width: 100%;
        height: 52px;
        border-radius: 16px;
        font-weight: 700;
        font-size: 1rem;
        background: linear-gradient(180deg, #475569 0%, #334155 100%);
        color: white;
        border: none;
        /* Bevel & Depth Shadow 3D */
        box-shadow: 
            0 5px 0 #1e293b,
            0 10px 20px rgba(30, 41, 59, 0.25);
        transition: all 0.15s ease;
        position: relative;
        top: 0;
    }

    .btn-login:hover {
        background: linear-gradient(180deg, #334155 0%, #1e293b 100%);
        color: white;
        top: 2px;
        box-shadow: 
            0 3px 0 #0f172a,
            0 6px 14px rgba(15, 23, 42, 0.3);
    }

    .btn-login:active {
        top: 5px;
        box-shadow: 
            0 0 0 #0f172a,
            0 2px 6px rgba(15, 23, 42, 0.3);
    }

    /* Alert Pesan Sukses Logout / Error Session */
    .alert-custom {
        border-radius: 16px;
        border: none;
        background: #ffffff;
        box-shadow: 0 10px 25px rgba(51, 65, 85, 0.15);
    }
</style>

<!-- Fixed Container Full Layar Browser -->
<div class="login-container-wrapper">

    <!-- Elemen Dekorasi Latar Belakang 3D -->
    <div class="bg-shape-1 d-none d-md-block"></div>
    <div class="bg-shape-2 d-none d-md-block"></div>

    <div class="login-wrapper">

        <!-- Flash Alert jika Logout / Notification -->
        @if(session('success'))
            <div class="alert alert-success alert-custom alert-dismissible fade show mb-3 p-3 d-flex align-items-center gap-2" role="alert">
                <i class="fa-solid fa-circle-check text-success fs-5"></i>
                <div class="fw-semibold text-dark small">{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-custom alert-dismissible fade show mb-3 p-3 d-flex align-items-center gap-2" role="alert">
                <i class="fa-solid fa-circle-exclamation text-danger fs-5"></i>
                <div class="fw-semibold text-dark small">{{ session('error') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Card Login 3D -->
        <div class="login-card">

            <!-- Header Card -->
            <div class="login-header">
                <div class="brand-icon">
                    <i class="fa-solid fa-store fa-2x text-white"></i>
                </div>
                <h3>SyntezOfficial</h3>
                <p class="mb-0">Sistem Kasir & Point Of Sale</p>
            </div>

            <!-- Body Form -->
            <div class="login-body">

                <form action="{{ route('auth') }}" method="POST">
                    @csrf

                    <!-- Input Email -->
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <div class="input-group-custom">
                            <input 
                                type="email" 
                                name="email" 
                                class="form-control form-control-custom @error('email') is-invalid @enderror"
                                placeholder="Masukkan email"
                                value="{{ old('email') }}"
                                required
                                autofocus>
                            <i class="fa-solid fa-envelope input-icon"></i>
                        </div>

                        @error('email')
                            <div class="text-danger small mt-1.5 fw-semibold ms-1">
                                <i class="fa-solid fa-circle-xmark me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Input Password -->
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <div class="input-group-custom">
                            <input 
                                type="password" 
                                name="password" 
                                class="form-control form-control-custom @error('password') is-invalid @enderror"
                                placeholder="Masukkan password"
                                required>
                            <i class="fa-solid fa-lock input-icon"></i>
                        </div>

                        @error('password')
                            <div class="text-danger small mt-1.5 fw-semibold ms-1">
                                <i class="fa-solid fa-circle-xmark me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Tombol Submit 3D -->
                    <button type="submit" class="btn btn-login d-flex align-items-center justify-content-center gap-2">
                        <span>Login</span>
                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection