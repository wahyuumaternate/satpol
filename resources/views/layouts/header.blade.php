<header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center text-white">
        <div class="running-text">
            Selamat datang di Website Kami
        </div>
    </div>
    <!-- End Top Bar -->

    <div class="branding d-flex align-items-center">
        <div class="container position-relative d-flex align-items-center justify-content-end">

            <!-- Logo -->
            <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
                <img src="{{ asset('logo.png') }}" alt="Logo">
                <h1>CEKATAN</h1>
            </a>

            <!-- Navbar -->
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li class="dropdown"><a href="#"><span>Profil</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="{{ url('/profile/tentang') }}">Profil Reformer</a></li>
                            <li><a href="{{ url('/profile/tentang') }}">Tentang</a></li>
                            <li><a href="{{ url('/profile/tugas-fungsi') }}">Tugas dan Fungsi</a></li>
                            <li><a href="{{ url('/profile/struktur-organisasi') }}">Struktur Organisasi</a></li>
                        </ul>
                    </li>

                    <li><a href="#contact">Berita</a></li>


                    <li class="dropdown"><a href="#"><span>PPID</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="{{ url('/klasifikasi/berkala') }}">Berkala</a></li>
                            <li><a href="{{ url('/klasifikasi/setiap-saat') }}">Setiap Saat</a></li>
                            <li><a href="{{ url('/klasifikasi/serta-merta') }}">Serta Merta</a></li>
                            <li><a href="{{ url('/klasifikasi/dikecualikan') }}">Dikecualikan</a></li>
                        </ul>
                    </li>

                    <li class="dropdown"><a href="#"><span>Galeri</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="{{ url('/galeri/foto') }}">Galeri Foto</a></li>
                            <li><a href="{{ url('/galeri/video') }}">Galeri Video</a></li>
                        </ul>
                    </li>

                    <li><a href="#contact">Kontak</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="cta-btn" href="#appointment">PENGADUAN</a>
        </div>
    </div>
</header>
