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

    /* =========================
       KONTAK
       ========================= */
    .contact-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        padding: 15px;
        text-decoration: none;
        color: #334155;
        display: flex;
        align-items: center;
        gap: 15px;
        height: 100%;
        transition: all 0.2s ease;
    }

    .contact-card:hover {
        color: #334155;
        transform: translateY(-2px);
        box-shadow: 0 8px 18px rgba(51, 65, 85, 0.10);
    }

    .contact-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .instagram-icon {
        background-color: #fce7f3;
        color: #d62976;
    }

    .tiktok-icon {
        background-color: #f1f5f9;
        color: #000000;
    }

    .email-icon {
        background-color: #e0f2fe;
        color: #0284c7;
    }

    .contact-label {
        font-size: 13px;
        color: #64748b;
        margin-bottom: 3px;
    }

    .contact-value {
        font-size: 15px;
        font-weight: 600;
        color: #1e293b;
        word-break: break-word;
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

        <!-- Teknologi yang Digunakan -->
        <div class="col-md-8 offset-md-2">
            <div class="info-card p-4 shadow-sm text-center">
                <div class="d-flex align-items-center justify-content-center gap-3 mb-3">
                    <div class="icon-box-slate">
                        <i class="bi bi-code-slash fs-5"></i>
                    </div>

                    <h5 class="section-title mb-0">
                        Teknologi yang Digunakan
                    </h5>
                </div>

                <ul class="tech-list mb-0">
                    <li>
                        <strong>Bahasa Pemograman:</strong> PHP, JavaScript
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

        <!-- Kontak & Media Sosial -->
        <div class="col-md-10 offset-md-1">
            <div class="info-card p-4 shadow-sm">

                <div class="d-flex align-items-center justify-content-center gap-3 mb-4">
                    <div class="icon-box-slate">
                        <i class="bi bi-person-lines-fill fs-5"></i>
                    </div>

                    <h5 class="section-title mb-0">
                        Kontak & Media Sosial
                    </h5>
                </div>

                <div class="row g-3">

                    <!-- Instagram -->
                    <div class="col-md-4">
                        <a href="https://www.instagram.com/pretys.ainn"
                           target="_blank"
                           class="contact-card">

                            <div class="contact-icon instagram-icon">
                                <i class="fa-brands fa-instagram"></i>
                            </div>

                            <div>
                                <div class="contact-label">
                                    Instagram
                                </div>

                                <div class="contact-value">
                                    @pretys.ainn
                                </div>
                            </div>

                        </a>
                    </div>

                    <!-- TikTok -->
                    <div class="col-md-4">
                        <a href="https://www.tiktok.com/@ainntwo"
                           target="_blank"
                           class="contact-card">

                            <div class="contact-icon tiktok-icon">
                                <i class="fa-brands fa-tiktok"></i>
                            </div>

                            <div>
                                <div class="contact-label">
                                    TikTok
                                </div>

                                <div class="contact-value">
                                    @ainntwo
                                </div>
                            </div>

                        </a>
                    </div>

                    <!-- Email -->
                    <div class="col-md-4">
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=arinifitriaw@gmail.com"
                            target="_blank"
                            class="contact-card">

                            <div class="contact-icon email-icon">
                                <i class="fa-solid fa-envelope"></i>
                            </div>

                            <div>
                                <div class="contact-label">
                                    Email
                                </div>

                                <div class="contact-value">
                                    arinifitriaw@gmail.com
                                </div>
                            </div>

                        </a>
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>

@endsection