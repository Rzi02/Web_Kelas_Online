<div class="col-md-2 sidebar">
    <h4>KelasOnline</h4>

    <a href="{{ route('admin.dashboard') }}"
       class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="bi bi-grid me-2"></i> Dashboard
    </a>

    <a href="{{ route('admin.kelas') }}"
       class="{{ request()->routeIs('admin.kelas*') ? 'active' : '' }}">
        <i class="bi bi-book me-2"></i> Kelola Kelas
    </a>

    <a href="{{ route('admin.kategori') }}"
       class="{{ request()->routeIs('admin.kategori*') ? 'active' : '' }}">
        <i class="bi bi-tags me-2"></i> Kategori
    </a>

    <a href="{{ route('admin.pendaftaran') }}"
       class="{{ request()->routeIs('admin.pendaftaran*') ? 'active' : '' }}">
        <i class="bi bi-people me-2"></i> Kelola Pendaftar
    </a>

    <a href="{{ route('home') }}" target="_blank">
        <i class="bi bi-globe me-2"></i> Lihat Website
    </a>

    <form action="{{ route('logout') }}" method="POST" class="mt-3">
        @csrf
        <button type="submit" class="btn btn-outline-light w-100">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </button>
    </form>
</div>