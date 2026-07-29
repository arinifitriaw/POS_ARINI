@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')

@include('layouts.navbar')

<div class="container py-4">

    <!-- Header Banner Gradient -->
    <div class="card border-0 rounded-4 mb-4 text-white p-4 shadow-sm" 
         style="background: linear-gradient(135deg, #6f42c1 0%, #e83e8c 100%);">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-1">Edit Product</h2>
                <p class="mb-0 text-white-50">Perbarui data informasi produk</p>
            </div>
            <a href="{{ route('produk.index') }}" class="btn btn-light rounded-pill px-4 font-weight-bold text-dark shadow-sm">
                ← Kembali
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card shadow border-0 rounded-4 overflow-hidden">

        <div class="card-header text-white fw-bold py-3" style="background-color: #6f42c1;">
            <i class="bi bi-pencil-square me-1"></i> Form Edit Produk
        </div>

        <div class="card-body p-4">

            <form action="{{ route('produk.update', $produk) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                @include('Produk._form')

            </form>

        </div>

    </div>

</div>

@endsection