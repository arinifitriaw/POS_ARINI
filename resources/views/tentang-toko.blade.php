@extends('layouts.app')

@section('title', 'Tentang Syntez Official')

@section('content')

@include('layouts.navbar')

<div class="container py-5">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h2 class="fw-bold mb-3">Tentang Syntez Official</h2>

            <h5>
                 Aplikasi Syntez Official merupakan sistem kasir atau Point Of Sale (POS)
                    yang dibuat untuk membantu mengelola kegiatan penjualan produk Baju Polo.
                    Aplikasi ini menyediakan fitur untuk mengelola data pengguna, produk, stok,
                    serta transaksi penjualan. Dengan adanya aplikasi ini, proses pencatatan produk 
                    dan transaksi diharapkan menjadi lebih teratur, mudah, dan efisien.
            </h5>

            <h2 class="fw-bold mt-4">Tujuan</h2>
            <h5>
                Membantu toko dalam mengelola penjualan dan data produk secara
                lebih cepat dan mudah.
            </h5>
        </div>
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

    </div>

</div>

@endsection