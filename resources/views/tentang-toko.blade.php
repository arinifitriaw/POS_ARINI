@extends('layouts.app')

@section('title', 'Tentang Syntez Official')

@section('content')

@include('layouts.navbar')

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
                Tujuan Syntez Official adalah mengembangkan usaha baju polo
                serta memberikan kemudahan dalam proses penjualan dan
                pelayanan kepada pelanggan.
            </p>

        </div>
    </div>
</div>

@endsection