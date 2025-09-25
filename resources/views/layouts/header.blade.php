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
                <h1 class="logo-text">CEKATAN</h1>
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

                    <li><a href="#contact">Dokumen</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <div class="cta-btn-container cta-btn">
                <a class="btn-link" href="{{ route('pengaduan.form') }}">
                    <i class="fas fa-comment-alt"></i> PENGADUAN
                </a>
                <span class="separator">|</span>
                @if (Auth::check())
                    <a class="btn-link" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> DASHBOARD
                    </a>
                @else
                    <a class="btn-link" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt"></i> LOGIN
                    </a>
                @endif
            </div>

            <style>
                .cta-btn-container {
                    display: flex;
                    align-items: center;
                    background-color: #FFCB05;
                    /* Yellow color from your website */
                    padding: 10px 20px;
                    border-radius: 4px;
                }

                .btn-link {
                    color: #fff;
                    text-decoration: none;
                    font-weight: bold;
                    display: flex;
                    align-items: center;
                    gap: 6px;
                    transition: color 0.3s ease;
                }

                .btn-link:hover {
                    color: #1976d2;
                }

                .btn-link i {
                    font-size: 16px;
                }

                .separator {
                    margin: 0 15px;
                    font-weight: bold;
                    color: #fff;
                }

                /* Default: Hide on mobile */
                .logo-text {
                    display: none;
                }

                /* Medium devices (tablets, 768px and up) */
                @media (min-width: 768px) {
                    .logo-text {
                        display: block;
                        margin-left: 10px;
                        margin-bottom: 0;
                    }
                }
            </style>
        </div>
    </div>
</header>
