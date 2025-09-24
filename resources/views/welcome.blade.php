@extends('layouts.main')
@push('styles')
    <style>
        :root {
            --primary-color: #2980b9;
            /* Biru dari logo CEKATAN */
            --secondary-color: #ffffff;
            /* Putih untuk background */
            --text-color: #333333;
            /* Warna teks umum */
            --text-dark: #1a4377;
            /* Biru tua/navy dari teks "CEKATAN" */
            --accent-color: #f1c40f;
            /* Kuning/emas dari logo */
            --accent-red: #d63031;
            /* Merah dari tagline */
            --border-color: #e9ecef;
            --gradient-primary: linear-gradient(135deg, #3498db, #1a4377);
            /* Gradient biru */
            --light-bg: #f6f9ff;
            /* Background section alternatif */
        }


        /* Header */
        .pim-header {
            background: var(--gradient-primary);
            color: white;
            padding: 100px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .pim-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }

        .pim-header .container {
            position: relative;
            z-index: 2;
        }

        .pim-header h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .pim-header p {
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
            color: var(--text-dark);
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: #6c757d;
            margin-bottom: 3rem;
        }

        /* Tentang Section */
        .about-section {
            background: var(--secondary-color);
        }

        .about-card {
            background: var(--secondary-color);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 35px;
            box-shadow: 0 5px 20px rgba(41, 128, 185, 0.1);
            height: 100%;
            transition: all 0.3s ease;
        }

        .about-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(41, 128, 185, 0.15);
            border-color: var(--primary-color);
        }

        .about-icon {
            width: 80px;
            height: 80px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            color: white;
            font-size: 2rem;
        }

        /* Tujuan Section */
        .tujuan-section {
            background: var(--light-bg);
        }

        .tujuan-item {
            background: var(--secondary-color);
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 20px;
            border-left: 4px solid var(--primary-color);
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(41, 128, 185, 0.08);
        }

        .tujuan-item:hover {
            transform: translateX(10px);
            box-shadow: 0 8px 25px rgba(41, 128, 185, 0.12);
        }

        .tujuan-number {
            display: inline-flex;
            width: 60px;
            height: 36px;
            background: var(--primary-color);
            color: white;
            border-radius: 20px;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            line-height: 1;
            font-size: 16px;
            margin-right: 15px;
        }

        .tujuan-item:hover .tujuan-number {
            background: var(--text-dark);
            transform: scale(1.1);
        }

        /* Arah Perubahan Section */
        .perubahan-section {
            background: var(--secondary-color);
        }

        .perubahan-card {
            background: var(--secondary-color);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
        }

        .perubahan-card:hover {
            border-color: var(--primary-color);
            transform: translateY(-10px);
            box-shadow: 0 12px 30px rgba(41, 128, 185, 0.1);
        }

        .perubahan-icon {
            width: 90px;
            height: 90px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 2.5rem;
        }

        .perubahan-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 15px;
        }

        /* Manfaat Section */
        .manfaat-section {
            background: var(--gradient-primary);
            color: white;
        }

        .manfaat-item {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .manfaat-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-5px);
        }

        .manfaat-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: white;
            transition: transform 0.25s ease, color 0.25s ease;
        }

        .manfaat-item:hover .manfaat-icon {
            transform: scale(1.05) rotate(-3deg);
            color: var(--accent-color);
        }


        .manfaat-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: #ffffff;
        }

        /* Berita Section */
        .berita-section {
            background: var(--light-bg);
        }

        .berita-card {
            background: var(--secondary-color);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(41, 128, 185, 0.08);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid var(--border-color);
        }

        .berita-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(41, 128, 185, 0.12);
            border-color: var(--primary-color);
        }

        .berita-image {
            height: 200px;
            background: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            font-weight: 500;
            position: relative;
        }

        .berita-content {
            padding: 25px;
        }

        .berita-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .berita-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--text-dark);
        }

        .berita-excerpt {
            color: #6c757d;
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .btn-read-more {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
        }

        .btn-read-more:hover {
            color: var(--text-dark);
            gap: 10px;
        }

        /* Statistics Cards */
        .stats-card {
            background: var(--secondary-color);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(41, 128, 185, 0.08);
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(41, 128, 185, 0.15);
            border-color: var(--primary-color);
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
            border-radius: 5px;
        }

        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--text-dark);
            border-color: var(--text-dark);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(26, 67, 119, 0.2);
        }

        .btn-secondary {
            background: var(--accent-color);
            border-color: var(--accent-color);
            color: var(--text-dark);
        }

        .btn-secondary:hover {
            background: #e67e22;
            border-color: #e67e22;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(230, 126, 34, 0.3);
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

        /* Responsive */
        @media (max-width: 768px) {
            .pim-header h1 {
                font-size: 2.5rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .about-card,
            .tujuan-item,
            .perubahan-card,
            .manfaat-item {
                padding: 25px;
            }
        }

        @media (max-width: 576px) {
            .pim-header {
                padding: 80px 0;
            }

            .section-padding {
                padding: 60px 0;
            }

            .pim-header h1 {
                font-size: 2rem;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .about-icon,
            .perubahan-icon {
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
    </style>
@endpush

@section('main')
    <!-- Tentang Section -->
    <section class="about-section section-padding">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title" data-aos="fade-up">Tentang WEBSITE</h2>
                    <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Penilaian Indeks Maturitas adalah
                        sistem evaluasi komprehensif untuk mengukur tingkat kematangan organisasi dalam berbagai aspek
                        pelayanan dan tata kelola</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="about-card">
                        <div class="about-icon">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <h4>Evaluasi Kinerja</h4>
                        <p>Mengukur dan mengevaluasi kinerja organisasi secara berkelanjutan untuk memastikan pencapaian
                            target yang telah ditetapkan dengan standar kualitas yang tinggi.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="about-card">
                        <div class="about-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h4>Tata Kelola</h4>
                        <p>Membangun sistem tata kelola yang transparan, akuntabel, dan responsif dalam memberikan pelayanan
                            kepada masyarakat Kota Ternate.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="about-card">
                        <div class="about-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h4>Pelayanan Prima</h4>
                        <p>Meningkatkan kualitas pelayanan kepada masyarakat melalui inovasi, digitalisasi, dan peningkatan
                            kapasitas sumber daya manusia.</p>
                    </div>
                </div>
            </div>

            <!-- Statistics Pengunjung -->
            <div class="row g-4 mt-5 justify-content-center">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="stats-card">
                        <div class="stats-number">2.547</div>
                        <div class="stats-label">Pengunjung Hari Ini</div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="stats-card">
                        <div class="stats-number">18.432</div>
                        <div class="stats-label">Pengunjung Bulan Ini</div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="stats-card">
                        <div class="stats-number">1.285</div>
                        <div class="stats-label">Total Pengunjung</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tujuan Section -->
    <section class="tujuan-section section-padding">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title" data-aos="fade-up">Tujuan PIM</h2>
                    <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Tujuan strategis implementasi
                        Penilaian Indeks Maturitas di SATPOL-PP Kota Ternate</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="tujuan-item">
                        <div class="d-flex align-items-start">
                            <span class="tujuan-number">1</span>
                            <div>
                                <h5>Meningkatkan Akuntabilitas</h5>
                                <p>Membangun sistem akuntabilitas yang kuat dalam setiap aspek pelayanan dan pengelolaan
                                    organisasi untuk menciptakan transparansi yang optimal.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="tujuan-item">
                        <div class="d-flex align-items-start">
                            <span class="tujuan-number">2</span>
                            <div>
                                <h5>Optimalisasi Kinerja</h5>
                                <p>Mengoptimalkan kinerja organisasi melalui pengukuran yang terstandar dan berkelanjutan
                                    untuk mencapai target yang telah ditetapkan.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="tujuan-item">
                        <div class="d-flex align-items-start">
                            <span class="tujuan-number">3</span>
                            <div>
                                <h5>Inovasi Berkelanjutan</h5>
                                <p>Mendorong inovasi dalam pelayanan publik dan pengelolaan organisasi untuk meningkatkan
                                    efektivitas dan efisiensi kerja.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="tujuan-item">
                        <div class="d-flex align-items-start">
                            <span class="tujuan-number">4</span>
                            <div>
                                <h5>Kepuasan Stakeholder</h5>
                                <p>Meningkatkan kepuasan masyarakat dan stakeholder melalui pelayanan yang berkualitas dan
                                    responsif terhadap kebutuhan.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="tujuan-item">
                        <div class="d-flex align-items-start">
                            <span class="tujuan-number">5</span>
                            <div>
                                <h5>Transformasi Digital</h5>
                                <p>Mengintegrasikan teknologi dalam seluruh proses pelayanan untuk menciptakan pelayanan
                                    yang lebih cepat, akurat, dan terpercaya.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="tujuan-item">
                        <div class="d-flex align-items-start">
                            <span class="tujuan-number">6</span>
                            <div>
                                <h5>Pengembangan SDM</h5>
                                <p>Meningkatkan kapasitas dan kompetensi sumber daya manusia melalui pelatihan dan
                                    pengembangan yang berkelanjutan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Arah Perubahan Section -->
    <section class="perubahan-section section-padding">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title" data-aos="fade-up">Arah Perubahan</h2>
                    <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Transformasi organisasi menuju
                        SATPOL-PP yang modern, profesional, dan berorientasi pada pelayanan masyarakat</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="perubahan-card">
                        <div class="perubahan-icon">
                            <i class="bi bi-cpu"></i>
                        </div>
                        <h4 class="perubahan-title">Digitalisasi</h4>
                        <p>Transformasi dari sistem manual ke digital untuk meningkatkan efisiensi dan akurasi dalam setiap
                            proses pelayanan dan administrasi.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="perubahan-card">
                        <div class="perubahan-icon">
                            <i class="bi bi-person-gear"></i>
                        </div>
                        <h4 class="perubahan-title">Profesionalisme</h4>
                        <p>Peningkatan kompetensi dan profesionalisme aparatur melalui pelatihan berkelanjutan dan
                            sertifikasi keahlian.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="perubahan-card">
                        <div class="perubahan-icon">
                            <i class="bi bi-lightbulb"></i>
                        </div>
                        <h4 class="perubahan-title">Inovasi</h4>
                        <p>Pengembangan inovasi pelayanan yang kreatif dan solutif untuk menjawab tantangan dan kebutuhan
                            masyarakat modern.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="perubahan-card">
                        <div class="perubahan-icon">
                            <i class="bi bi-heart"></i>
                        </div>
                        <h4 class="perubahan-title">Pelayanan Prima</h4>
                        <p>Orientasi pada kepuasan masyarakat dengan standar pelayanan yang tinggi dan pendekatan yang
                            humanis.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Manfaat Section -->
    <section class="manfaat-section section-padding">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title text-white" data-aos="fade-up">Manfaat dari Program </h2>
                    <p class="section-subtitle text-white-50" data-aos="fade-up" data-aos-delay="100">Dampak positif
                        implementasi PIM bagi organisasi, masyarakat, dan pembangunan daerah</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="manfaat-item">
                        <div class="manfaat-icon">
                            <i class="bi bi-trophy"></i>
                        </div>
                        <h4 class="manfaat-title">Peningkatan Kualitas Pelayanan</h4>
                        <p>Masyarakat mendapatkan pelayanan yang lebih cepat, akurat, dan transparan sesuai dengan standar
                            pelayanan yang telah ditetapkan.</p>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="manfaat-item">
                        <div class="manfaat-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h4 class="manfaat-title">Efisiensi Organisasi</h4>
                        <p>Peningkatan efisiensi dalam penggunaan sumber daya dan optimalisasi proses kerja untuk hasil yang
                            maksimal.</p>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="manfaat-item">
                        <div class="manfaat-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h4 class="manfaat-title">Transparansi dan Akuntabilitas</h4>
                        <p>Terciptanya sistem yang transparan dan akuntabel dalam setiap kegiatan dan penggunaan anggaran
                            publik.</p>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="manfaat-item">
                        <div class="manfaat-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h4 class="manfaat-title">Kepercayaan Masyarakat</h4>
                        <p>Meningkatnya kepercayaan masyarakat terhadap kinerja dan kredibilitas SATPOL-PP Kota Ternate.</p>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="manfaat-item">
                        <div class="manfaat-icon">
                            <i class="bi bi-gear-fill"></i>
                        </div>
                        <h4 class="manfaat-title">Inovasi Berkelanjutan</h4>
                        <p>Mendorong budaya inovasi dan perbaikan berkelanjutan dalam setiap aspek pelayanan dan tata
                            kelola.</p>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="manfaat-item">
                        <div class="manfaat-icon">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <h4 class="manfaat-title">Prestasi dan Pengakuan</h4>
                        <p>Pencapaian prestasi dan pengakuan sebagai organisasi yang berkinerja tinggi dan terdepan dalam
                            pelayanan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita dan Artikel Section -->
    <section class="berita-section section-padding">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title" data-aos="fade-up">Berita dan Artikel Terbaru</h2>
                    <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Informasi terkini seputar
                        implementasi PIM dan kegiatan SATPOL-PP Kota Ternate</p>
                </div>
            </div>

            <div class="row g-4">
                <!-- Berita 1 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <article class="berita-card">
                        <div class="berita-image">
                            <i class="bi bi-award me-2"></i>
                            Implementasi PIM
                        </div>
                        <div class="berita-content">
                            <div class="berita-meta">
                                <span><i class="bi bi-calendar"></i> 15 Agustus 2025</span>
                                <span><i class="bi bi-person"></i> Tim PIM</span>
                            </div>
                            <h4 class="berita-title">SATPOL-PP Ternate Raih Skor PIM Tertinggi se-Maluku Utara</h4>
                            <p class="berita-excerpt">Pencapaian gemilang SATPOL-PP Kota Ternate dalam implementasi
                                Penilaian Indeks Maturitas dengan skor 85% menempatkan organisasi di peringkat teratas...
                            </p>
                            <a href="#" class="btn-read-more">
                                Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                </div>

                <!-- Berita 2 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <article class="berita-card">
                        <div class="berita-image">
                            <i class="bi bi-laptop me-2"></i>
                            Digitalisasi
                        </div>
                        <div class="berita-content">
                            <div class="berita-meta">
                                <span><i class="bi bi-calendar"></i> 12 Agustus 2025</span>
                                <span><i class="bi bi-person"></i> Admin Sistem</span>
                            </div>
                            <h4 class="berita-title">Launching Sistem Informasi Terintegrasi SATPOL-PP Digital</h4>
                            <p class="berita-excerpt">Peluncuran sistem informasi terintegrasi sebagai bagian dari
                                transformasi digital untuk meningkatkan efisiensi pelayanan kepada masyarakat...</p>
                            <a href="#" class="btn-read-more">
                                Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                </div>

                <!-- Berita 3 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <article class="berita-card">
                        <div class="berita-image">
                            <i class="bi bi-people me-2"></i>
                            Pelatihan SDM
                        </div>
                        <div class="berita-content">
                            <div class="berita-meta">
                                <span><i class="bi bi-calendar"></i> 10 Agustus 2025</span>
                                <span><i class="bi bi-person"></i> HRD</span>
                            </div>
                            <h4 class="berita-title">Pelatihan Komprehensif Implementasi PIM untuk Seluruh Pegawai</h4>
                            <p class="berita-excerpt">Program pelatihan intensif untuk membekali seluruh pegawai dengan
                                pemahaman dan keterampilan dalam implementasi sistem PIM...</p>
                            <a href="#" class="btn-read-more">
                                Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                </div>

                <!-- Berita 4 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <article class="berita-card">
                        <div class="berita-image">
                            <i class="bi bi-graph-up me-2"></i>
                            Evaluasi Kinerja
                        </div>
                        <div class="berita-content">
                            <div class="berita-meta">
                                <span><i class="bi bi-calendar"></i> 8 Agustus 2025</span>
                                <span><i class="bi bi-person"></i> Tim Evaluasi</span>
                            </div>
                            <h4 class="berita-title">Hasil Evaluasi Triwulan II 2025 Menunjukkan Peningkatan Signifikan
                            </h4>
                            <p class="berita-excerpt">Evaluasi kinerja triwulan kedua memperlihatkan peningkatan yang
                                signifikan di berbagai indikator penilaian PIM...</p>
                            <a href="#" class="btn-read-more">
                                Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                </div>

                <!-- Berita 5 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <article class="berita-card">
                        <div class="berita-image">
                            <i class="bi bi-lightbulb me-2"></i>
                            Inovasi
                        </div>
                        <div class="berita-content">
                            <div class="berita-meta">
                                <span><i class="bi bi-calendar"></i> 5 Agustus 2025</span>
                                <span><i class="bi bi-person"></i> Tim Inovasi</span>
                            </div>
                            <h4 class="berita-title">Inovasi "Smart Patrol" Mendapat Apresiasi dari Kemendagri</h4>
                            <p class="berita-excerpt">Program inovasi Smart Patrol yang mengintegrasikan teknologi GPS dan
                                AI dalam kegiatan patroli mendapat pengakuan nasional...</p>
                            <a href="#" class="btn-read-more">
                                Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                </div>

                <!-- Berita 6 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <article class="berita-card">
                        <div class="berita-image">
                            <i class="bi bi-handshake me-2"></i>
                            Kemitraan
                        </div>
                        <div class="berita-content">
                            <div class="berita-meta">
                                <span><i class="bi bi-calendar"></i> 3 Agustus 2025</span>
                                <span><i class="bi bi-person"></i> Sekretariat</span>
                            </div>
                            <h4 class="berita-title">MoU Kerjasama dengan Universitas Khairun untuk Pengembangan PIM</h4>
                            <p class="berita-excerpt">Penandatanganan nota kesepahaman dengan Universitas Khairun untuk
                                penelitian dan pengembangan sistem PIM yang lebih optimal...</p>
                            <a href="#" class="btn-read-more">
                                Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                </div>
            </div>

            <!-- Tombol Lihat Semua -->
            <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="700">
                <a href="#" class="btn btn-primary btn-lg px-5 py-3"
                    style="border-radius: 25px; font-weight: 600;">
                    Lihat Semua Berita <i class="bi bi-arrow-right ms-2"></i>
                </a>
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

        // Scroll to top functionality
        const scrollTop = document.getElementById('scroll-top');

        if (scrollTop) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 300) {
                    scrollTop.style.opacity = '1';
                } else {
                    scrollTop.style.opacity = '0';
                }
            });

            scrollTop.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

        // Smooth scrolling for navigation links
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

        // Counter animation for statistics
        function animateCounters() {
            const counters = document.querySelectorAll('.stats-number');

            counters.forEach(counter => {
                const target = parseInt(counter.textContent);
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

        // Interactive hover effects for cards
        document.querySelectorAll('.about-card, .perubahan-card, .berita-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Progress bar animation
        function createProgressBar() {
            const progressBar = document.createElement('div');
            progressBar.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 0%;
                height: 3px;
                background: #253900;
                z-index: 9999;
                transition: width 0.3s ease;
            `;
            document.body.appendChild(progressBar);

            window.addEventListener('scroll', function() {
                const scrolled = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) *
                    100;
                progressBar.style.width = scrolled + '%';
            });
        }

        // Add ID attributes to sections for navigation
        document.addEventListener('DOMContentLoaded', function() {
            const sections = [{
                    class: '.about-section',
                    id: 'tentang'
                },
                {
                    class: '.tujuan-section',
                    id: 'tujuan'
                },
                {
                    class: '.perubahan-section',
                    id: 'perubahan'
                },
                {
                    class: '.manfaat-section',
                    id: 'manfaat'
                },
                {
                    class: '.berita-section',
                    id: 'berita'
                }
            ];

            sections.forEach(section => {
                const element = document.querySelector(section.class);
                if (element) {
                    element.id = section.id;
                }
            });

            // Initialize progress bar
            createProgressBar();

            // Add loading animation
            document.body.style.opacity = '0';
            setTimeout(() => {
                document.body.style.transition = 'opacity 0.5s ease';
                document.body.style.opacity = '1';
            }, 100);

            console.log('PIM Website SATPOL-PP Ternate (Green Theme) loaded successfully!');
        });

        // Print functionality
        function printPage() {
            window.print();
        }

        // Share functionality
        function shareContent(title, text, url) {
            if (navigator.share) {
                navigator.share({
                    title: title,
                    text: text,
                    url: url
                });
            } else {
                const shareUrl =
                    `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(url)}`;
                window.open(shareUrl, '_blank');
            }
        }

        // Search functionality (placeholder)
        function searchContent(query) {
            console.log('Searching for:', query);
            // Implementation for search functionality
        }

        // Newsletter subscription (placeholder)
        function subscribeNewsletter(email) {
            console.log('Subscribing email:', email);
            alert('Terima kasih! Anda telah berlangganan update PIM SATPOL-PP Ternate.');
        }

        // Accessibility improvements
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                // Close any open modals or dropdowns
                const activeElements = document.querySelectorAll('.show');
                activeElements.forEach(element => {
                    element.classList.remove('show');
                });
            }
        });

        // Add focus indicators
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                document.body.classList.add('keyboard-navigation');
            }
        });

        document.addEventListener('mousedown', function() {
            document.body.classList.remove('keyboard-navigation');
        });

        // Card interaction animations
        document.querySelectorAll('.tujuan-item').forEach(item => {
            item.addEventListener('click', function() {
                this.style.transform = 'translateX(15px)';
                setTimeout(() => {
                    this.style.transform = 'translateX(10px)';
                }, 200);
            });
        });

        // Enhanced hover effects for manfaat items
        document.querySelectorAll('.manfaat-item').forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.background = 'rgba(255, 255, 255, 0.25)';
            });

            item.addEventListener('mouseleave', function() {
                this.style.background = 'rgba(255, 255, 255, 0.1)';
            });
        });

        // Berita card click handler
        document.querySelectorAll('.berita-card').forEach(card => {
            card.addEventListener('click', function() {
                const readMoreLink = this.querySelector('.btn-read-more');
                if (readMoreLink) {
                    readMoreLink.click();
                }
            });
        });

        // Statistics card enhanced animation
        document.querySelectorAll('.stats-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                const number = this.querySelector('.stats-number');
                if (number) {
                    number.style.transform = 'scale(1.1)';
                    number.style.color = '#1a2700';
                }
            });

            card.addEventListener('mouseleave', function() {
                const number = this.querySelector('.stats-number');
                if (number) {
                    number.style.transform = 'scale(1)';
                    number.style.color = '#253900';
                }
            });
        });

        // Parallax effect for header
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const header = document.querySelector('.pim-header');
            if (header) {
                header.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
        });
    </script>
@endpush
