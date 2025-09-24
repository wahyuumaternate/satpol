@extends('layouts.main')
@push('styles')
    <style>
        :root {
            --primary-color: #253900;
            --secondary-color: #ffffff;
            --text-color: #333;
            --border-color: #e9ecef;
            --gradient-primary: linear-gradient(135deg, #253900, #1a2700);
        }


        /* Header */
        .pengaduan-header {
            background: var(--gradient-primary);
            color: white;
            padding: 100px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .pengaduan-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }

        .pengaduan-header .container {
            position: relative;
            z-index: 2;
        }

        .pengaduan-header h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .pengaduan-header p {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Section Styling */
        .section-padding {
            padding: 80px 0;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: #6c757d;
            margin-bottom: 3rem;
        }

        /* Form Section */
        .form-section {
            background: var(--secondary-color);
        }

        .form-card {
            background: var(--secondary-color);
            border: 2px solid var(--primary-color);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 5px 30px rgba(37, 57, 0, 0.1);
            height: 100%;
            transition: all 0.3s ease;
        }

        .form-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 40px rgba(37, 57, 0, 0.2);
        }

        .form-icon {
            width: 80px;
            height: 80px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            color: white;
            font-size: 2rem;
        }

        /* Informasi Section */
        .informasi-section {
            background: #f8fdf4;
        }

        .informasi-item {
            background: var(--secondary-color);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 20px;
            border-left: 5px solid var(--primary-color);
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(37, 57, 0, 0.08);
        }

        .informasi-item:hover {
            transform: translateX(10px);
            box-shadow: 0 10px 40px rgba(37, 57, 0, 0.15);
        }

        .informasi-number {
            display: inline-flex;
            width: 70px;
            height: 40px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            line-height: 1;
            /* biar teks rata tengah vertikal */
            font-size: 16px;
            /* atur sesuai proporsi */
            margin-right: 15px;
        }

        .informasi-item:hover .informasi-number {
            background: #1a2700;
            transform: scale(1.1);
        }

        /* Jenis Pengaduan Section */
        .kategori-section {
            background: var(--secondary-color);
        }

        .kategori-card {
            background: var(--secondary-color);
            border: 2px solid var(--border-color);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
        }

        .kategori-card:hover {
            border-color: var(--primary-color);
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(37, 57, 0, 0.1);
        }

        .kategori-icon {
            width: 100px;
            height: 100px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 2.5rem;
        }

        .kategori-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        /* Keuntungan Section */
        .keuntungan-section {
            background: var(--gradient-primary);
            color: white;
        }

        .keuntungan-item {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .keuntungan-item:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-5px);
        }

        .keuntungan-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: white;
            transition: transform 0.25s ease, color 0.25s ease;
        }

        .keuntungan-item:hover .keuntungan-icon {
            transform: scale(1.05) rotate(-3deg);
            color: #f1c40f;
            /* kuning elegan */
        }


        .keuntungan-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: #ffffff;
        }

        /* Status Section */
        .status-section {
            background: #f8fdf4;
        }

        .status-card {
            background: var(--secondary-color);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(37, 57, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
        }

        .status-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(37, 57, 0, 0.15);
        }

        .status-header {
            height: 100px;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            font-weight: 500;
            position: relative;
        }

        .status-content {
            padding: 25px;
        }

        .status-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .status-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--text-color);
        }

        .status-text {
            color: #6c757d;
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .btn-cek-status {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
        }

        .btn-cek-status:hover {
            color: #1a2700;
            gap: 10px;
        }

        /* Form styling */
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(37, 57, 0, 0.25);
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }

        .form-select {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(37, 57, 0, 0.25);
        }

        .form-text {
            color: #6c757d;
            font-size: 0.85rem;
            margin-top: 5px;
        }

        /* Statistics Cards */
        .stats-card {
            background: var(--secondary-color);
            border: 2px solid var(--primary-color);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(37, 57, 0, 0.08);
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(37, 57, 0, 0.2);
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .stats-label {
            color: #6c757d;
            font-weight: 500;
        }

        .stats-card:hover .stats-number {
            animation: pulse 0.6s ease-in-out;
        }

        /* Button Styles */
        .btn {
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: #1a2700;
            border-color: #1a2700;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 57, 0, 0.3);
        }

        /* Loading animation */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Status indicators */
        .badge-status {
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
            display: inline-block;
        }

        .badge-menunggu {
            background-color: #ffeeba;
            color: #856404;
        }

        .badge-proses {
            background-color: #b8daff;
            color: #004085;
        }

        .badge-selesai {
            background-color: #c3e6cb;
            color: #155724;
        }

        .badge-ditolak {
            background-color: #f5c6cb;
            color: #721c24;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .pengaduan-header h1 {
                font-size: 2.5rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .form-card,
            .informasi-item,
            .kategori-card,
            .keuntungan-item {
                padding: 25px;
            }
        }

        @media (max-width: 576px) {
            .pengaduan-header {
                padding: 80px 0;
            }

            .section-padding {
                padding: 60px 0;
            }

            .pengaduan-header h1 {
                font-size: 2rem;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .form-icon,
            .kategori-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
        }

        /* Accessibility improvements */
        .keyboard-navigation a:focus,
        .keyboard-navigation button:focus,
        .keyboard-navigation input:focus {
            outline: 3px solid var(--primary-color);
            outline-offset: 2px;
        }

        /* Scroll animations */
        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-up.show {
            opacity: 1;
            transform: translateY(0);
        }

        :root {
            --primary-color: #2980b9;
            /* Biru dari logo, sedikit lebih lembut */
            --secondary-color: #ffffff;
            /* Putih untuk background */
            --text-color: #333333;
            /* Tetap gelap untuk keterbacaan */
            --text-dark: #1a4377;
            /* Biru tua untuk judul */
            --accent-color: #f1c40f;
            /* Kuning/emas sebagai aksen, bukan warna utama */
            --accent-hover: #e67e22;
            /* Oranye untuk hover state */
            --border-color: #e9ecef;
            /* Tetap abu-abu muda untuk border */
            --background-light: #f8f9fa;
            /* Background section yang lebih netral */
            --gradient-primary: linear-gradient(135deg, #3498db, #2980b9);
            /* Gradient biru yang lebih lembut */
        }

        /* Header */
        .pengaduan-header {
            background: var(--gradient-primary);
            color: white;
        }

        .pengaduan-header h1 {
            color: white;
        }

        .pengaduan-header::before {
            /* Pertahankan pola grid dengan warna yang sesuai */
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        }

        /* Section Styling */
        .section-title {
            color: var(--text-dark);
        }

        .section-subtitle {
            color: #6c757d;
            /* Tetap abu-abu */
        }

        /* Form Section */
        .form-section {
            background: var(--secondary-color);
        }

        .form-card {
            border: 1px solid var(--border-color);
            /* Border lebih halus */
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            /* Bayangan lebih halus */
        }

        .form-card:hover {
            border-color: var(--primary-color);
            box-shadow: 0 8px 25px rgba(41, 128, 185, 0.1);
        }

        .form-icon {
            background: var(--primary-color);
            /* Warna solid, tanpa gradient */
        }

        /* Informasi Section */
        .informasi-section {
            background: var(--background-light);
        }

        .informasi-item {
            border-left: 3px solid var(--primary-color);
            /* Lebih tipis */
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.05);
        }

        .informasi-number {
            background: var(--primary-color);
        }

        .informasi-item:hover .informasi-number {
            background: var(--text-dark);
        }

        /* Kategori Section */
        .kategori-section {
            background: var(--secondary-color);
        }

        .kategori-card {
            border: 1px solid var(--border-color);
        }

        .kategori-card:hover {
            border-color: var(--primary-color);
            box-shadow: 0 10px 25px rgba(41, 128, 185, 0.08);
        }

        .kategori-icon {
            background: var(--primary-color);
        }

        .kategori-title {
            color: var(--text-dark);
        }

        /* Keuntungan Section */
        .keuntungan-section {
            background: var(--gradient-primary);
        }

        .keuntungan-item:hover .keuntungan-icon {
            color: var(--accent-color);
        }

        /* Status Section */
        .status-section {
            background: var(--background-light);
        }

        .status-header {
            background: var(--primary-color);
            /* Solid tanpa gradient */
        }

        /* Statistics Cards */
        .stats-card {
            border: 1px solid var(--border-color);
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.05);
        }

        .stats-card:hover {
            border-color: var(--primary-color);
        }

        .stats-number {
            color: var(--primary-color);
        }

        /* Button Styles */
        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background: var(--text-dark);
            border-color: var(--text-dark);
            box-shadow: 0 5px 15px rgba(26, 67, 119, 0.2);
        }

        .btn-cek-status {
            color: var(--primary-color);
        }

        .btn-cek-status:hover {
            color: var(--text-dark);
        }

        /* Form Controls */
        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(41, 128, 185, 0.15);
        }

        /* Status Badges - Modern & Subtle */
        .badge-status {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.75rem;
        }

        .badge-menunggu {
            background-color: #fff8e1;
            color: #f57c00;
        }

        .badge-proses {
            background-color: #e3f2fd;
            color: #1976d2;
        }

        .badge-selesai {
            background-color: #e8f5e9;
            color: #388e3c;
        }

        .badge-ditolak {
            background-color: #ffebee;
            color: #d32f2f;
        }
    </style>
@endpush

@section('main')
    <!-- Header -->
    <header class="pengaduan-header">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 data-aos="fade-up text-white">Pengaduan Ketertiban Masyarakat</h1>
                    <p data-aos="fade-up" data-aos-delay="100">Sampaikan laporan Anda terkait gangguan ketertiban di Kota
                        Ternate. Kami siap menindaklanjuti setiap pengaduan untuk Ternate yang lebih tertib.</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Form Pengaduan Section -->
    <section class="form-section section-padding">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title" data-aos="fade-up">Form Pengaduan</h2>
                    <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Silahkan isi formulir di bawah ini
                        dengan lengkap dan jelas agar pengaduan Anda dapat diproses dengan cepat</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 mx-auto" data-aos="fade-up" data-aos-delay="200">
                    <div class="form-card">
                        <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Data Pelapor -->
                            <div class="mb-4">
                                <h4 class="mb-3"><i class="bi bi-person-circle me-2"></i> Data Pelapor</h4>
                                <hr>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="nama_pelapor" class="form-label">Nama Lengkap <span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('nama_pelapor') is-invalid @enderror"
                                            id="nama_pelapor" name="nama_pelapor" value="{{ old('nama_pelapor') }}"
                                            required>
                                        @error('nama_pelapor')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="email_pelapor" class="form-label">Email</label>
                                        <input type="email"
                                            class="form-control @error('email_pelapor') is-invalid @enderror"
                                            id="email_pelapor" name="email_pelapor" value="{{ old('email_pelapor') }}">
                                        @error('email_pelapor')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="nomor_telepon" class="form-label">Nomor Telepon <span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('nomor_telepon') is-invalid @enderror"
                                            id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}"
                                            required>
                                        @error('nomor_telepon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="alamat_pelapor" class="form-label">Alamat <span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('alamat_pelapor') is-invalid @enderror"
                                            id="alamat_pelapor" name="alamat_pelapor" value="{{ old('alamat_pelapor') }}"
                                            required>
                                        @error('alamat_pelapor')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Lokasi Pengaduan -->
                            <div class="mb-4">
                                <h4 class="mb-3"><i class="bi bi-geo-alt-fill me-2"></i> Lokasi Pengaduan</h4>
                                <hr>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="kecamatan_id" class="form-label">Kecamatan <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select @error('kecamatan_id') is-invalid @enderror"
                                            id="kecamatan_id" name="kecamatan_id" required>
                                            <option value="">Pilih Kecamatan</option>
                                            @foreach ($kecamatans as $kecamatan)
                                                <option value="{{ $kecamatan->id }}"
                                                    {{ old('kecamatan_id') == $kecamatan->id ? 'selected' : '' }}>
                                                    {{ $kecamatan->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kecamatan_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="kelurahan_id" class="form-label">Kelurahan <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select @error('kelurahan_id') is-invalid @enderror"
                                            id="kelurahan_id" name="kelurahan_id" required>
                                            <option value="">Pilih Kelurahan</option>
                                        </select>
                                        @error('kelurahan_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="lokasi_kejadian" class="form-label">Detail Lokasi <span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('lokasi_kejadian') is-invalid @enderror"
                                            id="lokasi_kejadian" name="lokasi_kejadian"
                                            value="{{ old('lokasi_kejadian') }}"
                                            placeholder="Contoh: Jl. Sultan Babullah No.10, RT 02/RW 03" required>
                                        @error('lokasi_kejadian')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Detail Pengaduan -->
                            <div class="mb-4">
                                <h4 class="mb-3"><i class="bi bi-exclamation-triangle-fill me-2"></i> Detail Pengaduan
                                </h4>
                                <hr>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="kategori_ketertiban" class="form-label">Kategori Ketertiban <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select @error('kategori_ketertiban') is-invalid @enderror"
                                            id="kategori_ketertiban" name="kategori_ketertiban" required>
                                            <option value="">Pilih Kategori</option>
                                            <option value="keamanan"
                                                {{ old('kategori_ketertiban') == 'keamanan' ? 'selected' : '' }}>Keamanan
                                            </option>
                                            <option value="kebersihan"
                                                {{ old('kategori_ketertiban') == 'kebersihan' ? 'selected' : '' }}>
                                                Kebersihan</option>
                                            <option value="kebisingan"
                                                {{ old('kategori_ketertiban') == 'kebisingan' ? 'selected' : '' }}>
                                                Kebisingan</option>
                                            <option value="parkir_liar"
                                                {{ old('kategori_ketertiban') == 'parkir_liar' ? 'selected' : '' }}>Parkir
                                                Liar</option>
                                            <option value="pedagang_kaki_lima"
                                                {{ old('kategori_ketertiban') == 'pedagang_kaki_lima' ? 'selected' : '' }}>
                                                Pedagang Kaki Lima</option>
                                            <option value="vandalisme"
                                                {{ old('kategori_ketertiban') == 'vandalisme' ? 'selected' : '' }}>
                                                Vandalisme</option>
                                            <option value="lainnya"
                                                {{ old('kategori_ketertiban') == 'lainnya' ? 'selected' : '' }}>Lainnya
                                            </option>
                                        </select>
                                        @error('kategori_ketertiban')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="waktu_kejadian" class="form-label">Waktu Kejadian <span
                                                class="text-danger">*</span></label>
                                        <input type="datetime-local"
                                            class="form-control @error('waktu_kejadian') is-invalid @enderror"
                                            id="waktu_kejadian" name="waktu_kejadian"
                                            value="{{ old('waktu_kejadian') }}" required>
                                        @error('waktu_kejadian')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="judul" class="form-label">Judul Pengaduan <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                            id="judul" name="judul" value="{{ old('judul') }}" required>
                                        @error('judul')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="deskripsi" class="form-label">Deskripsi Pengaduan <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                            rows="5" required>{{ old('deskripsi') }}</textarea>
                                        <div class="form-text">Berikan detail kejadian, kapan terjadi, dan dampak yang
                                            ditimbulkan.</div>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="foto_bukti" class="form-label">Foto Bukti</label>
                                        <input class="form-control @error('foto_bukti') is-invalid @enderror"
                                            type="file" id="foto_bukti" name="foto_bukti" accept="image/*">
                                        <div class="form-text">Format: JPG, JPEG, PNG. Maksimal 2MB.</div>
                                        @error('foto_bukti')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input @error('setuju') is-invalid @enderror" type="checkbox"
                                        id="setuju" name="setuju" required>
                                    <label class="form-check-label" for="setuju">
                                        Saya menyatakan bahwa data yang disampaikan adalah benar dan dapat
                                        dipertanggungjawabkan
                                    </label>
                                    @error('setuju')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-lg px-5 py-3"
                                    style="border-radius: 25px; font-weight: 600;">
                                    <i class="bi bi-send-fill me-2"></i> Kirim Pengaduan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Statistics Pengaduan -->
            <div class="row g-4 mt-5 justify-content-center">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="stats-card">
                        <div class="stats-number">547</div>
                        <div class="stats-label">Total Pengaduan</div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="stats-card">
                        <div class="stats-number">432</div>
                        <div class="stats-label">Pengaduan Selesai</div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="stats-card">
                        <div class="stats-number">93%</div>
                        <div class="stats-label">Tingkat Penyelesaian</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Informasi Section -->
    <section class="informasi-section section-padding">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title" data-aos="fade-up">Tata Cara Pengaduan</h2>
                    <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Ikuti langkah-langkah berikut
                        untuk melaporkan gangguan ketertiban</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="informasi-item">
                        <div class="d-flex align-items-start">
                            <span class="informasi-number">1</span>
                            <div>
                                <h5>Isi Form Pengaduan</h5>
                                <p>Lengkapi form pengaduan online dengan identitas yang valid dan detail gangguan ketertiban
                                    yang terjadi secara lengkap dan jelas.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="informasi-item">
                        <div class="d-flex align-items-start">
                            <span class="informasi-number">2</span>
                            <div>
                                <h5>Terima Kode Pengaduan</h5>
                                <p>Setelah mengirim pengaduan, Anda akan menerima kode pengaduan yang dapat digunakan untuk
                                    melacak status pengaduan Anda.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="informasi-item">
                        <div class="d-flex align-items-start">
                            <span class="informasi-number">3</span>
                            <div>
                                <h5>Verifikasi Pengaduan</h5>
                                <p>Tim kami akan melakukan verifikasi dan validasi terhadap pengaduan yang masuk, termasuk
                                    mengecek kebenaran informasi yang diberikan.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="informasi-item">
                        <div class="d-flex align-items-start">
                            <span class="informasi-number">4</span>
                            <div>
                                <h5>Tindak Lanjut</h5>
                                <p>Pengaduan yang telah diverifikasi akan ditindaklanjuti oleh petugas SATPOL-PP atau
                                    instansi terkait sesuai dengan jenis pengaduan.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="informasi-item">
                        <div class="d-flex align-items-start">
                            <span class="informasi-number">5</span>
                            <div>
                                <h5>Pantau Status</h5>
                                <p>Pantau perkembangan pengaduan Anda melalui fitur "Cek Status Pengaduan" dengan memasukkan
                                    kode pengaduan yang telah diberikan.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="informasi-item">
                        <div class="d-flex align-items-start">
                            <span class="informasi-number">6</span>
                            <div>
                                <h5>Penyelesaian</h5>
                                <p>Setelah ditangani, tim akan memberikan laporan penyelesaian dan dokumentasi tindakan yang
                                    telah dilakukan sebagai bukti penanganan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jenis Pengaduan Section -->
    <section class="kategori-section section-padding">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title" data-aos="fade-up">Jenis Pengaduan Ketertiban</h2>
                    <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Kategori-kategori gangguan
                        ketertiban yang dapat dilaporkan melalui sistem pengaduan ini</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="kategori-card">
                        <div class="kategori-icon">
                            <i class="bi bi-shield-exclamation"></i>
                        </div>
                        <h4 class="kategori-title">Keamanan</h4>
                        <p>Gangguan keamanan seperti premanisme, pungutan liar, atau aktivitas mencurigakan yang mengganggu
                            ketertiban umum.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="kategori-card">
                        <div class="kategori-icon">
                            <i class="bi bi-trash"></i>
                        </div>
                        <h4 class="kategori-title">Kebersihan</h4>
                        <p>Masalah kebersihan seperti penumpukan sampah, pembuangan sampah sembarangan, atau pencemaran
                            lingkungan.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="kategori-card">
                        <div class="kategori-icon">
                            <i class="bi bi-volume-up"></i>
                        </div>
                        <h4 class="kategori-title">Kebisingan</h4>
                        <p>Gangguan suara atau kebisingan yang mengganggu kenyamanan seperti dari tempat hiburan, bengkel,
                            atau aktivitas warga.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="kategori-card">
                        <div class="kategori-icon">
                            <i class="bi bi-p-circle"></i>
                        </div>
                        <h4 class="kategori-title">Parkir Liar</h4>
                        <p>Kendaraan yang diparkir sembarangan, menghalangi jalan umum, trotoar, atau tempat yang tidak
                            diperuntukkan untuk parkir.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="kategori-card">
                        <div class="kategori-icon">
                            <i class="bi bi-shop"></i>
                        </div>
                        <h4 class="kategori-title">Pedagang Kaki Lima</h4>
                        <p>PKL yang berjualan di tempat yang tidak diizinkan, menghalangi akses publik, atau mengganggu
                            ketertiban umum.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="kategori-card">
                        <div class="kategori-icon">
                            <i class="bi bi-brush"></i>
                        </div>
                        <h4 class="kategori-title">Vandalisme</h4>
                        <p>Perusakan fasilitas umum, coretan di tempat umum, atau tindakan merusak properti publik lainnya.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Cek Status Section -->
    <section class="status-section section-padding">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title" data-aos="fade-up">Cek Status Pengaduan</h2>
                    <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Pantau perkembangan pengaduan
                        yang telah Anda laporkan dengan memasukkan kode pengaduan</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mx-auto" data-aos="fade-up" data-aos-delay="200">
                    <div class="status-card">
                        <div class="status-header">
                            <h4 class="m-0 text-white"><i class="bi bi-search me-2"></i> Lacak Pengaduan Anda</h4>
                        </div>
                        <div class="status-content">
                            <form action="{{ route('pengaduan.proses-status') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="kode_pengaduan" class="form-label">Kode Pengaduan</label>
                                    <input type="text"
                                        class="form-control @error('kode_pengaduan') is-invalid @enderror"
                                        id="kode_pengaduan" name="kode_pengaduan"
                                        placeholder="Masukkan kode pengaduan (contoh: CKT-151515-ABCD)" required>
                                    @error('kode_pengaduan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Kode pengaduan dikirimkan ke email atau ditampilkan setelah
                                        pengaduan berhasil dikirim.</div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary px-4 py-2">
                                        <i class="bi bi-search me-2"></i> Cek Status
                                    </button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>

            <!-- Contoh Status Pengaduan dari Database -->
            <div class="row g-4 mt-5">
                <div class="col-12 text-center mb-4">
                    <h3 data-aos="fade-up"> Pengaduan Terkini</h3>
                </div>

                @if ($pengaduanProses)
                    <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="status-card">
                            <div class="status-content">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="status-meta">
                                        <span><i class="bi bi-calendar me-1"></i>
                                            {{ $pengaduanProses->created_at->format('d F Y') }}</span>
                                    </div>
                                    <span class="badge-status badge-proses">Diproses</span>
                                </div>
                                <h4 class="status-title">{{ $pengaduanProses->judul }}</h4>
                                <p class="status-text">
                                    {{ \Illuminate\Support\Str::limit($pengaduanProses->deskripsi, 150) }}
                                    @if (strlen($pengaduanProses->deskripsi) > 150)
                                        ...
                                    @endif
                                </p>
                                <hr>
                                <div class="mt-3">
                                    <h6>Tanggapan:</h6>
                                    <p class="status-text mb-0">"{{ $pengaduanProses->tanggapan }}"</p>
                                    <small class="text-muted d-block mt-2">
                                        - Petugas SATPOL-PP
                                        ({{ $pengaduanProses->tanggal_tanggapan ? $pengaduanProses->tanggal_tanggapan->format('d F Y') : 'Tanggal tidak tersedia' }})
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="status-card">
                            <div class="status-content text-center p-4">
                                <div class="mb-3">
                                    <i class="bi bi-hourglass-split text-warning" style="font-size: 3rem;"></i>
                                </div>
                                <h4 class="text-muted">Belum Ada Pengaduan dalam Proses</h4>
                                <p>Pengaduan yang sedang diproses akan ditampilkan di sini.</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($pengaduanSelesai)
                    <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="status-card">
                            <div class="status-content">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="status-meta">
                                        <span><i class="bi bi-calendar me-1"></i>
                                            {{ $pengaduanSelesai->created_at->format('d F Y') }}</span>
                                    </div>
                                    <span class="badge-status badge-selesai">Selesai</span>
                                </div>
                                <h4 class="status-title">{{ $pengaduanSelesai->judul }}</h4>
                                <p class="status-text">
                                    {{ \Illuminate\Support\Str::limit($pengaduanSelesai->deskripsi, 150) }}
                                    @if (strlen($pengaduanSelesai->deskripsi) > 150)
                                        ...
                                    @endif
                                </p>
                                <hr>
                                <div class="mt-3">
                                    <h6>Tanggapan:</h6>
                                    <p class="status-text mb-0">"{{ $pengaduanSelesai->tanggapan }}"</p>
                                    <small class="text-muted d-block mt-2">
                                        - Petugas SATPOL-PP
                                        ({{ $pengaduanSelesai->tanggal_tanggapan ? $pengaduanSelesai->tanggal_tanggapan->format('d F Y') : 'Tanggal tidak tersedia' }})
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="status-card">
                            <div class="status-content text-center p-4">
                                <div class="mb-3">
                                    <i class="bi bi-check-circle text-success" style="font-size: 3rem;"></i>
                                </div>
                                <h4 class="text-muted">Belum Ada Pengaduan yang Selesai</h4>
                                <p>Pengaduan yang telah diselesaikan akan ditampilkan di sini.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>


        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });

        // Dependent dropdown untuk kecamatan dan kelurahan
        document.addEventListener('DOMContentLoaded', function() {
            const kecamatanSelect = document.getElementById('kecamatan_id');
            const kelurahanSelect = document.getElementById('kelurahan_id');

            if (kecamatanSelect && kelurahanSelect) {
                kecamatanSelect.addEventListener('change', function() {
                    const kecamatanId = this.value;

                    // Reset kelurahan dropdown
                    kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';

                    if (kecamatanId) {
                        // Fetch kelurahan berdasarkan kecamatan
                        fetch(`{{ route('pengaduan.get-kelurahan') }}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    kecamatan_id: kecamatanId
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                data.forEach(kelurahan => {
                                    const option = document.createElement('option');
                                    option.value = kelurahan.id;
                                    option.textContent = kelurahan.nama;
                                    kelurahanSelect.appendChild(option);
                                });

                                // Set kelurahan jika ada old value
                                @if (old('kelurahan_id'))
                                    kelurahanSelect.value = "{{ old('kelurahan_id') }}";
                                @endif
                            })
                            .catch(error => console.error('Error:', error));
                    }
                });

                // Trigger change event jika kecamatan sudah dipilih
                if (kecamatanSelect.value) {
                    kecamatanSelect.dispatchEvent(new Event('change'));
                }
            }
        });

        // Counter animation for statistics
        function animateCounters() {
            const counters = document.querySelectorAll('.stats-number');

            counters.forEach(counter => {
                const target = parseInt(counter.textContent.replace('%', ''));
                const increment = target / 100;
                let current = 0;

                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        counter.textContent = target + (counter.textContent.includes('%') ? '%' : '');
                        clearInterval(timer);
                    } else {
                        counter.textContent = Math.floor(current) + (counter.textContent.includes('%') ?
                            '%' : '');
                    }
                }, 20);
            });
        }

        // Trigger counter animation when section is visible
        const statsSection = document.querySelector('.stats-card');
        if (statsSection) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounters();
                        observer.unobserve(entry.target);
                    }
                });
            });

            observer.observe(statsSection);
        }

        // File upload preview
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('foto_bukti');

            if (fileInput) {
                fileInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        const fileSize = this.files[0].size / 1024 / 1024; // convert to MB

                        if (fileSize > 2) {
                            alert('Ukuran file terlalu besar. Maksimal 2MB.');
                            this.value = '';
                        }
                    }
                });
            }
        });

        // Form validation
        (() => {
            'use strict'

            // Fetch all forms that we want to apply validation styles to
            const forms = document.querySelectorAll('.needs-validation');

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }

                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
@endpush
