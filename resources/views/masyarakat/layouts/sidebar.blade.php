<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('masyarakat.dashboard') ? '' : 'collapsed' }}"
                href="{{ route('masyarakat.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('masyarakat.pengaduan.index') || request()->routeIs('masyarakat.pengaduan.show') ? '' : 'collapsed' }}"
                href="{{ route('masyarakat.pengaduan.index') }}">
                <i class="bi bi-journal-text"></i>
                <span>Pengaduan Saya</span>
            </a>
        </li><!-- End Pengaduan Nav -->



        <li class="nav-item">
            <a class="nav-link collapsed" href="#"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Keluar</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li><!-- End Logout Nav -->

    </ul>

</aside><!-- End Sidebar-->
