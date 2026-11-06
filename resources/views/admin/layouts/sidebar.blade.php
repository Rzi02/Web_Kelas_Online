<style>
    .sidebar {
        background: #f8f9ff;
        min-height: 100vh;
        padding: 20px;
        border-right: 1px solid #e8e8f5;
    }

    .sidebar-header {
        background: linear-gradient(135deg, #5146d8, #7967f0);
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 30px;
        box-shadow: 0 4px 12px rgba(81, 70, 216, .15);
    }

    .sidebar-header h4 {
        color: #ffffff;
        font-weight: 700;
        margin-bottom: 0;
    }

    .sidebar-menu a {
        display: block;
        color: #62627a;
        text-decoration: none;
        padding: 12px 15px;
        margin-bottom: 8px;
        border-radius: 9px;
        transition: .2s;
        font-weight: 500;
    }

    .sidebar-menu a:hover {
        background: #eeecff;
        color: #5146d8;
    }

    .sidebar-menu a.active {
        background: #5146d8;
        color: #ffffff;
        box-shadow: 0 4px 10px rgba(81, 70, 216, .18);
    }

    .sidebar-menu-toggle {
        display: none;
        color: #ffffff;
        background: transparent;
        border: 1px solid rgba(255,255,255,.5);
        border-radius: 8px;
        padding: 6px 10px;
    }

    .sidebar-menu form .btn {
        border-color: #5146d8;
        color: #5146d8;
        border-radius: 8px;
    }

    .sidebar-menu form .btn:hover {
        background: #5146d8;
        color: #ffffff;
    }

    @media (max-width: 767.98px) {
        .sidebar {
            min-height: auto;
            padding: 15px 18px;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0;
        }

        .sidebar-menu-toggle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-menu {
            padding-top: 15px;
        }

        .sidebar-menu.is-collapsible {
            display: none;
        }

        .sidebar-menu.is-collapsible.is-open {
            display: block;
        }
    }
</style>

<div class="col-12 col-md-2 sidebar">
    <div class="sidebar-header">
        <h4>Admin</h4>

        <button type="button"
                class="sidebar-menu-toggle"
                aria-label="Buka menu navigasi"
                aria-expanded="false"
                aria-controls="adminSidebarMenu">
            <i class="bi bi-list fs-4"></i>
        </button>
    </div>

    <nav id="adminSidebarMenu" class="sidebar-menu">

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

    </nav>
</div>

<script>
(function () {
    const sidebarToggle = document.querySelector('.sidebar-menu-toggle');
    const sidebarMenu = document.getElementById('adminSidebarMenu');

    if (sidebarToggle && sidebarMenu) {
        sidebarMenu.classList.add('is-collapsible');

        sidebarToggle.addEventListener('click', () => {
            const isOpen = sidebarMenu.classList.toggle('is-open');

            sidebarToggle.setAttribute('aria-expanded', String(isOpen));

            sidebarToggle.setAttribute(
                'aria-label',
                isOpen ? 'Tutup menu navigasi' : 'Buka menu navigasi'
            );
        });
    }
})();
</script>