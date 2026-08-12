@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

@include('layouts.navbar')

{{-- CDN FontAwesome --}}
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* =========================
       BACKGROUND
       ========================= */
    body {
        background-color: #f1f5f9;
        color: #334155;
    }

    /* =========================
       HERO BANNER
       ========================= */
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

    /* =========================
       SEARCH
       ========================= */
    .search-card {
        background: #ffffff;
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        transition: all 0.3s ease;
    }

    .search-card:focus-within {
        border-color: #475569;
        box-shadow: 0 0 0 4px rgba(51, 65, 85, 0.12);
    }

    /* =========================
       BUTTON HERO
       ========================= */
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

    /* =========================
       BUTTON SEARCH
       ========================= */
    .btn-gradient-slate {
        background: linear-gradient(135deg, #334155 0%, #475569 100%);
        color: white;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-gradient-slate:hover {
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        color: white;
    }

    /* =========================
       TABLE HEADER
       ========================= */
    .card-header-slate {
        background-color: #f8fafc;
        color: #1e293b;
        border-bottom: 1px solid #e2e8f0 !important;
        padding: 1.25rem 1.5rem;
    }

    /* =========================
       ACTION BUTTON
       ========================= */
    .action-grid {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        gap: 6px;
        width: 100%;
    }

    .action-grid form {
        margin: 0 !important;
        padding: 0 !important;
        display: inline-flex;
    }

    .btn-action-outline {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        width: 85px;
        height: 32px;

        font-size: 0.8rem;
        font-weight: 700;

        border-radius: 50rem;
        background-color: #ffffff;

        text-decoration: none;
        cursor: pointer;
        box-sizing: border-box;

        line-height: 1;
        white-space: nowrap;

        transition: all 0.2s ease-in-out;
    }

    /* Tombol Detail & Lanjutkan */
    .btn-outline-slate {
        border: 1.5px solid #94a3b8;
        color: #475569;
    }

    .btn-outline-slate:hover {
        background-color: #f8fafc;
        border-color: #475569;
        color: #0f172a;
    }

    /* Tombol Hapus */
    .btn-outline-danger-custom {
        border: 1.5px solid #f87171;
        color: #ef4444;
    }

    .btn-outline-danger-custom:hover {
        background-color: #fef2f2;
        border-color: #dc2626;
        color: #b91c1c;
    }

    /* =========================
       MODAL HAPUS
       ========================= */
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

    /* Header Modal */
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

    /* Body Modal */
    .delete-modal-body {
        padding: 24px;
        text-align: center;
    }

    .delete-warning {
        background: #fff7ed;
        color: #c2410c;

        border: 1px solid #fed7aa;
        border-radius: 12px;

        padding: 12px 14px;

        font-size: 13px;
        text-align: left;
    }

    /* Footer Modal */
    .delete-modal-footer {
        padding: 0 24px 24px;

        display: flex;
        gap: 10px;
    }

    .delete-modal-footer form {
        flex: 1;
        margin: 0;
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

    /* =========================
       ANIMATION
       ========================= */
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

    /* =========================
       RESPONSIVE
       ========================= */
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

    {{-- =========================
         ALERT NOTIFIKASI
         ========================= --}}
    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 alert-dismissible fade show">

            <i class="fa-solid fa-circle-exclamation me-2"></i>

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close">
            </button>

        </div>
    @endif


    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 alert-dismissible fade show">

            <i class="fa-solid fa-circle-check me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close">
            </button>

        </div>
    @endif


    {{-- =========================
         HERO HEADER
         ========================= --}}
    <div class="hero-banner-sales mb-4">

        <div class="row align-items-center">

            <div class="col-md-7">

                <div class="d-flex align-items-center gap-3">

                    <div class="icon-box-banner">
                        <i class="fa-solid fa-receipt fa-2x text-white"></i>
                    </div>

                    <div>

                        <h2 class="fw-bold mb-1">
                            Halaman Penjualan
                        </h2>

                        <p class="mb-0 text-white-50">
                            Kelola dan pantau seluruh riwayat transaksi kasir POS
                        </p>

                    </div>

                </div>

            </div>


            <div class="col-md-5 text-md-end mt-3 mt-md-0">

                <a href="{{ route('penjualan.create') }}"
                   class="btn btn-gradient-light rounded-pill px-4 py-2 fw-bold shadow-sm">

                    <i class="fa-solid fa-plus-circle me-2"></i>
                    Tambah Penjualan

                </a>

            </div>

        </div>

    </div>


    {{-- =========================
         SEARCH
         ========================= --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4"
         style="border: 1px solid #e2e8f0 !important;">

        <div class="card-body p-3">

            <form action="{{ route('penjualan.index') }}" method="GET">

                <div class="input-group search-card p-1">

                    <span class="input-group-text bg-transparent border-0 ps-3">

                        <i class="fa-solid fa-magnifying-glass text-secondary"></i>

                    </span>


                    <input type="text"
                           name="search"
                           value="{{ request()->search }}"
                           class="form-control border-0 shadow-none bg-transparent"
                           placeholder="Cari penjualan berdasarkan nama kasir...">


                    <button class="btn btn-gradient-slate rounded-3 px-4 fw-bold"
                            type="submit">

                        Cari

                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- =========================
         DATA TABLE
         ========================= --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4"
         style="border: 1px solid #e2e8f0 !important;">

        <div class="card-header card-header-slate d-flex justify-content-between align-items-center">

            <h5 class="fw-bold mb-0 fs-6">

                <i class="fa-solid fa-list-check text-secondary me-2"></i>

                Daftar Penjualan

            </h5>


            <span class="badge bg-white text-dark border rounded-pill px-3 py-2 fw-bold"
                  style="font-size: 0.75rem;">

                Total: {{ $sales->total() }} Transaksi

            </span>

        </div>


        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead style="background-color: #f8fafc; color: #64748b;">

                    <tr>

                        <th class="ps-4 py-3">#</th>

                        <th class="py-3">
                            Tanggal Transaksi
                        </th>

                        <th class="py-3">
                            Kasir
                        </th>

                        <th class="py-3">
                            Total Pembayaran
                        </th>

                        <th class="py-3">
                            Metode Pembayaran
                        </th>

                        <th class="py-3">
                            Status
                        </th>

                        <th class="text-center py-3" width="290">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($sales as $sale)

                        <tr class="border-bottom"
                            style="border-color: #f1f5f9 !important;">

                            {{-- NOMOR --}}
                            <td class="ps-4 fw-bold text-muted">

                                {{ $sales->firstItem() + $loop->index }}

                            </td>


                            {{-- TANGGAL --}}
                            <td class="fw-semibold text-dark">

                                <i class="fa-regular fa-clock text-secondary me-1"></i>

                                {{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}

                            </td>


                            {{-- KASIR --}}
                            <td>

                                <span class="fw-semibold text-dark">

                                    <i class="fa-solid fa-user-tie text-secondary me-1"></i>

                                    {{ $sale->user?->name ?? 'Pengguna Terhapus' }}

                                </span>

                            </td>


                            {{-- TOTAL --}}
                            <td class="fw-bold text-success">

                                Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}

                            </td>


                            {{-- METODE PEMBAYARAN --}}
                            <td>

                                @if($sale->metode_pembayaran == 'CASH')

                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fw-bold">

                                        <i class="fa-solid fa-money-bill-wave me-1"></i>

                                        CASH

                                    </span>

                                @elseif($sale->metode_pembayaran == 'QRIS')

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

                            </td>


                            {{-- STATUS --}}
                            <td>

                                @if($sale->status == 'COMPLETED')

                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fw-bold">

                                        <i class="fa-solid fa-circle-check me-1"></i>

                                        COMPLETED

                                    </span>

                                @else

                                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-3 py-1 fw-bold">

                                        <i class="fa-solid fa-clock-rotate-left me-1"></i>

                                        OPEN

                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td class="text-center">

                                <div class="action-grid">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('penjualan.show', $sale) }}"
                                       class="btn-action-outline btn-outline-slate">

                                        Detail

                                    </a>


                                    {{-- LANJUTKAN --}}
                                    @can('view', $sale)

                                        <a href="{{ route('penjualan.edit', $sale) }}"
                                           class="btn-action-outline btn-outline-slate">

                                            Lanjutkan

                                        </a>

                                    @endcan


                                    {{-- HAPUS --}}
                                    @can('delete', $sale)

                                        <button type="button"
                                                class="btn-action-outline btn-outline-danger-custom"
                                                onclick="openDeleteModal('{{ $sale->id }}')">

                                            Hapus

                                        </button>

                                    @endcan

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="text-center py-5 text-muted">

                                <i class="fa-solid fa-receipt fa-3x mb-3 opacity-50"></i>

                                <p class="mb-0 fw-bold">
                                    Data penjualan tidak ditemukan.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- =========================
         PAGINATION
         ========================= --}}
    <div class="mt-4 d-flex justify-content-end">

        {{ $sales->links() }}

    </div>

</div>


{{-- =========================================================
     MODAL KONFIRMASI HAPUS
     ========================================================= --}}

<div id="deleteModal" class="delete-modal">

    <div class="delete-modal-box">


        {{-- HEADER MODAL --}}
        <div class="delete-modal-header">

            <div class="d-flex align-items-center gap-3">

                <div class="delete-icon">

                    <i class="fa-solid fa-trash-can"></i>

                </div>


                <div>

                    <h5 class="fw-bold mb-1 text-white">
                        Hapus Penjualan
                    </h5>

                    <small class="text-white-50">
                        Konfirmasi tindakan
                    </small>

                </div>

            </div>


            <button type="button"
                    class="delete-close"
                    onclick="closeDeleteModal()">

                <i class="fa-solid fa-xmark"></i>

            </button>

        </div>


        {{-- BODY MODAL --}}
        <div class="delete-modal-body">

            <h5 class="fw-bold text-dark mb-2">
                Apakah kamu yakin ingin menghapus penjualan ini?
            </h5>

            <div class="delete-warning mt-3">

                <i class="fa-solid fa-triangle-exclamation me-2"></i>

                Data transaksi yang dihapus tidak dapat dikembalikan.

            </div>

        </div>


        {{-- FOOTER MODAL --}}
        <div class="delete-modal-footer">

            <button type="button"
                    class="btn-delete-cancel"
                    onclick="closeDeleteModal()">

                <i class="fa-solid fa-arrow-left me-2"></i>

                Batal

            </button>


            <form id="deleteForm" method="POST">

                @csrf

                @method('DELETE')

                <button type="submit"
                        class="btn-delete-confirm">

                    <i class="fa-solid fa-trash-can me-2"></i>

                    Ya, Hapus

                </button>

            </form>

        </div>

    </div>

</div>


{{-- =========================
     JAVASCRIPT MODAL
     ========================= --}}
<script>

    function openDeleteModal(id) {

        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');

        form.action = "{{ url('penjualan') }}/" + id;

        modal.classList.add('show');

        document.body.style.overflow = 'hidden';
    }


    function closeDeleteModal() {

        const modal = document.getElementById('deleteModal');

        modal.classList.remove('show');

        document.body.style.overflow = '';
    }


    // Klik area luar modal untuk menutup
    document.getElementById('deleteModal').addEventListener('click', function (event) {

        if (event.target === this) {

            closeDeleteModal();

        }

    });


    // Tombol ESC untuk menutup modal
    document.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {

            closeDeleteModal();

        }

    });

</script>

@endsection