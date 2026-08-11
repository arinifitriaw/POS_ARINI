<nav class="navbar navbar-expand-lg bg-white bg-opacity-75 backdrop-blur shadow-sm sticky-top py-2">
  <div class="container-fluid px-4">
    <!-- Brand Logo / Title -->
    <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-dark fs-5 me-4" href="#">
      <span class="brand-icon text-white rounded-3 px-2 py-1 fs-6 shadow-sm">
        <i class="bi bi-shop"></i>
      </span>
      <span>Syntez <span class="text-slate-muted">Official</span></span>
    </a>

    <!-- Mobile Toggler Button -->
    <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Content -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-1">
        <li class="nav-item">
          <a class="nav-link rounded-pill px-3 py-2 transition-all {{ Request::is('beranda') ? 'active-nav fw-bold' : 'text-secondary opacity-75 fw-medium hover-nav' }}" href="{{ route('beranda') }}">
            Beranda
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link rounded-pill px-3 py-2 transition-all {{ Request::is('admin/users*') ? 'active-nav fw-bold' : 'text-secondary opacity-75 fw-medium hover-nav' }}" href="{{ route('admin.users') }}">
            Pengguna
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link rounded-pill px-3 py-2 transition-all {{ Request::is('produk*') ? 'active-nav fw-bold' : 'text-secondary opacity-75 fw-medium hover-nav' }}" href="{{ route('produk.index') }}">
            Produk
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link rounded-pill px-3 py-2 transition-all {{ Request::is('penjualan*') ? 'active-nav fw-bold' : 'text-secondary opacity-75 fw-medium hover-nav' }}" href="{{ route('penjualan.index') }}">
            Penjualan
          </a>
        </li>
      </ul>

      <!-- Logout Button -->
      <form action="{{ route('logout') }}" method="POST" class="d-flex m-0">
        @csrf
        <button type="submit" class="btn btn-dark btn-logout d-flex align-items-center gap-2 px-4 py-2 rounded-pill fw-semibold shadow-sm">
          <i class="bi bi-box-arrow-right"></i>
          <span>Keluar</span>
        </button>
      </form>
    </div>
  </div>
</nav>

<style>
  .backdrop-blur {
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
  }
  .transition-all {
    transition: all 0.2s ease-in-out;
  }
  .brand-icon {
    background-color: #334155;
  }
  .text-slate-muted {
    color: #475569;
  }
  .active-nav {
    background-color: #e2e8f0 !important;
    color: #0f172a !important;
  }
  .hover-nav:hover {
    color: #0f172a !important;
    background-color: #f1f5f9;
    opacity: 1 !important;
  }
  .btn-logout {
    background-color: #334155;
    border: none;
    transition: all 0.2s ease-in-out;
  }
  .btn-logout:hover {
    background-color: #0f172a;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.25) !important;
  }
</style>