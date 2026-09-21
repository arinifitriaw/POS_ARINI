@extends('layouts.app')

@section('title', 'Tambah Penjualan')

@section('content')

@include('layouts.navbar')

<!-- CDN FontAwesome untuk Icon -->
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body {
        background-color: #f1f5f9;
        color: #334155;
    }

    /* Hero Banner */
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

    /* Icon Box */
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

    /* Button Light */
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

    /* Header Card */
    .card-header-slate {
        background-color: #f8fafc;
        color: #1e293b;
        border-bottom: 1px solid #e2e8f0 !important;
        padding: 1.25rem 1.5rem;
    }

    /* Search */
    .search-card {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .search-card:focus-within {
        border-color: #475569;
        box-shadow: 0 0 0 3px rgba(71, 85, 105, 0.15);
    }

    /* Button Slate */
    .btn-slate-primary {
        background-color: #334155;
        color: white;
        border: none;
        transition: all 0.2s ease;
    }

    .btn-slate-primary:hover:not(:disabled) {
        background-color: #1e293b;
        color: white;
        transform: translateY(-1px);
    }

    /* Product List */
    .product-list-container {
        max-height: 520px;
        overflow-y: auto;
        padding-right: 4px;
    }

    .product-list-container::-webkit-scrollbar {
        width: 6px;
    }

    .product-list-container::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    /* Total Price */
    .total-price-box {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
    }

    /* QRIS */
    .qris-payment-box {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
    }

    .qris-payment-image {
        width: 220px;
        height: 220px;
        object-fit: contain;
    }

    /* Alert Stok */
    .stock-warning-alert {
        background: #fff7ed;
        border: 1px solid #fed7aa !important;
        color: #9a3412;
    }

    /* Input Quantity ketika stok melebihi */
    .quantity-warning {
        border-color: #f97316 !important;
        box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.12) !important;
    }

    /* =========================================================
       MODAL KONFIRMASI
       ========================================================= */
    .delete-modal {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.60);
        backdrop-filter: blur(5px);
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        z-index: 9999;
    }

    .delete-modal.show {
        display: flex;
        animation: deleteFadeIn 0.2s ease;
    }

    .delete-modal-box {
        width: 100%;
        max-width: 430px;
        background: #ffffff;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 25px 60px rgba(15, 23, 42, 0.25);
        animation: deleteSlideUp 0.25s ease;
    }

    .delete-modal-header {
        background: linear-gradient(135deg, #334155 0%, #475569 100%);
        padding: 22px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .delete-icon {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.15);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
    }

    .delete-close {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.1);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .delete-close:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    .delete-modal-body {
        padding: 24px;
        text-align: center;
    }

    .delete-warning {
        background: #f0fdf4;
        color: #15803d;
        border: 1px solid #bbf7d0;
        border-radius: 12px;
        padding: 12px 14px;
        font-size: 13px;
        text-align: left;
    }

    .delete-modal-footer {
        padding: 0 24px 24px;
        display: flex;
        gap: 10px;
    }

    .btn-delete-cancel {
        flex: 1;
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 11px 15px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-delete-cancel:hover {
        background: #e2e8f0;
        color: #1e293b;
    }

    .btn-checkout-confirm {
        flex: 1;
        background: #16a34a;
        color: white;
        border: none;
        border-radius: 12px;
        padding: 11px 15px;
        font-weight: 700;
        transition: all 0.2s ease;
    }

    .btn-checkout-confirm:hover {
        background: #15803d;
        transform: translateY(-1px);
    }

    .btn-delete-confirm {
        width: 100%;
        background: #dc2626;
        color: white;
        border: none;
        border-radius: 12px;
        padding: 11px 15px;
        font-weight: 700;
        transition: all 0.2s ease;
    }

    .btn-delete-confirm:hover {
        background: #b91c1c;
        transform: translateY(-1px);
    }

    @keyframes deleteFadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes deleteSlideUp {
        from {
            opacity: 0;
            transform: translateY(20px) scale(0.98);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @media (max-width: 576px) {
        .delete-modal {
            padding: 12px;
        }

        .delete-modal-box {
            border-radius: 20px;
        }

        .delete-modal-header {
            padding: 18px;
        }

        .delete-modal-body {
            padding: 18px;
        }

        .delete-modal-footer {
            padding: 0 18px 18px;
        }

        .qris-payment-image {
            width: 200px;
            height: 200px;
        }
    }
</style>

<div class="container py-4">

    {{-- =========================================================
         ALERT ERROR VALIDASI
         ========================================================= --}}
    @if($errors->any())
        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 alert-dismissible fade show"
             role="alert">

            <i class="fa-solid fa-circle-exclamation me-2"></i>

            <strong>Checkout gagal!</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close">
            </button>
        </div>
    @endif

    {{-- =========================================================
         ALERT STOK DARI BACKEND
         ========================================================= --}}
    @if(session('error'))
        <div class="alert stock-warning-alert border-0 shadow-sm rounded-4 mb-4 alert-dismissible fade show"
             role="alert">

            <div class="d-flex align-items-start">

                <i class="fa-solid fa-triangle-exclamation fs-5 me-3 mt-1"></i>

                <div>
                    <strong class="d-block mb-1">
                        Stok Tidak Mencukupi
                    </strong>

                    <span>
                        {{ session('error') }}
                    </span>
                </div>

            </div>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close">
            </button>
        </div>
    @endif

    {{-- =========================================================
         ALERT STOK DARI JAVASCRIPT
         ========================================================= --}}
    <div id="stockWarningAlert"
         class="alert stock-warning-alert border-0 shadow-sm rounded-4 mb-4 alert-dismissible fade show"
         role="alert"
         style="display: none;">

        <div class="d-flex align-items-start">

            <i class="fa-solid fa-triangle-exclamation fs-5 me-3 mt-1"></i>

            <div>
                <strong class="d-block mb-1">
                    Stok Tidak Mencukupi
                </strong>

                <span id="stockWarningMessage"></span>
            </div>

        </div>

        <button type="button"
                class="btn-close"
                onclick="closeStockWarning()"
                aria-label="Close">
        </button>
    </div>

    {{-- =========================================================
         HERO HEADER
         ========================================================= --}}
    <div class="hero-banner-sales mb-4">

        <div class="row align-items-center">

            <div class="col-md-7">

                <div class="d-flex align-items-center gap-3">

                    <div class="icon-box-banner">
                        <i class="fa-solid fa-cash-register fa-2x text-white"></i>
                    </div>

                    <div>
                        <h2 class="fw-bold mb-1">
                            Tambah & Lanjutkan Penjualan
                        </h2>

                        <p class="mb-0 text-white-50">
                            Kelola item keranjang dan selesaikan transaksi kasir POS
                        </p>
                    </div>

                </div>

            </div>

            <div class="col-md-5 text-md-end mt-3 mt-md-0">

                <a href="{{ route('penjualan.index') }}"
                   class="btn btn-gradient-light rounded-pill px-4 py-2.5 fw-bold shadow-sm">

                    <i class="fa-solid fa-arrow-left me-2"></i>
                    Kembali ke List

                </a>

            </div>

        </div>

    </div>

    {{-- =========================================================
         HITUNG TOTAL & DISKON
         ========================================================= --}}
    @php
        $totalBelanja = $sale->ItemPenjualan->sum('subtotal');

        $diskon = 0;

        if ($totalBelanja >= 1000000) {
            $diskon = $totalBelanja * 10 / 100;
        }

        $totalSetelahDiskon = $totalBelanja - $diskon;
    @endphp

    {{-- =========================================================
         MAIN CONTENT
         ========================================================= --}}
    <div class="row g-4">

        {{-- =================== KATALOG PRODUK =================== --}}
        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100"
                 style="border: 1px solid #e2e8f0 !important;">

                <div class="card-header card-header-slate d-flex justify-content-between align-items-center">

                    <h5 class="fw-bold mb-0 fs-6">

                        <i class="fa-solid fa-boxes-stacked text-slate-500 me-2"></i>

                        Katalog Produk

                    </h5>

                    <span class="badge bg-white text-dark border rounded-pill px-3 py-1.5 fw-bold"
                          style="font-size: 0.75rem;">

                        Pilih Item

                    </span>

                </div>

                <div class="card-body p-3">

                    {{-- Form Pencarian Produk --}}
                    <div class="mb-3">

                        <form method="GET"
                              action="{{ route('penjualan.create') }}">

                            <div class="input-group search-card p-1">

                                <span class="input-group-text bg-transparent border-0 text-secondary ps-3">

                                    <i class="fa-solid fa-magnifying-glass"></i>

                                </span>

                                <input type="text"
                                       name="search"
                                       value="{{ request('search') }}"
                                       class="form-control border-0 shadow-none bg-transparent"
                                       placeholder="Cari nama produk..."
                                       onkeyup="this.form.submit()">

                            </div>

                        </form>

                    </div>

                    {{-- Scrollable Product List --}}
                    <div class="product-list-container d-flex flex-column gap-2">

                        @forelse($products as $product)

                            <form method="POST"
                                  action="{{ route('itempenjualan.store') }}"
                                  class="row g-2 align-items-center bg-white rounded-3 p-2 border mx-0"
                                  style="border-color: #f1f5f9 !important;">

                                @csrf

                                <input type="hidden"
                                       name="product_id"
                                       value="{{ $product->id }}">

                                {{-- Informasi Produk --}}
                                <div class="col-7">

                                    <div class="d-flex align-items-center gap-2">

                                        @if($product->foto)

                                            <img src="{{ asset('storage/'.$product->foto) }}"
                                                 alt="{{ $product->nama }}"
                                                 class="rounded-3 border shadow-sm"
                                                 style="width:48px; height:48px; object-fit:cover; border-color:#e2e8f0 !important;">

                                        @else

                                            <div class="rounded-3 bg-light border d-flex align-items-center justify-content-center"
                                                 style="width:48px; height:48px;">

                                                <i class="fa-solid fa-image text-muted"></i>

                                            </div>

                                        @endif

                                        <div class="text-truncate">

                                            <div class="fw-bold text-dark text-truncate">
                                                {{ $product->nama }}
                                            </div>

                                            <small class="text-success fw-bold">
                                                Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                                            </small>

                                            <small class="d-block text-muted">
                                                Stok: {{ $product->stok }}
                                            </small>

                                        </div>

                                    </div>

                                </div>

                                {{-- Input Quantity --}}
                                <div class="col-3">

                                    <input type="number"
                                           name="quantity"
                                           value="1"
                                           min="1"
                                           data-stock="{{ $product->stok }}"
                                           class="form-control text-center rounded-3 shadow-none fw-semibold border-secondary-subtle product-quantity"
                                           {{ $product->stok <= 0 || $sale->status === 'COMPLETED' ? 'disabled' : '' }}>

                                </div>

                                {{-- Tombol Tambah --}}
                                <div class="col-2">

                                    <button type="submit"
                                            class="btn btn-slate-primary w-100 rounded-3 py-2 fw-bold shadow-sm"
                                            title="{{ $product->stok <= 0 ? 'Stok Habis' : 'Tambah Ke Keranjang' }}"
                                            {{ $product->stok <= 0 || $sale->status === 'COMPLETED' ? 'disabled' : '' }}>

                                        <i class="fa-solid fa-plus"></i>

                                    </button>

                                </div>

                            </form>

                        @empty

                            <div class="text-center py-5 text-muted">

                                <i class="fa-solid fa-box-open fa-3x mb-3 text-secondary opacity-50"></i>

                                <p class="mb-0 fw-semibold">
                                    Produk tidak ditemukan
                                </p>

                            </div>

                        @endforelse

                    </div>

                </div>

            </div>

        </div>

        {{-- =================== KERANJANG PENJUALAN =================== --}}
        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 d-flex flex-column justify-content-between"
                 style="border: 1px solid #e2e8f0 !important;">

                <div>

                    <div class="card-header card-header-slate d-flex justify-content-between align-items-center">

                        <h5 class="fw-bold mb-0 fs-6">

                            <i class="fa-solid fa-cart-shopping text-slate-500 me-2"></i>

                            Keranjang

                        </h5>

                        <span class="badge bg-white text-dark border rounded-pill px-3 py-1.5 fw-bold"
                              style="font-size: 0.75rem;">

                            {{ count($sale->ItemPenjualan) }} Item

                        </span>

                    </div>

                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead class="bg-slate-50 text-uppercase fs-7"
                                   style="background-color:#f8fafc; color:#64748b;">

                                <tr>

                                    <th class="ps-3 py-3">
                                        Produk
                                    </th>

                                    <th class="py-3">
                                        Harga
                                    </th>

                                    <th class="py-3 text-center" width="85">
                                        Qty
                                    </th>

                                    <th class="py-3">
                                        SubTotal
                                    </th>

                                    <th class="text-center py-3" width="70">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($sale->ItemPenjualan as $item)

                                    <tr class="border-bottom"
                                        style="border-color:#f1f5f9 !important;">

                                        <td class="ps-3 fw-bold text-dark">
                                            {{ $item->produk->nama }}
                                        </td>

                                        <td class="text-muted small">
                                            Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}
                                        </td>

                                        <td>

                                            <form method="POST"
                                                  action="{{ route('itempenjualan.update', $item->id) }}">

                                                @csrf
                                                @method('PUT')

                                                <input type="number"
                                                       name="quantity"
                                                       value="{{ $item->kuantitas }}"
                                                       min="1"
                                                       data-cart-quantity="{{ $item->kuantitas }}"
                                                       data-cart-stock="{{ $item->produk->stok }}"
                                                       class="form-control form-control-sm text-center rounded-3 shadow-none fw-bold cart-quantity"
                                                       onchange="validateCartQuantity(this)"
                                                       {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>

                                            </form>

                                        </td>

                                        <td class="fw-bold text-success">
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </td>

                                        <td class="text-center">

                                            @can('delete', $item)

                                                @if($sale->status !== 'COMPLETED')

                                                    <form method="POST"
                                                          action="{{ route('itempenjualan.destroy', $item->id) }}">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button class="btn btn-outline-danger btn-sm rounded-circle p-1 d-inline-flex align-items-center justify-content-center shadow-sm"
                                                                style="width:32px; height:32px;"
                                                                title="Hapus">

                                                            <i class="fa-solid fa-trash-can"></i>

                                                        </button>

                                                    </form>

                                                @endif

                                            @endcan

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="5"
                                            class="text-center py-5 text-muted">

                                            <i class="fa-solid fa-cart-flatbed fa-3x mb-3 text-secondary opacity-50"></i>

                                            <p class="mb-0 fw-semibold">
                                                Keranjang masih kosong.
                                            </p>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

                {{-- =========================================================
                     FOOTER PEMBAYARAN
                     ========================================================= --}}
                <div class="card-footer bg-white p-3 border-top"
                     style="border-color:#e2e8f0 !important;">

                    {{-- =====================================================
                         TOTAL BELANJA & DISKON
                         ===================================================== --}}

                    <div class="total-price-box p-3 mb-3">

                        {{-- Total Belanja --}}
                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <span class="fw-bold text-dark">
                                Total Belanja
                            </span>

                            <span class="fw-semibold text-dark">
                                Rp {{ number_format($totalBelanja, 0, ',', '.') }}
                            </span>

                        </div>

                        {{-- Diskon --}}
                        @if($diskon > 0)

                            <div class="d-flex justify-content-between align-items-center mb-2">

                                <span class="fw-bold text-danger">
                                    Diskon 10%
                                </span>

                                <span class="fw-bold text-danger">
                                    - Rp {{ number_format($diskon, 0, ',', '.') }}
                                </span>

                            </div>

                        @else

                            <div class="d-flex justify-content-between align-items-center mb-2">

                                <span class="text-muted small">
                                    Diskon
                                </span>

                                <span class="text-muted small">
                                    Belanja minimal Rp1.000.000
                                </span>

                            </div>

                        @endif

                        {{-- Total Setelah Diskon --}}
                        <div class="border-top pt-2 d-flex justify-content-between align-items-center">

                            <span class="fw-bold text-dark">
                                Total Pembayaran
                            </span>

                            <h3 class="fw-bold text-success mb-0">
                                Rp {{ number_format($totalSetelahDiskon, 0, ',', '.') }}
                            </h3>

                        </div>

                    </div>

                    {{-- Form Checkout --}}
                    <form method="POST"
                          action="{{ route('penjualan.update', $sale->id) }}"
                          id="checkoutForm">

                        @csrf
                        @method('PUT')

                        {{-- Ukuran Baju --}}
                        <div class="mb-3">

                            <label class="form-label fw-bold text-secondary fs-7 text-uppercase mb-1">
                                Ukuran Baju
                            </label>

                            <select name="ukuran_baju"
                                    id="ukuranBaju"
                                    class="form-select rounded-3 py-2 shadow-none border-secondary-subtle"
                                    required
                                    {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>

                                <option value="">
                                    -- Pilih Ukuran --
                                </option>

                                <option value="S"
                                    {{ $sale->ukuran_baju === 'S' ? 'selected' : '' }}>
                                    S
                                </option>

                                <option value="M"
                                    {{ $sale->ukuran_baju === 'M' ? 'selected' : '' }}>
                                    M
                                </option>

                                <option value="L"
                                    {{ $sale->ukuran_baju === 'L' ? 'selected' : '' }}>
                                    L
                                </option>

                                <option value="XL"
                                    {{ $sale->ukuran_baju === 'XL' ? 'selected' : '' }}>
                                    XL
                                </option>

                                <option value="XXL"
                                    {{ $sale->ukuran_baju === 'XXL' ? 'selected' : '' }}>
                                    XXL
                                </option>

                            </select>

                        </div>

                        {{-- Metode Pembayaran --}}
                        <div class="mb-3">

                            <label class="form-label fw-bold text-secondary fs-7 text-uppercase mb-1">
                                Metode Pembayaran
                            </label>

                            <select name="payment_method"
                                    id="paymentMethod"
                                    class="form-select rounded-3 py-2 shadow-none border-secondary-subtle"
                                    required
                                    {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>

                                <option value=""
                                    {{ empty($sale->metode_pembayaran) ? 'selected' : '' }}>
                                    -- Pilih Pembayaran --
                                </option>

                                <option value="CASH"
                                    {{ $sale->metode_pembayaran === 'CASH' ? 'selected' : '' }}>
                                    CASH
                                </option>

                                <option value="QRIS"
                                    {{ $sale->metode_pembayaran === 'QRIS' ? 'selected' : '' }}>
                                    QRIS
                                </option>

                            </select>

                        </div>

                        {{-- =====================================================
                             PEMBAYARAN CASH
                             ===================================================== --}}
                        <div id="cashPayment"
                             class="total-price-box p-3 mb-3"
                             style="display: none;">

                            <div class="mb-3">

                                <label class="form-label fw-bold text-secondary fs-7 text-uppercase mb-1">
                                    Uang Dibayar
                                </label>

                                <input type="number"
                                       name="uang_dibayar"
                                       id="uangDibayar"
                                       class="form-control rounded-3 py-2 shadow-none border-secondary-subtle"
                                       placeholder="Masukkan jumlah uang"
                                       min="0"
                                       {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>

                            </div>

                            <div>

                                <label class="form-label fw-bold text-secondary fs-7 text-uppercase mb-1">
                                    Kembalian
                                </label>

                                <div id="kembalian"
                                     class="form-control rounded-3 py-2 bg-light fw-bold text-success">

                                    Rp 0

                                </div>

                            </div>

                        </div>

                        {{-- =====================================================
                             QRIS PEMBAYARAN
                             ===================================================== --}}
                        <div id="qrisPayment"
                             class="qris-payment-box text-center p-3 mb-3"
                             style="display: none;">

                            <div class="fw-bold text-secondary mb-2">

                                <i class="fa-solid fa-qrcode me-1"></i>

                                QRIS PEMBAYARAN

                            </div>

                            <div class="d-inline-block bg-white p-2 rounded-4 border shadow-sm">

                                <img src="{{ asset('storage/images/qris.jpeg') }}"
                                     alt="QRIS Pembayaran"
                                     class="qris-payment-image">

                            </div>

                            <p class="mt-2 mb-1 fw-bold text-dark">
                                Scan QRIS Untuk Melakukan Pembayaran
                            </p>

                            <small class="text-muted">
                                Total: Rp {{ number_format($totalSetelahDiskon, 0, ',', '.') }}
                            </small>

                        </div>

                        {{-- Tombol Checkout --}}
                        <button type="button"
                                onclick="openCheckoutModal()"
                                class="btn btn-success w-100 rounded-pill py-2.5 fw-bold shadow-sm fs-6 mb-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">

                            <i class="fa-solid fa-circle-check me-2"></i>

                            Checkout Transaksi

                        </button>

                    </form>

                    {{-- Form Batal Transaksi --}}
                    @can('delete', $sale)

                        <form action="{{ route('penjualan.destroy', $sale->id) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-outline-danger w-100 rounded-pill py-2 fw-semibold border-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">

                                <i class="fa-solid fa-xmark me-2"></i>

                                Batal Transaksi

                            </button>

                        </form>

                    @endcan

                </div>

            </div>

        </div>

    </div>

</div>

{{-- =========================================================
     MODAL KONFIRMASI CHECKOUT
     ========================================================= --}}
<div id="checkoutModal"
     class="delete-modal">

    <div class="delete-modal-box">

        {{-- Header Modal --}}
        <div class="delete-modal-header">

            <div class="d-flex align-items-center gap-3">

                <div class="delete-icon">

                    <i class="fa-solid fa-circle-check"></i>

                </div>

                <div>

                    <h5 class="fw-bold mb-1 text-white">
                        Checkout Transaksi
                    </h5>

                    <small class="text-white-50">
                        Konfirmasi pembayaran
                    </small>

                </div>

            </div>

            <button type="button"
                    class="delete-close"
                    onclick="closeCheckoutModal()">

                <i class="fa-solid fa-xmark"></i>

            </button>

        </div>

        {{-- Body Modal --}}
        <div class="delete-modal-body">

            <h5 class="fw-bold text-dark mb-2">
                Yakin ingin checkout?
            </h5>

            <p class="text-muted mb-0">
                Pastikan semua data transaksi dan pembayaran sudah benar.
            </p>

            <div class="delete-warning mt-3">

                <i class="fa-solid fa-circle-info me-2"></i>

                Setelah checkout, transaksi akan ditandai sebagai
                <strong>COMPLETED</strong>.

            </div>

        </div>

        {{-- Footer Modal --}}
        <div class="delete-modal-footer">

            <button type="button"
                    class="btn-delete-cancel"
                    onclick="closeCheckoutModal()">

                <i class="fa-solid fa-arrow-left me-2"></i>

                Batal

            </button>

            <button type="button"
                    class="btn-checkout-confirm"
                    onclick="submitCheckout()">

                <i class="fa-solid fa-circle-check me-2"></i>

                Ya, Checkout

            </button>

        </div>

    </div>

</div>

<script>

    /* =========================================================
       DATA STOK PRODUK DI KERANJANG
       ========================================================= */

    @php
        $stokKeranjang = $sale->ItemPenjualan->map(function ($item) {
            return [
                'nama' => $item->produk->nama,
                'quantity' => $item->kuantitas,
                'stok' => $item->produk->stok,
            ];
        })->values();
    @endphp

    const stokKeranjang = @json($stokKeranjang);


    /* =========================================================
       NOTIFIKASI STOK
       ========================================================= */

    function showStockWarning(message) {

        const alertBox =
            document.getElementById('stockWarningAlert');

        const alertMessage =
            document.getElementById('stockWarningMessage');

        if (!alertBox || !alertMessage) {
            return;
        }

        alertMessage.textContent = message;

        alertBox.style.display = 'block';

        window.clearTimeout(
            window.stockWarningTimer
        );

        window.stockWarningTimer = setTimeout(function () {

            closeStockWarning();

        }, 5000);

        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }


    function closeStockWarning() {

        const alertBox =
            document.getElementById('stockWarningAlert');

        if (alertBox) {
            alertBox.style.display = 'none';
        }
    }


    /* =========================================================
       CEK QUANTITY PRODUK DI KATALOG
       ========================================================= */

    document
        .querySelectorAll('.product-quantity')
        .forEach(function (input) {

            input.addEventListener('input', function () {

                const stock =
                    Number(this.dataset.stock) || 0;

                const quantity =
                    Number(this.value) || 0;

                this.classList.remove(
                    'quantity-warning'
                );

                if (quantity > stock) {

                    this.classList.add(
                        'quantity-warning'
                    );

                    showStockWarning(
                        'Jumlah yang dimasukkan melebihi stok yang tersedia. ' +
                        'Stok produk ini hanya ' +
                        stock +
                        ' unit.'
                    );
                }
            });
        });


    /* =========================================================
       CEK FORM TAMBAH PRODUK
       ========================================================= */

    document
        .querySelectorAll('form[action*="itempenjualan.store"]')
        .forEach(function (form) {

            form.addEventListener('submit', function (event) {

                const input =
                    form.querySelector('.product-quantity');

                if (!input) {
                    return;
                }

                const stock =
                    Number(input.dataset.stock) || 0;

                const quantity =
                    Number(input.value) || 0;

                input.classList.remove(
                    'quantity-warning'
                );


                if (stock <= 0) {

                    event.preventDefault();

                    input.classList.add(
                        'quantity-warning'
                    );

                    showStockWarning(
                        'Produk ini sedang habis. Silakan pilih produk lain.'
                    );

                    return;
                }


                if (quantity < 1) {

                    event.preventDefault();

                    input.classList.add(
                        'quantity-warning'
                    );

                    showStockWarning(
                        'Jumlah produk minimal 1.'
                    );

                    input.focus();

                    return;
                }


                if (quantity > stock) {

                    event.preventDefault();

                    input.classList.add(
                        'quantity-warning'
                    );

                    showStockWarning(
                        'Jumlah yang dimasukkan melebihi stok yang tersedia. ' +
                        'Stok produk ini hanya ' +
                        stock +
                        ' unit.'
                    );

                    input.focus();

                    return;
                }

            });
        });


    /* =========================================================
       CEK QUANTITY DI KERANJANG
       ========================================================= */

    function validateCartQuantity(input) {

        const quantityLama =
            Number(input.dataset.cartQuantity) || 0;

        const stokTersedia =
            Number(input.dataset.cartStock) || 0;

        const quantityBaru =
            Number(input.value) || 0;

        /*
         * Karena stok yang tampil sudah dikurangi oleh jumlah
         * yang ada di keranjang, yang boleh ditambahkan hanya
         * sebesar stok yang tersisa.
         */

        const tambahan =
            quantityBaru - quantityLama;


        if (quantityBaru < 1) {

            input.value =
                quantityLama;

            showStockWarning(
                'Jumlah produk minimal 1.'
            );

            return;
        }


        if (tambahan > stokTersedia) {

            input.value =
                quantityLama;

            showStockWarning(
                'Jumlah produk "' +
                (
                    input
                        .closest('tr')
                        ?.querySelector('td:first-child')
                        ?.textContent
                        .trim() || ''
                ) +
                '" melebihi stok yang tersedia. ' +
                'Stok tambahan yang tersedia hanya ' +
                stokTersedia +
                ' unit.'
            );

            return;
        }


        input.form.submit();
    }


    /* =========================================================
       PEMBAYARAN CASH & QRIS
       ========================================================= */

    const paymentMethod =
        document.getElementById('paymentMethod');

    const qrisPayment =
        document.getElementById('qrisPayment');

    const cashPayment =
        document.getElementById('cashPayment');

    const uangDibayar =
        document.getElementById('uangDibayar');

    const kembalian =
        document.getElementById('kembalian');


    /*
     * TOTAL YANG DIGUNAKAN UNTUK PEMBAYARAN
     *
     * Sudah memperhitungkan diskon 10%.
     *
     * Jika total belanja >= Rp1.000.000,
     * total pembayaran otomatis dikurangi 10%.
     */

    const totalPembayaran =
        {{ $totalSetelahDiskon }};


    /* =========================================================
       CEK METODE PEMBAYARAN
       ========================================================= */

    function checkPaymentMethod() {

        if (paymentMethod.value === 'QRIS') {

            qrisPayment.style.display =
                'block';

            cashPayment.style.display =
                'none';

            uangDibayar.value =
                '';

            kembalian.textContent =
                'Rp 0';

        }

        else if (paymentMethod.value === 'CASH') {

            qrisPayment.style.display =
                'none';

            cashPayment.style.display =
                'block';

        }

        else {

            qrisPayment.style.display =
                'none';

            cashPayment.style.display =
                'none';

            uangDibayar.value =
                '';

            kembalian.textContent =
                'Rp 0';
        }
    }


    /* =========================================================
       HITUNG KEMBALIAN
       ========================================================= */

    uangDibayar.addEventListener(
        'input',
        function () {

            const uang =
                Number(this.value) || 0;

            const hasil =
                uang - totalPembayaran;


            if (uang === 0) {

                kembalian.textContent =
                    'Rp 0';

            }

            else if (hasil >= 0) {

                kembalian.textContent =
                    'Rp ' +
                    hasil.toLocaleString('id-ID');

            }

            else {

                kembalian.textContent =
                    'Uang Kurang';
            }

        }
    );


    paymentMethod.addEventListener(
        'change',
        checkPaymentMethod
    );

    checkPaymentMethod();


    /* =========================================================
       MODAL CHECKOUT
       ========================================================= */

    function openCheckoutModal() {

        const ukuran =
            document.getElementById(
                'ukuranBaju'
            ).value;

        const metode =
            paymentMethod.value;


        /* =====================================================
           CEK KERANJANG KOSONG
           ===================================================== */

        if (stokKeranjang.length === 0) {

            alert(
                'Keranjang masih kosong.\n\n' +
                'Silakan pilih produk terlebih dahulu.'
            );

            return;
        }


        /* =====================================================
           CEK UKURAN
           ===================================================== */

        if (!ukuran) {

            alert(
                'Silakan pilih ukuran baju terlebih dahulu.'
            );

            return;
        }


        /* =====================================================
           CEK METODE PEMBAYARAN
           ===================================================== */

        if (!metode) {

            alert(
                'Silakan pilih metode pembayaran terlebih dahulu.'
            );

            return;
        }


        /* =====================================================
           CEK CASH
           ===================================================== */

        if (metode === 'CASH') {

            const uang =
                Number(uangDibayar.value) || 0;


            if (uang <= 0) {

                alert(
                    'Silakan masukkan uang yang dibayar.'
                );

                uangDibayar.focus();

                return;
            }


            if (uang < totalPembayaran) {

                alert(
                    'Uang yang dibayar kurang dari total pembayaran.'
                );

                uangDibayar.focus();

                return;
            }
        }


        /* =====================================================
           TAMPILKAN MODAL CHECKOUT
           ===================================================== */

        const modal =
            document.getElementById(
                'checkoutModal'
            );

        modal.classList.add('show');

        document.body.style.overflow =
            'hidden';
    }


    /* =========================================================
       TUTUP MODAL CHECKOUT
       ========================================================= */

    function closeCheckoutModal() {

        const modal =
            document.getElementById(
                'checkoutModal'
            );

        modal.classList.remove(
            'show'
        );

        document.body.style.overflow =
            '';
    }


    /* =========================================================
       SUBMIT CHECKOUT
       ========================================================= */

    function submitCheckout() {

        document
            .getElementById(
                'checkoutForm'
            )
            .submit();
    }


    /* =========================================================
       KLIK DI LUAR MODAL
       ========================================================= */

    document
        .getElementById('checkoutModal')
        .addEventListener(
            'click',
            function (event) {

                if (event.target === this) {

                    closeCheckoutModal();
                }
            }
        );


    /* =========================================================
       TOMBOL ESC
       ========================================================= */

    document.addEventListener(
        'keydown',
        function (event) {

            if (event.key === 'Escape') {

                closeCheckoutModal();
            }
        }
    );

</script>

@endsection