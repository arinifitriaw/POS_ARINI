@extends('layouts.app')

@section('title', 'Tentang Syntez Official')

@section('content')

@include('layouts.navbar')

<!-- FontAwesome untuk logo Instagram, TikTok, WhatsApp -->
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<div class="container py-5">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4 p-md-5">

            <!-- Logo Syntez Official -->
            <div class="text-center mb-4">
                <img src="{{ asset('storage/images/logosyntez.jpg') }}"
                     alt="Logo Syntez Official"
                     class="logo-syntez">
            </div>

            <style>
                .logo-syntez {
                    width: 150px;
                    height: 150px;
                    object-fit: cover;
                    border-radius: 50%;
                }

                .kontak-card {
                    border: 1px solid #e2e8f0;
                    border-radius: 15px;
                    padding: 15px;
                    text-decoration: none;
                    color: #334155;
                    display: flex;
                    align-items: center;
                    gap: 15px;
                    height: 100%;
                    transition: 0.2s;
                    background-color: #fff;
                }

                .kontak-card:hover {
                    color: #334155;
                    transform: translateY(-2px);
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
                }

                .kontak-icon {
                    width: 48px;
                    height: 48px;
                    min-width: 48px;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 24px;
                }

                .instagram-icon {
                    background-color: #f3e8ff;
                    color: #d62976;
                }

                .tiktok-icon {
                    background-color: #f1f5f9;
                    color: #000;
                }

                .whatsapp-icon {
                    background-color: #dcfce7;
                    color: #16a34a;
                }

                .kontak-label {
                    font-size: 14px;
                    color: #64748b;
                    margin-bottom: 3px;
                }

                .kontak-value {
                    font-size: 16px;
                    font-weight: 600;
                    color: #1e293b;
                }
            </style>

            <!-- Judul -->
            <h2 class="fw-bold text-center mb-4">
                Tentang Syntez Official
            </h2>

            <!-- Pembahasan Perusahaan -->
            <p>
                <strong>Syntez Official</strong> merupakan sebuah usaha yang
                bergerak di bidang penjualan pakaian, khususnya baju polo.
                Syntez Official didirikan sebagai usaha yang bertujuan
                menyediakan produk baju polo yang dapat digunakan untuk
                kebutuhan sehari-hari.
            </p>

            <p>
                Dalam menjalankan usahanya, Syntez Official berfokus pada
                penyediaan baju polo dengan berbagai pilihan ukuran, yaitu
                <strong>S, M, L, XL, dan XXL</strong>. Syntez Official berusaha
                memberikan produk yang sesuai dengan kebutuhan pelanggan serta
                memberikan pelayanan yang baik dalam proses penjualan.
            </p>

            <p>
                Seiring dengan perkembangan usaha, Syntez Official menggunakan
                aplikasi <strong>Point of Sale (POS)</strong> untuk membantu
                mengelola kegiatan penjualan. Aplikasi ini digunakan untuk
                mengelola data produk, stok, transaksi, pembayaran, dan
                pencatatan penjualan sehingga kegiatan operasional toko
                menjadi lebih mudah dan teratur.
            </p>

            <!-- Tujuan -->
            <h2 class="fw-bold mt-5 mb-3">
                Tujuan
            </h2>

            <p>
                Tujuan Syntez Official adalah mengembangkan usaha di bidang
                penjualan baju polo, menyediakan produk yang berkualitas sesuai
                dengan kebutuhan pelanggan, serta memberikan pelayanan yang baik
                dan kemudahan dalam proses penjualan. Selain itu, Syntez Official
                bertujuan untuk meningkatkan kepuasan pelanggan dan mengembangkan
                jangkauan usahanya.
            </p>

            <!-- Media Sosial & Kontak -->
            <h2 class="fw-bold mt-5 mb-4">
                Media Sosial & Kontak
            </h2>

            <div class="row g-3">

                            <!-- Shopee -->
                            <div class="col-md-4">
                            <a href="https://shopee.co.id/Syntezofficial"
                                target="_blank"
                                class="kontak-card">

                            <div class="kontak-icon" style="background-color: #fff1f2; color: #ee4d2d;">
                            <i class="fa-solid fa-bag-shopping"></i>
                            </div>

                            <div>
                            <div class="kontak-label">
                            Shopee
                            </div>

                            <div class="kontak-value">
                            Syntezofficial
                        </div>
                    </div>

                </a>
            </div>

                <!-- TikTok -->
                <div class="col-md-4">
                    <a href="https://www.tiktok.com/@syntez.co"
                       target="_blank"
                       class="kontak-card">

                        <div class="kontak-icon tiktok-icon">
                            <i class="fa-brands fa-tiktok"></i>
                        </div>

                        <div>
                            <div class="kontak-label">
                                TikTok
                            </div>

                            <div class="kontak-value">
                                @Syntezoffcial
                            </div>
                        </div>

                    </a>
                </div>

                <!-- WhatsApp -->
                <div class="col-md-4">
                    <a href="https://wa.me/+62 881-0227-86077"
                       target="_blank"
                       class="kontak-card">

                        <div class="kontak-icon whatsapp-icon">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>

                        <div>
                            <div class="kontak-label">
                                WhatsApp
                            </div>

                            <div class="kontak-value">
                                +62 881-0227-86077
                            </div>
                        </div>

                    </a>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection