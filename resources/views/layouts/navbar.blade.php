<nav class="navbar navbar-expand-lg bg-white bg-opacity-75 backdrop-blur shadow-sm sticky-top py-2">
  <div class="container-fluid px-4">
    <!-- Brand Logo / Title -->
    <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-dark fs-5 me-4" href="#">
      <span class="bg-primary text-white rounded-3 px-2 py-1 fs-6 shadow-sm">
        <i class="bi bi-shop"></i>
      </span>
      <span>Aplikasi <span class="text-primary">POS</span></span>
    </a>

    <!-- Mobile Toggler Button -->
    <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Content -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-1">
        <li class="nav-item">
          <a class="nav-link rounded-pill px-3 py-2 transition-all {{ Request::is('beranda') ? 'active-nav fw-bold text-primary bg-primary bg-opacity-10' : 'text-secondary opacity-75 fw-medium hover-nav' }}" href="{{ route('beranda') }}">
            Beranda
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link rounded-pill px-3 py-2 transition-all {{ Request::is('admin/users') ? 'active-nav fw-bold text-primary bg-primary bg-opacity-10' : 'text-secondary opacity-75 fw-medium hover-nav' }}" href="{{ route('admin.users') }}">
            Pengguna
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link rounded-pill px-3 py-2 transition-all {{ Request::is('produk') ? 'active-nav fw-bold text-primary bg-primary bg-opacity-10' : 'text-secondary opacity-75 fw-medium hover-nav' }}" href="{{ route('produk.index') }}">
            Produk
          </a>
        </li>
        </li>
        <li class="nav-item">
          <a class="nav-link rounded-pill px-3 py-2 transition-all {{ Request::is('penjualan') ? 'active-nav fw-bold text-primary bg-primary bg-opacity-10' : 'text-secondary opacity-75 fw-medium hover-nav' }}" href="{{ route('penjualan.index') }}">
            Penjualan
          </a>
        </li>
      </ul>

      <!-- Logout Button -->
      <form action="{{ route('logout') }}" method="POST" class="d-flex m-0">
        @csrf
        <button type="submit" class="btn btn-danger btn-logout d-flex align-items-center gap-2 px-4 py-2 rounded-pill fw-semibold shadow-sm">
          <i class="bi bi-box-arrow-right"></i>
          <span>Keluar</span>
        </button>
      </form>
    </div>
  </div>
</nav>

<!-- Tambahkan sedikit CSS custom ini di bagian <style> atau file CSS kamu -->
<style>
  .backdrop-blur {
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
  }
  .transition-all {
    transition: all 0.2s ease-in-out;
  }
  .hover-nav:hover {
    color: var(--bs-primary) !important;
    background-color: rgba(var(--bs-primary-rgb), 0.05);
    opacity: 1 !important;
  }
  .btn-logout {
    transition: all 0.2s ease-in-out;
  }
  .btn-logout:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3) !important;
  }
</style>