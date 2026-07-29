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
    }

    /* Override pembatas container bawaan layout.app jika ada */
    .container, .container-fluid {
        padding-left: 0 !important;
        padding-right: 0 !important;
        max-width: 100% !important;
    }

    /* Fix Full Screen Wrapper dengan Position Fixed */
    .login-container-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #2563eb 0%, #7c3aed 50%, #ec4899 100%);
        z-index: 9999;
        padding: 20px;
    }

    /* Card Wrapper */
    .login-wrapper {
        width: 100%;
        max-width: 420px;
    }

    /* Card Login Modern */
    .login-card {
        background: #ffffff;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Header Card (Gradient Blue to Purple) */
    .login-header {
        background: linear-gradient(135deg, #2563eb 0%, #6366f1 100%);
        color: white;
        padding: 30px 25px;
        text-align: center;
    }

    .login-header .brand-icon {
        width: 55px;
        height: 55px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .login-header h3 {
        margin: 0;
        font-weight: 800;
        font-size: 1.5rem;
        letter-spacing: 0.5px;
    }

    .login-header p {
        margin: 4px 0 0;
        opacity: 0.85;
        font-size: 0.85rem;
    }

    /* Body Card Form */
    .login-body {
        padding: 30px 25px;
    }

    .form-label {
        font-weight: 700;
        color: #334155;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Custom Input Group dengan Icon */
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
        height: 50px;
        border-radius: 14px;
        padding-left: 46px;
        border: 1.5px solid #e2e8f0;
        background-color: #f8fafc;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .form-control-custom:focus {
        background-color: #ffffff;
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
    }

    .form-control-custom:focus + .input-icon {
        color: #6366f1;
    }

    /* Tombol Login Gradient */
    .btn-login {
        width: 100%;
        height: 50px;
        border-radius: 14px;
        font-weight: 700;
        font-size: 1rem;
        background: linear-gradient(135deg, #2563eb 0%, #6366f1 100%);
        color: white;
        border: none;
        box-shadow: 0 8px 20px -4px rgba(37, 99, 235, 0.4);
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        background: linear-gradient(135deg, #1d4ed8 0%, #4f46e5 100%);
        transform: translateY(-2px);
        box-shadow: 0 12px 24px -4px rgba(37, 99, 235, 0.5);
    }

    /* Alert Pesan Sukses Logout / Error Session */
    .alert-custom {
        border-radius: 14px;
        border: none;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }
</style>

<!-- Fixed Container agar Penuh 100% Layar Browser -->
<div class="login-container-wrapper">

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

        <!-- Card Login -->
        <div class="login-card">

            <!-- Header Card -->
            <div class="login-header">
                <div class="brand-icon">
                    <i class="fa-solid fa-store fa-2x text-white"></i>
                </div>
                <h3>POS_Arini</h3>
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

                    <!-- Tombol Submit -->
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