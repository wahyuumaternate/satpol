<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('backend.organization-profile.admin.index') }}"
                class="{{ request()->routeIs('backend.organization-profile.*') && !request()->routeIs('backend.organization-profile.edit') && !request()->routeIs('backend.organization-profile.show') ? 'active' : '' }}">
                <i class="bi bi-person-badge"></i><span>Profil</span>
            </a>
        </li><!-- End Profil Nav -->



        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#informasi-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-info-circle"></i><span>Berita</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="informasi-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Lihat Semua Berita</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Kategori Berita</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Informasi Publik Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#ppid-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-file-earmark-text"></i><span>PPID</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="ppid-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Berkala</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Setiap Saat</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Serta Merta</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Dikecualikan</span>
                    </a>
                </li>
            </ul>
        </li><!-- End PPID Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#galeri-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-images"></i><span>Galeri</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="galeri-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Galeri Foto</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Galeri Video</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Galeri Nav -->


        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('backend.pengaduan.index') }}">
                <i class="bi bi-megaphone"></i>
                <span>Pengaduan</span>
            </a>
        </li><!-- End Pengaduan Nav -->

        <li class="nav-heading">Pengaturan</li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#artikel-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-newspaper"></i><span>Artikel & Berita</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="artikel-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Tambah Artikel</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Kelola Artikel</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Kategori</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Artikel Nav -->


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>Pengguna</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="users-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Tambah Pengguna</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Kelola Pengguna</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Users Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-gear"></i>
                <span>Pengaturan Situs</span>
            </a>
        </li><!-- End Settings Nav -->

    </ul>

</aside><!-- End Sidebar-->
