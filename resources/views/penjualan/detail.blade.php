@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

@include('layouts.navbar')

<!-- FontAwesome untuk Icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body {
        background-color: #f1f5f9;
        color: #334155;
    }

    .hero-banner-sales {
        background: linear-gradient(135deg, #334155 0%, #475569 100%);
        border-radius: 24px;
        color: white;
        padding: 2rem 2.5rem;
        box-shadow: 0 10px 25px -5px rgba(51, 65, 85, 0.25);
    }

    .hero-banner-sales .text-white-50 {
        color: #94a3b8 !important;
    }

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

    .card-header-slate {
        background-color: #f8fafc;
        color: #1e293b;
        border-bottom: 1px solid #e2e8f0 !important;
        padding: 1.25rem 1.5rem;
    }

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

    .info-label {
        color: #64748b;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* =========================
       MODAL KONFIRMASI QRIS
    ========================== */

    .modal-qris-content {
        border: 0;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(15, 23, 42, 0.25);
    }

    .modal-qris-header {
        background: linear-gradient(135deg, #334155 0%, #475569 100%);
        color: white;
        border: 0;
        padding: 1.5rem;
    }

    .modal-qris-icon {
        width: 60px;
        height: 60px;
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .modal-qris-body {
        padding: 2rem;
    }

    .modal-qris-alert {
        background-color: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #15803d;
        border-radius: 16px;
        padding: 1rem;
    }

    .modal-qris-footer {
        border: 0;
        padding: 0 2rem 2rem;
        gap: 12px;
    }

    .btn-modal-cancel {
        background-color: #f1f5f9;
        color: #475569;
        border: 1px solid #dbe4ee;
        border-radius: 14px;
        padding: 0.85rem 1.2rem;
        font-weight: 700;
        transition: all 0.2s ease;
    }

    .btn-modal-cancel:hover {
        background-color: #e2e8f0;
        color: #334155;
    }

    .btn-modal-confirm {
        border-radius: 14px;
        padding: 0.85rem 1.2rem;
        font-weight: 700;
    }

    /* =========================
       PRINT STYLE
    ========================== */

    @media print {

        @page {
            size: A4;
            margin: 12mm;
        }

        body {
            background: white !important;
            color: #000 !important;
        }

        .no-print,
        nav,
        .navbar,
        .btn-gradient-light {
            display: none !important;
        }

        .container {
            width: 100% !important;
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .hero-banner-sales {
            background: #334155 !important;
            color: white !important;
            box-shadow: none !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            border-radius: 12px !important;
            padding: 20px !important;
            margin-bottom: 20px !important;
        }

        .hero-banner-sales .text-white-50 {
            color: #e2e8f0 !important;
        }

        .icon-box-banner {
            background: rgba(255, 255, 255, 0.15) !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .card {
            box-shadow: none !important;
            border: 1px solid #cbd5e1 !important;
            break-inside: avoid;
        }

        .card-header {
            background-color: #f8fafc !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .table {
            width: 100% !important;
        }

        .table th,
        .table td {
            border-color: #cbd5e1 !important;
        }

        .badge {
            border: 1px solid #cbd5e1 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        img {
            max-width: 55px !important;
            max-height: 55px !important;
        }

        .row,
        .card {
            break-inside: avoid;
        }

        /* QRIS saat print */
        .qris-image {
            max-width: 220px !important;
            max-height: 220px !important;
        }

        /* Modal jangan ikut print */
        .modal,
        .modal-backdrop {
            display: none !important;
        }
    }
</style>

<div class="container py-4">

    <!-- =========================
         1. BANNER HEADER
    ========================== -->
    <div class="hero-banner-sales mb-4">

        <div class="row align-items-center">

            <div class="col-md-8">

                <div class="d-flex align-items-center gap-3">

                    <div class="icon-box-banner">
                        <i class="fa-solid fa-receipt fa-2x text-white"></i>
                    </div>

                    <div>
                        <h2 class="fw-bold mb-1">
                            Penjualan Detail
                        </h2>

                        <p class="mb-0 text-white-50">
                            Rincian lengkap item & informasi transaksi penjualan
                        </p>
                    </div>

                </div>

            </div>

            <!-- Tombol -->
            <div class="col-md-4 text-md-end mt-3 mt-md-0">

                <!-- Tombol Print -->
                <button type="button"
                        onclick="window.print()"
                        class="btn btn-light rounded-pill px-4 py-2 fw-bold shadow-sm me-2 no-print">

                    <i class="fa-solid fa-print me-2"></i>
                    Print

                </button>

                <!-- Tombol Kembali -->
                <a href="{{ route('penjualan.index') }}"
                   class="btn btn-gradient-light rounded-pill px-4 py-2 fw-bold shadow-sm no-print">

                    <i class="fa-solid fa-arrow-left me-2"></i>
                    Kembali

                </a>

            </div>

        </div>

    </div>


    <!-- =========================
         2. ROW CONTENT
    ========================== -->
    <div class="row g-4 mb-4">

        <!-- =========================
             2A. INFORMASI TRANSAKSI
        ========================== -->
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100"
                 style="border: 1px solid #e2e8f0 !important;">

                <div class="card-header card-header-slate">

                    <h5 class="fw-bold mb-0 fs-6">

                        <i class="fa-solid fa-circle-info text-secondary me-2"></i>

                        Informasi Transaksi

                    </h5>

                </div>


                <div class="card-body p-4">

                    <!-- Kasir -->
                    <div class="mb-3 pb-3 border-bottom">

                        <span class="info-label d-block mb-1">

                            <i class="fa-solid fa-user me-1 text-secondary"></i>

                            Kasir

                        </span>

                        <span class="fw-bold text-dark fs-6">

                            <i class="fa-solid fa-circle-user me-1 text-secondary"></i>

                            {{ $sale->user?->name ?? 'Pengguna Terhapus' }}

                        </span>

                    </div>


                    <!-- Tanggal Transaksi -->
                    <div class="mb-3 pb-3 border-bottom">

                        <span class="info-label d-block mb-1">

                            <i class="fa-regular fa-clock me-1 text-secondary"></i>

                            Tanggal Transaksi

                        </span>

                        <span class="fw-semibold text-dark">

                            {{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}

                        </span>

                    </div>


                    <!-- Metode Pembayaran & Status -->
                    <div class="mb-3 pb-3 border-bottom d-flex justify-content-between align-items-center">

                        <!-- Metode Pembayaran -->
                        <div>

                            <span class="info-label d-block mb-1">
                                Metode
                            </span>

                            @if($sale->metode_pembayaran === 'CASH')

                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fw-bold">

                                    <i class="fa-solid fa-money-bill-wave me-1"></i>

                                    CASH

                                </span>

                            @elseif($sale->metode_pembayaran === 'QRIS')

                                <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle rounded-pill px-3 py-1 fw-bold">

                                    <i class="fa-solid fa-qrcode me-1"></i>

                                    QRIS

                                </span>

                            @else

                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1 fw-bold">

                                    <i class="fa-solid fa-building-columns me-1"></i>

                                    TRANSFER

                                </span>

                            @endif

                        </div>


                        <!-- Status -->
                        <div class="text-end">

                            <span class="info-label d-block mb-1">
                                Status
                            </span>

                            @if($sale->status === 'COMPLETED')

                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fw-bold">

                                    <i class="fa-solid fa-circle-check me-1"></i>

                                    SELESAI

                                </span>

                            @else

                                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-3 py-1 fw-bold">

                                    <i class="fa-solid fa-clock me-1"></i>

                                    BELUM SELESAI

                                </span>

                            @endif

                        </div>

                    </div>


                    <!-- Total Pembayaran -->
                    <div class="mb-3 pb-3 border-bottom">

                        <span class="info-label d-block mb-1">
                            Total Pembayaran
                        </span>

                        <span class="fs-3 fw-bold text-success">

                            Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}

                        </span>

                    </div>


                    <!-- =========================
                         PEMBAYARAN CASH
                    ========================== -->
                    @if($sale->metode_pembayaran === 'CASH')

                        <div class="mb-3 pb-3 border-bottom">

                            <span class="info-label d-block mb-1">
                                Uang Dibayar
                            </span>

                            <span class="fs-5 fw-bold text-dark">

                                Rp {{ number_format($sale->uang_dibayar ?? 0, 0, ',', '.') }}

                            </span>

                        </div>


                        <div class="mb-3 pb-3 border-bottom">

                            <span class="info-label d-block mb-1">
                                Kembalian
                            </span>

                            <span class="fs-4 fw-bold text-success">

                                Rp {{ number_format($sale->kembalian ?? 0, 0, ',', '.') }}

                            </span>

                        </div>

                    @endif


                    <!-- =========================
                         QRIS PEMBAYARAN
                    ========================== -->
                    @if($sale->metode_pembayaran === 'QRIS')

                        <div class="mt-4 pt-4 border-top text-center">

                            <span class="info-label d-block mb-3">
                                QRIS PEMBAYARAN
                            </span>

                            <div class="d-inline-block p-3 bg-white rounded-4 border shadow-sm">

                                <img src="{{ asset('storage/images/qris.jpeg') }}"
                                     alt="QRIS Pembayaran"
                                     class="qris-image"
                                     style="width: 220px; height: 220px; object-fit: contain;">

                            </div>

                            <p class="mt-3 mb-1 fw-bold text-dark">
                                Scan QRIS Untuk Melakukan Pembayaran
                            </p>

                            <p class="text-muted small mb-0">
                                Total: Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                            </p>


                            <!-- Tombol Konfirmasi Pembayaran QRIS -->
                            @if($sale->status !== 'COMPLETED')

                                <!-- Tombol membuka modal -->
                                <button type="button"
                                        class="btn btn-success rounded-pill px-4 py-2 fw-bold shadow-sm mt-4 no-print"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalKonfirmasiQRIS">

                                    <i class="fa-solid fa-circle-check me-2"></i>

                                    Konfirmasi Pembayaran

                                </button>

                            @else

                                <div class="mt-4 no-print">

                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-2 fw-bold">

                                        <i class="fa-solid fa-circle-check me-1"></i>

                                        Pembayaran Sudah Dikonfirmasi

                                    </span>

                                </div>

                            @endif

                        </div>

                    @endif

                </div>

            </div>

        </div>


        <!-- =========================
             2B. DAFTAR PRODUK
        ========================== -->
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100"
                 style="border: 1px solid #e2e8f0 !important;">

                <!-- Header -->
                <div class="card-header card-header-slate d-flex justify-content-between align-items-center">

                    <h5 class="fw-bold mb-0 fs-6">

                        <i class="fa-solid fa-cart-shopping text-secondary me-2"></i>

                        Daftar Produk Dibeli

                    </h5>

                    <span class="badge bg-white text-dark border rounded-pill px-3 py-1 fw-bold"
                          style="font-size: 0.75rem;">

                        {{ count($sale->itemPenjualan) }} Item

                    </span>

                </div>


                <!-- Body -->
                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <!-- Table Header -->
                            <thead class="text-uppercase fs-7"
                                   style="background-color: #f8fafc; color: #64748b;">

                                <tr>

                                    <th class="ps-4 py-3" width="70">
                                        NO
                                    </th>

                                    <th class="py-3" width="100">
                                        FOTO
                                    </th>

                                    <th class="py-3">
                                        NAMA PRODUK
                                    </th>

                                    <th class="py-3 text-center" width="100">
                                        UKURAN
                                    </th>

                                    <th class="py-3 text-center" width="120">
                                        QTY
                                    </th>

                                    <th class="pe-4 py-3 text-end" width="160">
                                        HARGA SATUAN
                                    </th>

                                </tr>

                            </thead>


                            <!-- Table Body -->
                            <tbody>

                                <?php $i = 1; ?>

                                @forelse($sale->itemPenjualan as $item)

                                    <tr class="border-bottom"
                                        style="border-color: #f1f5f9 !important;">

                                        <!-- Nomor -->
                                        <td class="ps-4 fw-bold text-muted">

                                            {{ $i++ }}

                                        </td>


                                        <!-- Foto Produk -->
                                        <td>

                                            @if($item->produk && $item->produk->foto)

                                                <img src="{{ asset('storage/'.$item->produk->foto) }}"
                                                     alt="{{ $item->produk->nama }}"
                                                     width="55"
                                                     height="55"
                                                     class="rounded-3 shadow-sm"
                                                     style="object-fit:cover; border: 1px solid #e2e8f0;">

                                            @else

                                                <div class="rounded-3 bg-light d-flex align-items-center justify-content-center border"
                                                     style="width: 55px; height: 55px;">

                                                    <i class="fa-solid fa-image text-muted"></i>

                                                </div>

                                            @endif

                                        </td>


                                        <!-- Nama Produk -->
                                        <td class="fw-bold text-dark">

                                            {{ $item->produk->nama ?? 'Produk Dihapus' }}

                                        </td>


                                        <!-- Ukuran -->
                                        <td class="text-center">

                                            <span class="badge bg-secondary text-white px-3 py-1 rounded-pill fw-bold">

                                                {{ $sale->ukuran_baju ?? '-' }}

                                            </span>

                                        </td>


                                        <!-- Quantity -->
                                        <td class="text-center">

                                            <span class="badge bg-light text-dark border px-3 py-1 fw-bold rounded-pill">

                                                {{ $item->kuantitas ?? 1 }}

                                            </span>

                                        </td>


                                        <!-- Harga Satuan -->
                                        <td class="pe-4 text-end fw-bold text-success">

                                            Rp {{ number_format(
                                                $item->harga_satuan
                                                ?? $item->produk->harga_jual
                                                ?? 0,
                                                0,
                                                ',',
                                                '.'
                                            ) }}

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="6"
                                            class="text-center py-5 text-muted">

                                            <i class="fa-solid fa-cart-flatbed fa-3x mb-3 text-secondary opacity-50"></i>

                                            <p class="mb-0 fw-bold">

                                                Tidak ada produk dalam transaksi ini

                                            </p>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- =====================================================
     MODAL KONFIRMASI PEMBAYARAN QRIS
====================================================== -->
@if($sale->metode_pembayaran === 'QRIS' && $sale->status !== 'COMPLETED')

<div class="modal fade"
     id="modalKonfirmasiQRIS"
     tabindex="-1"
     aria-labelledby="modalKonfirmasiQRISLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content modal-qris-content">

            <!-- Header Modal -->
            <div class="modal-header modal-qris-header">

                <div class="d-flex align-items-center">

                    <div class="modal-qris-icon me-3">

                        <i class="fa-solid fa-circle-check fa-2x"></i>

                    </div>

                    <div>

                        <h5 class="modal-title fw-bold mb-1"
                            id="modalKonfirmasiQRISLabel">

                            Konfirmasi Pembayaran

                        </h5>

                        <small style="color: #cbd5e1;">

                            Pembayaran QRIS

                        </small>

                    </div>

                </div>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>

            </div>


            <!-- Body Modal -->
            <div class="modal-body modal-qris-body text-center">

                <h4 class="fw-bold text-dark mb-2">

                    Apakah pembayaran QRIS sudah diterima

                </h4>

                <p class="text-muted mb-4">

                    Pastikan semua data transaksi dan pembayaran sudah benar.

                </p>


                <div class="modal-qris-alert text-start">

                    <i class="fa-solid fa-circle-info me-2"></i>

                    Setelah checkout, transaksi akan ditandai sebagai

                    <strong>SELESAI</strong>.

                </div>

            </div>


            <!-- Footer Modal -->
            <div class="modal-footer modal-qris-footer d-flex">

                <!-- Tombol Batal -->
                <button type="button"
                        class="btn btn-modal-cancel flex-fill"
                        data-bs-dismiss="modal">

                    <i class="fa-solid fa-arrow-left me-2"></i>

                    Batal

                </button>


                <!-- Form Konfirmasi -->
                <form action="{{ route('penjualan.konfirmasi', $sale->id) }}"
                      method="POST"
                      class="flex-fill">

                    @csrf

                    <button type="submit"
                            class="btn btn-success btn-modal-confirm w-100">

                        <i class="fa-solid fa-circle-check me-2"></i>

                        Ya, Konfirmasi

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endif

@endsection