@extends('layouts.main')

@push('styles')
    <style>
        :root {
            --primary-color: #2980b9;
            --primary-dark: #1a4377;
            --secondary-color: #ffffff;
            --text-color: #333333;
            --text-dark: #1a4377;
            --accent-color: #f1c40f;
            --accent-hover: #e67e22;
            --border-color: #e9ecef;
            --background-light: #f8f9fa;
            --gradient-primary: linear-gradient(135deg, #3498db, #2980b9);
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --info-color: #3498db;
        }

        /* === HEADER STYLES === */
        .pengaduan-header {
            background: var(--gradient-primary);
            color: white;
            padding: 120px 0 80px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
            margin-top: -2px;
            /* Menghindari gap dengan header */
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
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .pengaduan-header p {
            font-size: 1.3rem;
            opacity: 0.95;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* === SECTION STYLING === */
        .section-padding {
            padding: 100px 0;
        }

        .section-title {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--text-dark);
            text-align: center;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: #6c757d;
            margin-bottom: 4rem;
            text-align: center;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        /* === USER INFO & LOGIN CARDS === */
        .user-info-card,
        .login-required-card {
            background: linear-gradient(135deg, #e8f5e8 0%, #f0f9ff 100%);
            border: 2px solid var(--success-color);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(39, 174, 96, 0.1);
        }

        .login-required-card {
            background: linear-gradient(135deg, #fff3cd 0%, #f8d7da 100%);
            border-color: var(--warning-color);
            text-align: center;
            box-shadow: 0 5px 20px rgba(243, 156, 18, 0.1);
        }

        .login-required-card i {
            font-size: 3rem;
            color: var(--warning-color);
            margin-bottom: 20px;
        }

        .login-required-card h5 {
            color: var(--text-dark);
            margin-bottom: 15px;
            font-size: 1.3rem;
        }

        /* === FORM STYLES === */
        .form-section {
            background: var(--background-light);
        }

        .form-card {
            background: var(--secondary-color);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 50px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .form-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
        }

        /* Form Section Headers */
        .form-section-header {
            background: var(--gradient-primary);
            color: white;
            padding: 20px 30px;
            border-radius: 15px;
            margin: 40px 0 30px 0;
            box-shadow: 0 5px 15px rgba(41, 128, 185, 0.3);
        }

        .form-section-header:first-child {
            margin-top: 0;
        }

        .form-section-header h4 {
            margin: 0;
            font-size: 1.4rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .form-section-header i {
            font-size: 1.6rem;
            opacity: 0.9;
        }

        /* Form Controls */
        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 10px;
            font-size: 1rem;
        }

        .form-label .text-danger {
            margin-left: 5px;
        }

        .form-control,
        .form-select {
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 15px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #fafafa;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(41, 128, 185, 0.15);
            background-color: white;
            transform: translateY(-1px);
        }

        .form-control:hover:not(:focus),
        .form-select:hover:not(:focus) {
            border-color: #bdc3c7;
            background-color: white;
        }

        .form-text {
            color: #6c757d;
            font-size: 0.9rem;
            margin-top: 8px;
            font-style: italic;
        }

        /* Textarea specific */
        textarea.form-control {
            resize: vertical;
            min-height: 120px;
            line-height: 1.6;
        }

        /* File input */
        .form-control[type="file"] {
            padding: 12px 15px;
            cursor: pointer;
        }

        .form-control[type="file"]::-webkit-file-upload-button {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            margin-right: 15px;
            cursor: pointer;
            font-weight: 500;
            transition: background 0.3s ease;
        }

        .form-control[type="file"]::-webkit-file-upload-button:hover {
            background: var(--primary-dark);
        }

        /* Checkbox styling */
        .form-check {
            padding: 20px;
            background: #f8f9ff;
            border: 2px solid #e3e6ff;
            border-radius: 12px;
            margin-bottom: 30px;
        }

        .form-check-input {
            width: 1.5em;
            height: 1.5em;
            margin-right: 15px;
        }

        .form-check-label {
            font-size: 1rem;
            line-height: 1.5;
            cursor: pointer;
        }

        /* Submit button */
        .btn-submit-pengaduan {
            background: var(--gradient-primary);
            border: none;
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            padding: 18px 40px;
            border-radius: 50px;
            box-shadow: 0 8px 25px rgba(41, 128, 185, 0.3);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-submit-pengaduan:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(41, 128, 185, 0.4);
            color: white;
        }

        .btn-submit-pengaduan:active {
            transform: translateY(-1px);
        }

        /* === ALERT STYLES === */
        .alert {
            border: none;
            border-radius: 12px;
            padding: 20px 25px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            border-left: 5px solid var(--success-color);
        }

        .alert-info {
            background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
            color: #0c5460;
            border-left: 5px solid var(--info-color);
        }

        /* === VALIDATION STYLES === */
        .is-invalid {
            border-color: var(--danger-color) !important;
            box-shadow: 0 0 0 0.25rem rgba(231, 76, 60, 0.15) !important;
        }

        .invalid-feedback {
            display: block;
            font-size: 0.9rem;
            color: var(--danger-color);
            margin-top: 8px;
            font-weight: 500;
        }

        /* === INFORMASI SECTION === */
        .informasi-section {
            background: var(--secondary-color);
        }

        .informasi-item {
            background: var(--secondary-color);
            border-radius: 20px;
            padding: 35px;
            margin-bottom: 25px;
            border-left: 5px solid var(--primary-color);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .informasi-item:hover {
            transform: translateX(15px);
            box-shadow: 0 15px 40px rgba(41, 128, 185, 0.15);
            border-left-width: 8px;
        }

        .informasi-number {
            width: 80px;
            height: 80px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.5rem;
            margin-right: 25px;
            flex-shrink: 0;
            box-shadow: 0 5px 15px rgba(41, 128, 185, 0.3);
            transition: all 0.3s ease;
        }

        .informasi-item:hover .informasi-number {
            background: var(--primary-dark);
            transform: scale(1.1) rotate(-5deg);
        }

        .informasi-item h5 {
            color: var(--text-dark);
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .informasi-item p {
            color: #6c757d;
            line-height: 1.7;
            margin: 0;
            font-size: 1rem;
        }

        /* === KATEGORI SECTION === */
        .kategori-section {
            background: var(--background-light);
        }

        .kategori-card {
            background: var(--secondary-color);
            border: 2px solid var(--border-color);
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .kategori-card:hover {
            border-color: var(--primary-color);
            transform: translateY(-15px);
            box-shadow: 0 25px 50px rgba(41, 128, 185, 0.12);
        }

        .kategori-icon {
            width: 120px;
            height: 120px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: white;
            font-size: 3rem;
            box-shadow: 0 10px 30px rgba(41, 128, 185, 0.3);
            transition: all 0.3s ease;
        }

        .kategori-card:hover .kategori-icon {
            transform: scale(1.1) rotateY(15deg);
            box-shadow: 0 15px 40px rgba(41, 128, 185, 0.4);
        }

        .kategori-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 15px;
        }

        .kategori-card p {
            color: #6c757d;
            line-height: 1.6;
            font-size: 1rem;
        }

        /* === STATUS SECTION === */
        .status-section {
            background: var(--secondary-color);
        }

        .status-card {
            background: var(--secondary-color);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
            border: 2px solid var(--border-color);
        }

        .status-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12);
            border-color: var(--primary-color);
        }

        .status-header {
            background: var(--gradient-primary);
            padding: 30px;
            text-align: center;
        }

        .status-header h4 {
            color: white;
            margin: 0;
            font-size: 1.3rem;
            font-weight: 600;
        }

        .status-content {
            padding: 40px 30px;
        }

        /* === BADGES === */
        .badge-status {
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-menunggu {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            color: #b8860b;
            box-shadow: 0 3px 10px rgba(184, 134, 11, 0.2);
        }

        .badge-proses {
            background: linear-gradient(135deg, #cce5ff, #b3d9ff);
            color: #0066cc;
            box-shadow: 0 3px 10px rgba(0, 102, 204, 0.2);
        }

        .badge-selesai {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
            box-shadow: 0 3px 10px rgba(21, 87, 36, 0.2);
        }

        .badge-ditolak {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
            box-shadow: 0 3px 10px rgba(114, 28, 36, 0.2);
        }

        /* === RESPONSIVE DESIGN === */
        @media (max-width: 1200px) {
            .form-card {
                padding: 40px;
            }

            .section-padding {
                padding: 80px 0;
            }
        }

        @media (max-width: 768px) {
            .pengaduan-header {
                padding: 100px 0 60px 0;
            }

            .pengaduan-header h1 {
                font-size: 2.5rem;
            }

            .section-title {
                font-size: 2.2rem;
            }

            .form-card {
                padding: 30px 20px;
            }

            .form-section-header {
                padding: 15px 20px;
            }

            .informasi-item,
            .kategori-card {
                padding: 25px 20px;
            }

            .kategori-icon {
                width: 100px;
                height: 100px;
                font-size: 2.5rem;
            }
        }

        @media (max-width: 576px) {
            .pengaduan-header {
                padding: 80px 0 50px 0;
            }

            .pengaduan-header h1 {
                font-size: 2rem;
            }

            .section-padding {
                padding: 60px 0;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .btn-submit-pengaduan {
                padding: 15px 30px;
                font-size: 1rem;
            }

            .informasi-number {
                width: 60px;
                height: 60px;
                font-size: 1.2rem;
                margin-right: 15px;
            }
        }

        /* === ANIMATIONS === */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        /* Loading state */
        .btn-submit-pengaduan.loading {
            pointer-events: none;
            position: relative;
        }

        .btn-submit-pengaduan.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            margin: auto;
            border: 2px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: button-loading-spinner 1s ease infinite;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }

        @keyframes button-loading-spinner {
            from {
                transform: rotate(0turn);
            }

            to {
                transform: rotate(1turn);
            }
        }
    </style>
@endpush

@section('main')
    <!-- Header -->
    <header class="pengaduan-header">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 data-aos="fade-up" class="text-white">Pengaduan Ketertiban Masyarakat</h1>
                    <p data-aos="fade-up" data-aos-delay="100">
                        Sampaikan laporan Anda terkait gangguan ketertiban di Kota Ternate.
                        Kami siap menindaklanjuti setiap pengaduan untuk Ternate yang lebih tertib dan sejahtera.
                    </p>
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
                    <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                        Silahkan isi formulir di bawah ini dengan lengkap dan jelas agar pengaduan Anda dapat diproses
                        dengan cepat dan tepat
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 mx-auto" data-aos="fade-up" data-aos-delay="200">

                    {{-- User Authentication Status --}}
                    @auth
                        <div class="user-info-card">
                            <h5><i class="bi bi-person-check-fill me-2"></i> Informasi Pelapor</h5>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Nama:</strong> {{ Auth::user()->name }}</p>
                                    <p class="mb-2"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                                </div>
                                <div class="col-md-6">
                                    @if (Auth::user()->nomor_telepon)
                                        <p class="mb-2"><strong>Nomor Telepon:</strong> {{ Auth::user()->nomor_telepon }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="alert alert-info mt-3 mb-0">
                                <small><i class="bi bi-info-circle me-1"></i> Pengaduan akan menggunakan data profil Anda yang
                                    sudah terdaftar.</small>
                            </div>
                        </div>
                    @else
                        <div class="login-required-card">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <h5>Login Diperlukan untuk Mengirim Pengaduan</h5>
                            <p class="mb-4">Anda dapat melihat formulir pengaduan, namun untuk mengirimkan pengaduan Anda
                                perlu login terlebih dahulu untuk keamanan dan pelacakan status.</p>
                            <div>
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-3">
                                    <i class="bi bi-box-arrow-in-right me-2"></i> Login
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">
                                    <i class="bi bi-person-plus me-2"></i> Daftar
                                </a>
                            </div>
                        </div>
                    @endauth

                    {{-- Main Form --}}
                    <div class="form-card">
                        {{-- Success Message --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                <strong>Berhasil!</strong> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data"
                            id="pengaduanForm" class="needs-validation" novalidate>
                            @csrf

                            {{-- Lokasi Pengaduan Section --}}
                            <div class="form-section-header">
                                <h4><i class="bi bi-geo-alt-fill"></i> Lokasi Pengaduan</h4>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="kecamatan_id" class="form-label">
                                        Kecamatan <span class="text-danger">*</span>
                                    </label>
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
                                    <label for="kelurahan_id" class="form-label">
                                        Kelurahan <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select @error('kelurahan_id') is-invalid @enderror"
                                        id="kelurahan_id" name="kelurahan_id" required>
                                        <option value="">Pilih Kelurahan</option>
                                    </select>
                                    @error('kelurahan_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="lokasi_kejadian" class="form-label">
                                        Detail Lokasi <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control @error('lokasi_kejadian') is-invalid @enderror"
                                        id="lokasi_kejadian" name="lokasi_kejadian" value="{{ old('lokasi_kejadian') }}"
                                        placeholder="Contoh: Jl. Sultan Babullah No.10, RT 02/RW 03" required>
                                    @error('lokasi_kejadian')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="alamat_kejadian" class="form-label">
                                        Alamat Lengkap Kejadian <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control @error('alamat_kejadian') is-invalid @enderror" id="alamat_kejadian"
                                        name="alamat_kejadian" rows="3" placeholder="Deskripsikan alamat lengkap dan patokan lokasi kejadian..."
                                        required>{{ old('alamat_kejadian') }}</textarea>
                                    <div class="form-text">Berikan alamat selengkap mungkin dengan patokan yang jelas</div>
                                    @error('alamat_kejadian')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Detail Pengaduan Section --}}
                            <div class="form-section-header">
                                <h4><i class="bi bi-exclamation-triangle-fill"></i> Detail Pengaduan</h4>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="kategori_ketertiban" class="form-label">
                                        Kategori Ketertiban <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select @error('kategori_ketertiban') is-invalid @enderror"
                                        id="kategori_ketertiban" name="kategori_ketertiban" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="keamanan"
                                            {{ old('kategori_ketertiban') == 'keamanan' ? 'selected' : '' }}>
                                            Keamanan
                                        </option>
                                        <option value="kebersihan"
                                            {{ old('kategori_ketertiban') == 'kebersihan' ? 'selected' : '' }}>
                                            Kebersihan
                                        </option>
                                        <option value="kebisingan"
                                            {{ old('kategori_ketertiban') == 'kebisingan' ? 'selected' : '' }}>
                                            Kebisingan
                                        </option>
                                        <option value="parkir_liar"
                                            {{ old('kategori_ketertiban') == 'parkir_liar' ? 'selected' : '' }}>
                                            Parkir Liar
                                        </option>
                                        <option value="pedagang_kaki_lima"
                                            {{ old('kategori_ketertiban') == 'pedagang_kaki_lima' ? 'selected' : '' }}>
                                            Pedagang Kaki Lima
                                        </option>
                                        <option value="vandalisme"
                                            {{ old('kategori_ketertiban') == 'vandalisme' ? 'selected' : '' }}>
                                            Vandalisme
                                        </option>
                                        <option value="lainnya"
                                            {{ old('kategori_ketertiban') == 'lainnya' ? 'selected' : '' }}>
                                            Lainnya
                                        </option>
                                    </select>
                                    @error('kategori_ketertiban')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="waktu_kejadian" class="form-label">
                                        Waktu Kejadian <span class="text-danger">*</span>
                                    </label>
                                    <input type="datetime-local"
                                        class="form-control @error('waktu_kejadian') is-invalid @enderror"
                                        id="waktu_kejadian" name="waktu_kejadian" value="{{ old('waktu_kejadian') }}"
                                        required>
                                    @error('waktu_kejadian')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="nomor_telepon" class="form-label">
                                        Nomor Telepon yang Bisa Dihubungi
                                    </label>
                                    <input type="text"
                                        class="form-control @error('nomor_telepon') is-invalid @enderror"
                                        id="nomor_telepon" name="nomor_telepon"
                                        value="{{ old('nomor_telepon', Auth::check() ? Auth::user()->nomor_telepon : '') }}"
                                        placeholder="Contoh: 0821-xxxx-xxxx">
                                    <div class="form-text">Nomor yang dapat dihubungi jika diperlukan informasi tambahan
                                    </div>
                                    @error('nomor_telepon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="judul" class="form-label">
                                        Judul Pengaduan <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                        id="judul" name="judul" value="{{ old('judul') }}"
                                        placeholder="Ringkasan singkat tentang pengaduan Anda..." maxlength="200"
                                        required>
                                    <div class="form-text">Maksimal 200 karakter</div>
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="deskripsi" class="form-label">
                                        Deskripsi Pengaduan <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                        rows="6"
                                        placeholder="Jelaskan detail kejadian: apa yang terjadi, kapan kejadian berlangsung, siapa yang terlibat, dan dampak yang ditimbulkan..."
                                        required>{{ old('deskripsi') }}</textarea>
                                    <div class="form-text">
                                        Berikan detail kejadian dengan jelas: waktu, tempat, kronologi, dan dampaknya
                                    </div>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="foto_bukti" class="form-label">
                                        Foto Bukti (Opsional)
                                    </label>
                                    <input class="form-control @error('foto_bukti') is-invalid @enderror" type="file"
                                        id="foto_bukti" name="foto_bukti" accept="image/jpeg,image/jpg,image/png">
                                    <div class="form-text">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Format yang didukung: JPG, JPEG, PNG. Maksimal ukuran file: 2MB
                                    </div>
                                    @error('foto_bukti')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Agreement Section --}}
                            <div class="form-check">
                                <input class="form-check-input @error('setuju') is-invalid @enderror" type="checkbox"
                                    id="setuju" name="setuju" required>
                                <label class="form-check-label" for="setuju">
                                    <strong>Pernyataan Kebenaran Data</strong><br>
                                    Saya menyatakan bahwa semua informasi yang saya sampaikan dalam pengaduan ini adalah
                                    benar, akurat, dan dapat dipertanggungjawabkan secara hukum. Saya bersedia memberikan
                                    keterangan tambahan jika diperlukan dalam proses penindaklanjutan pengaduan ini.
                                </label>
                                @error('setuju')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Submit Button --}}
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-submit-pengaduan" id="submitButton">
                                    <i class="bi bi-send-fill me-2"></i>
                                    <span class="btn-text">Kirim Pengaduan</span>
                                </button>
                            </div>
                        </form>
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
                    <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                        Ikuti langkah-langkah berikut untuk melaporkan gangguan ketertiban dengan efektif
                    </p>
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
                                    yang terjadi secara lengkap dan jelas. Pastikan informasi lokasi dan waktu kejadian
                                    akurat.</p>
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
                                <p>Setelah mengirim pengaduan, Anda akan menerima kode pengaduan unik yang dapat digunakan
                                    untuk melacak status dan perkembangan pengaduan Anda secara real-time.</p>
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
                                    mengecek kebenaran informasi, kelengkapan data, dan tingkat urgensi penanganan.</p>
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
                                    instansi terkait sesuai dengan jenis pengaduan dan tingkat prioritasnya.</p>
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
                                    kode pengaduan. Anda akan mendapat notifikasi setiap ada update status.</p>
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
                                <p>Setelah ditangani, tim akan memberikan laporan penyelesaian lengkap dengan dokumentasi
                                    tindakan yang telah dilakukan sebagai bukti penanganan dan transparansi.</p>
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
                    <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                        Kategori-kategori gangguan ketertiban yang dapat dilaporkan melalui sistem pengaduan ini
                    </p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="kategori-card">
                        <div class="kategori-icon">
                            <i class="bi bi-shield-exclamation"></i>
                        </div>
                        <h4 class="kategori-title">Keamanan</h4>
                        <p>Gangguan keamanan seperti premanisme, pungutan liar, tindak kriminal, atau aktivitas mencurigakan
                            yang mengganggu ketertiban dan keamanan umum.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="kategori-card">
                        <div class="kategori-icon">
                            <i class="bi bi-trash"></i>
                        </div>
                        <h4 class="kategori-title">Kebersihan</h4>
                        <p>Masalah kebersihan seperti penumpukan sampah, pembuangan sampah sembarangan, pencemaran
                            lingkungan, atau kondisi tidak higienis di area publik.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="kategori-card">
                        <div class="kategori-icon">
                            <i class="bi bi-volume-up"></i>
                        </div>
                        <h4 class="kategori-title">Kebisingan</h4>
                        <p>Gangguan suara atau kebisingan berlebihan yang mengganggu kenyamanan dari tempat hiburan,
                            bengkel, konstruksi, atau aktivitas lainnya.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="kategori-card">
                        <div class="kategori-icon">
                            <i class="bi bi-p-circle"></i>
                        </div>
                        <h4 class="kategori-title">Parkir Liar</h4>
                        <p>Kendaraan yang diparkir sembarangan, menghalangi jalan umum, trotoar, akses pejalan kaki, atau
                            tempat yang tidak diperuntukkan untuk parkir.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="kategori-card">
                        <div class="kategori-icon">
                            <i class="bi bi-shop"></i>
                        </div>
                        <h4 class="kategori-title">Pedagang Kaki Lima</h4>
                        <p>PKL yang berjualan di tempat tidak diizinkan, menghalangi akses publik, mengganggu lalu lintas,
                            atau tidak memiliki izin yang sah.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="kategori-card">
                        <div class="kategori-icon">
                            <i class="bi bi-brush"></i>
                        </div>
                        <h4 class="kategori-title">Vandalisme</h4>
                        <p>Perusakan fasilitas umum, coretan di tempat umum, perusakan properti publik, atau tindakan
                            merusak yang merugikan kepentingan umum.</p>
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
                    <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                        Pantau perkembangan pengaduan yang telah Anda laporkan dengan memasukkan kode pengaduan
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mx-auto" data-aos="fade-up" data-aos-delay="200">
                    <div class="status-card">
                        <div class="status-header">
                            <h4><i class="bi bi-search me-2"></i> Lacak Pengaduan Anda</h4>
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
                                    <div class="form-text">
                                        Kode pengaduan dikirimkan ke email atau ditampilkan setelah pengaduan berhasil
                                        dikirim
                                    </div>
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

            <!-- Contoh Status Pengaduan -->
            <div class="row g-4 mt-5">
                <div class="col-12 text-center mb-4">
                    <h3 data-aos="fade-up">Pengaduan Terkini</h3>
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
                        // Show loading state
                        kelurahanSelect.innerHTML = '<option value="">Loading...</option>';

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
                                kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
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
                            .catch(error => {
                                console.error('Error:', error);
                                kelurahanSelect.innerHTML =
                                    '<option value="">Error loading data</option>';
                            });
                    }
                });

                // Trigger change event jika kecamatan sudah dipilih
                if (kecamatanSelect.value) {
                    kecamatanSelect.dispatchEvent(new Event('change'));
                }
            }
        });

        // File upload validation and preview
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('foto_bukti');

            if (fileInput) {
                fileInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        const file = this.files[0];
                        const fileSize = file.size / 1024 / 1024; // convert to MB
                        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];

                        // Validate file size
                        if (fileSize > 2) {
                            alert('Ukuran file terlalu besar. Maksimal 2MB.');
                            this.value = '';
                            return;
                        }

                        // Validate file type
                        if (!allowedTypes.includes(file.type)) {
                            alert('Format file tidak didukung. Gunakan JPG, JPEG, atau PNG.');
                            this.value = '';
                            return;
                        }
                    }
                });
            }
        });

        // Form validation and submission
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('pengaduanForm');
            const submitButton = document.getElementById('submitButton');

            if (form && submitButton) {
                form.addEventListener('submit', function(event) {
                    // Add loading state
                    submitButton.classList.add('loading');
                    submitButton.disabled = true;

                    // Change button text
                    const btnText = submitButton.querySelector('.btn-text');
                    if (btnText) {
                        btnText.textContent = 'Mengirim...';
                    }

                    // If validation fails, remove loading state
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();

                        // Remove loading state
                        submitButton.classList.remove('loading');
                        submitButton.disabled = false;
                        btnText.textContent = 'Kirim Pengaduan';
                    }

                    form.classList.add('was-validated');
                });
            }
        });

        // Character counter for judul
        document.addEventListener('DOMContentLoaded', function() {
            const judulInput = document.getElementById('judul');

            if (judulInput) {
                const maxLength = judulInput.getAttribute('maxlength');
                const counter = document.createElement('div');
                counter.className = 'form-text text-end mt-1';
                counter.innerHTML = `<span id="judulCounter">0</span>/${maxLength} karakter`;
                judulInput.parentNode.appendChild(counter);

                const counterSpan = document.getElementById('judulCounter');

                judulInput.addEventListener('input', function() {
                    const currentLength = this.value.length;
                    counterSpan.textContent = currentLength;

                    if (currentLength >= maxLength * 0.9) {
                        counter.classList.add('text-warning');
                    } else {
                        counter.classList.remove('text-warning');
                    }
                });
            }
        });

        // Smooth scrolling for anchors
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
@endpush
