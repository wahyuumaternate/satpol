@extends('layouts.main')

@section('main')
    <!-- Header -->
    <header class="pengaduan-header mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 data-aos="fade-up">Status Pengaduan</h1>
                    <p data-aos="fade-up" data-aos-delay="100">Detail status pengaduan dan tindak lanjut yang telah dilakukan
                    </p>
                </div>
            </div>
        </div>
    </header>

    <!-- Status Section -->
    <section class="form-section section-padding">
        <div class="container">
            @if (isset($pengaduan))
                <div class="row">
                    <div class="col-lg-8 mx-auto" data-aos="fade-up">
                        <div class="form-card">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="mb-0">Pengaduan #{{ $pengaduan->kode_pengaduan }}</h3>

                                @php
                                    $statusClass = 'badge-menunggu';
                                    switch ($pengaduan->status) {
                                        case 'proses':
                                            $statusClass = 'badge-proses';
                                            break;
                                        case 'selesai':
                                            $statusClass = 'badge-selesai';
                                            break;
                                        case 'ditolak':
                                            $statusClass = 'badge-ditolak';
                                            break;
                                    }
                                @endphp

                                <span class="badge-status {{ $statusClass }}">
                                    {{ ucfirst($pengaduan->status) }}
                                </span>
                            </div>

                            <!-- Detail Pengaduan -->
                            <div class="mb-4">
                                <h5 class="mb-3"><i class="bi bi-info-circle me-2"></i> Detail Pengaduan</h5>
                                <hr>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted">Tanggal Pengaduan</p>
                                        <p class="fw-bold">{{ $pengaduan->created_at->format('d F Y, H:i') }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted">Kategori</p>
                                        <p class="fw-bold">
                                            {{ ucwords(str_replace('_', ' ', $pengaduan->kategori_ketertiban)) }}</p>
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted">Lokasi</p>
                                        <p class="fw-bold">
                                            {{ $pengaduan->kelurahan->nama }}, {{ $pengaduan->kelurahan->kecamatan->nama }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted">Detail Lokasi</p>
                                        <p class="fw-bold">{{ $pengaduan->lokasi_kejadian }}</p>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <p class="mb-1 text-muted">Judul Pengaduan</p>
                                    <h5>{{ $pengaduan->judul }}</h5>
                                </div>

                                <div class="mb-3">
                                    <p class="mb-1 text-muted">Deskripsi Pengaduan</p>
                                    <p>{{ $pengaduan->deskripsi }}</p>
                                </div>

                                @if ($pengaduan->foto_bukti)
                                    <div class="mb-3">
                                        <p class="mb-1 text-muted">Foto Bukti</p>
                                        <img src="{{ asset('storage/foto_bukti/' . $pengaduan->foto_bukti) }}"
                                            class="img-fluid rounded" style="max-height: 300px" alt="Foto Bukti">
                                    </div>
                                @endif
                            </div>

                            <!-- Tanggapan Petugas -->
                            <div class="mb-4">
                                <h5 class="mb-3"><i class="bi bi-chat-left-text me-2"></i> Tanggapan Petugas</h5>
                                <hr>

                                @if ($pengaduan->tanggapan)
                                    <div class="bg-light p-3 rounded mb-3">
                                        <p>{{ $pengaduan->tanggapan }}</p>

                                        @if ($pengaduan->tanggal_tanggapan)
                                            <small class="text-muted d-block mt-2">
                                                Ditanggapi pada: {{ $pengaduan->tanggal_tanggapan->format('d F Y, H:i') }}
                                            </small>
                                        @endif
                                    </div>
                                @else
                                    <div class="alert alert-info">
                                        Belum ada tanggapan dari petugas. Silahkan periksa kembali nanti.
                                    </div>
                                @endif
                            </div>

                            <div class="text-center">
                                <a href="{{ route('pengaduan.cek-status') }}" class="btn btn-outline-primary me-2">
                                    <i class="bi bi-arrow-left me-2"></i> Kembali
                                </a>

                                @if ($pengaduan->status == 'menunggu' || $pengaduan->status == 'proses')
                                    <a href="{{ route('pengaduan.form') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-circle me-2"></i> Buat Pengaduan Baru
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="alert alert-danger">
                            <h4 class="alert-heading">Pengaduan Tidak Ditemukan!</h4>
                            <p>Mohon maaf, data pengaduan yang Anda cari tidak ditemukan atau telah dihapus.</p>
                            <hr>
                            <p class="mb-0">Silakan periksa kembali kode pengaduan yang Anda masukkan atau buat pengaduan
                                baru.</p>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('pengaduan.cek-status') }}" class="btn btn-outline-primary me-2">
                                <i class="bi bi-arrow-left me-2"></i> Cek Status Lainnya
                            </a>
                            <a href="{{ route('pengaduan.form') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-2"></i> Buat Pengaduan Baru
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
