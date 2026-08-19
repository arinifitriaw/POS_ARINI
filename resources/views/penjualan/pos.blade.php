@extends('layouts.app')

@section('title')

@section('content')

@include('layouts.navbar')

<!-- CDN FontAwesome untuk Icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
    }
</style>


<div class="container py-4">

    <!-- Alert Error Handling -->
    @if(session('errors'))

        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 alert-dismissible fade show">

            <i class="fa-solid fa-circle-exclamation me-2"></i>

            {{ session('errors') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close">
            </button>

        </div>

    @endif


    <!-- =========================================================
         HERO HEADER
         ========================================================= -->

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


    <!-- =========================================================
         MAIN CONTENT
         ========================================================= -->

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

                    <!-- Form Pencarian Produk -->

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


                    <!-- Scrollable Product List -->

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

                                        </div>

                                    </div>

                                </div>


                                {{-- Input Quantity --}}

                                <div class="col-3">

                                    <input type="number"
                                           name="quantity"
                                           value="1"
                                           min="1"
                                           class="form-control text-center rounded-3 shadow-none fw-semibold border-secondary-subtle {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}">

                                </div>


                                {{-- Tombol Tambah --}}

                                <div class="col-2">

                                    <button class="btn btn-slate-primary w-100 rounded-3 py-2 fw-bold shadow-sm {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}"
                                            title="Tambah Ke Keranjang">

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
                                                       class="form-control form-control-sm text-center rounded-3 shadow-none fw-bold"
                                                       onchange="this.form.submit()"
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


                <!-- =========================================================
                     FOOTER PEMBAYARAN
                     ========================================================= -->

                <div class="card-footer bg-white p-3 border-top"
                     style="border-color:#e2e8f0 !important;">


                    <!-- Total Pembayaran -->

                    <div class="total-price-box p-3 mb-3 d-flex justify-content-between align-items-center">

                        <span class="fw-bold text-dark mb-0">
                            Total Pembayaran
                        </span>

                        <h3 class="fw-bold text-success mb-0">

                            Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}

                        </h3>

                    </div>


                    <!-- Form Checkout -->

                    <form method="POST"
                          action="{{ route('penjualan.update', $sale->id) }}"
                          id="checkoutForm">

                        @csrf
                        @method('PUT')


                        <!-- Ukuran Baju -->

                        <div class="mb-3">

                            <label class="form-label fw-bold text-secondary fs-7 text-uppercase mb-1">
                                Ukuran Baju
                            </label>

                            <select name="ukuran_baju"
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


                        <!-- Metode Pembayaran -->

                        <div class="mb-3">

                            <label class="form-label fw-bold text-secondary fs-7 text-uppercase mb-1">
                                Metode Pembayaran
                            </label>

                            <select name="payment_method"
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


                        <!-- Tombol Checkout -->

                        <button type="button"
                                onclick="openCheckoutModal()"
                                class="btn btn-success w-100 rounded-pill py-2.5 fw-bold shadow-sm fs-6 mb-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">

                            <i class="fa-solid fa-circle-check me-2"></i>

                            Checkout Transaksi

                        </button>

                    </form>


                    <!-- Form Batal Transaksi -->

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


<!-- =========================================================
     MODAL KONFIRMASI CHECKOUT
     ========================================================= -->

<div id="checkoutModal"
     class="delete-modal">

    <div class="delete-modal-box">


        <!-- Header Modal -->

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


        <!-- Body Modal -->

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


        <!-- Footer Modal -->

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
       MODAL CHECKOUT
       ========================================================= */

    function openCheckoutModal() {

        const modal = document.getElementById('checkoutModal');

        modal.classList.add('show');

        document.body.style.overflow = 'hidden';

    }


    function closeCheckoutModal() {

        const modal = document.getElementById('checkoutModal');

        modal.classList.remove('show');

        document.body.style.overflow = '';

    }


    function submitCheckout() {

        document.getElementById('checkoutForm').submit();

    }


    /* Klik area luar modal */

    document.getElementById('checkoutModal').addEventListener('click', function(event) {

        if (event.target === this) {

            closeCheckoutModal();

        }

    });


    /* Tombol ESC */

    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {

            closeCheckoutModal();

        }

    });

</script>

@endsection