@extends('layouts.app')

@section('content')

@include('layouts.navbar')

{{-- CDN FontAwesome & Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    /* =========================
       BACKGROUND & BASE
       ========================= */
    body {
        background-color: #f1f5f9;
        color: #334155;
    }

    /* =========================
       HERO / PROFILE CARD
       ========================= */
    .profile-card {
        background: linear-gradient(135deg, #334155 0%, #475569 100%);
        border-radius: 24px;
        color: white;
        padding: 3rem 2rem;
        box-shadow: 0 10px 25px -5px rgba(51, 65, 85, 0.25);
    }

    .profile-img-wrapper {
        position: relative;
        display: inline-block;
    }

    .profile-img {
        width: 140px;
        height: 140px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    /* =========================
       CONTENT CARDS
       ========================= */
    .info-card {
        background: #ffffff;
        border: 1px solid #e2e8f0 !important;
        border-radius: 20px;
        transition: all 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 24px -10px rgba(51, 65, 85, 0.15);
    }

    .section-title {
        color: #1e293b;
        font-weight: 700;
        font-size: 1.25rem;
    }

    .icon-box-slate {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #475569;
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    /* =========================
       BUTTON BACK
       ========================= */
    .btn-back-slate {
        background: #ffffff;
        color: #475569;
        border: 1.5px solid #cbd5e1;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-back-slate:hover {
        background: #334155;
        color: #ffffff;
        border-color: #334155;
    }

    /* =========================
       LIST STYLING
       ========================= */
    .tech-list {
        list-style: none;
        padding-left: 0;
    }

    .tech-list li {
        margin-bottom: 10px;
        color: #475569;
    }

    .tech-list strong {
        color: #1e293b;
    }
</style>

<div class="container py-4">

    <!-- Tombol Kembali -->
    <div class="mb-4">
        <a href="{{ route('beranda') }}"
           class="btn btn-back-slate rounded-pill px-4 py-2 shadow-sm d-inline-flex align-items-center">
            <i class="bi bi-arrow-left me-2"></i>
            Kembali
        </a>
    </div>

    <!-- Profil Hero Header -->
    <div class="profile-card text-center mb-4">
        <div class="profile-img-wrapper mb-3">
            <img src="{{ asset('storage/images/foto.jpg') }}"
                 alt="Foto Saya"
                 class="profile-img">
        </div>

        <h2 class="fw-bold mb-1 text-white">Arini Fitria Wulandari</h2>

        <p class="text-white-50 mb-0">
            Web Developer | Laravel Developer | Mahasiswa
        </p>
    </div>

    <div class="row g-4">
        
        <!-- Tentang Saya -->
        <div class="col-md-6">
            <div class="info-card p-4 h-100 shadow-sm">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="icon-box-slate">
                        <i class="bi bi-person-circle fs-5"></i>
                    </div>
                    <h5 class="section-title mb-0">Tentang Saya</h5>
                </div>
                <p class="text-secondary mb-0">
                    Halo, saya <strong>Arini Fitria Wulandari</strong>. Saya adalah pengembang aplikasi yang
                     memiliki ketertarikan pada dunia pemrograman dan pengembangan
                      sistem berbasis web. Melalui aplikasi ini, saya mengembangkan
                       sistem kasir untuk membantu proses pengelolaan toko Syntez Official,
                        yaitu toko yang menyediakan produk pakaian seperti Baju Polo.
                </p>
            </div>
        </div>

        <!-- Tentang Aplikasi -->
        <div class="col-md-6">
            <div class="info-card p-4 h-100 shadow-sm">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="icon-box-slate">
                        <i class="bi bi-shop fs-5"></i>
                    </div>
                    <h5 class="section-title mb-0">Tentang Aplikasi</h5>
                </div>
                <p class="text-secondary mb-0">
                    Aplikasi Syntez Official merupakan sistem kasir atau Point Of Sale (POS)
                    yang dibuat untuk membantu mengelola kegiatan penjualan produk Baju Polo.
                    Aplikasi ini menyediakan fitur untuk mengelola data pengguna, produk, stok,
                    serta transaksi penjualan. Dengan adanya aplikasi ini, proses pencatatan produk 
                    dan transaksi diharapkan menjadi lebih teratur, mudah, dan efisien.
                </p>
            </div>
        </div>

        <!-- Teknologi yang Digunakan (Posisi Tengah) -->
        <div class="col-md-8 offset-md-2">
            <div class="info-card p-4 shadow-sm text-center">
                <div class="d-flex align-items-center justify-content-center gap-3 mb-3">
                    <div class="icon-box-slate">
                        <i class="bi bi-code-slash fs-5"></i>
                    </div>
                    <h5 class="section-title mb-0">Teknologi yang Digunakan</h5>
                </div>
                
                <ul class="tech-list mb-0">
                    <li>
                        <strong>Bahasa Pemrograman:</strong> PHP, JavaScript
                    </li>
                    <li>
                        <strong>Framework:</strong> Laravel
                    </li>
                    <li>
                        <strong>Frontend:</strong> HTML, CSS, Bootstrap
                    </li>
                    <li>
                        <strong>Database:</strong> MySQL
                    </li>
                    <li>
                        <strong>Tools:</strong> Visual Studio Code, Git
                    </li>
                </ul>
            </div>
        </div>

    </div>

</div>

@endsection