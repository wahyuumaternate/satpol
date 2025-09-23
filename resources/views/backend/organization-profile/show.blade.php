@extends('backend.layouts.main')

@section('title', 'Detail Profil Organisasi')
@section('page-title', 'Detail Profil Organisasi')

@section('breadcrumb')
    <li class="breadcrumb-item">Profil Organisasi</li>
    <li class="breadcrumb-item"><a href="{{ route('backend.organization-profile.admin.index') }}">Kelola Profil</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@push('styles')
    <style>
        .content-display {
            line-height: 1.8;
        }

        .content-display img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 10px 0;
        }

        .info-card {
            background: #f8f9fa;
            border-left: 4px solid #0d6efd;
            padding: 15px;
            border-radius: 8px;
        }

        .header-image {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h3 class="card-title mb-2">{{ $profile->title }}</h3>
                            @if ($profile->description)
                                <p class="text-muted fs-5">{{ $profile->description }}</p>
                            @endif
                        </div>
                        <div>
                            @if ($profile->is_active)
                                <span class="badge bg-success fs-6">Aktif</span>
                            @else
                                <span class="badge bg-secondary fs-6">Non-aktif</span>
                            @endif
                        </div>
                    </div>

                    @if ($profile->image)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $profile->image) }}" alt="{{ $profile->title }}"
                                class="header-image">
                        </div>
                    @endif

                    @if ($profile->content)
                        <div class="content-display">
                            {!! $profile->content !!}
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> Konten belum diisi untuk halaman ini.
                        </div>
                    @endif
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('backend.organization-profile.admin.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                        </a>
                        <a href="{{ route('backend.organization-profile.edit', $profile->id) }}" class="btn btn-primary">
                            <i class="bi bi-pencil"></i> Edit Halaman
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Page Info -->
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0"><i class="bi bi-info-circle"></i> Informasi Halaman</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td><strong>Slug:</strong></td>
                            <td><code>{{ $profile->slug }}</code></td>
                        </tr>
                        <tr>
                            <td><strong>Urutan:</strong></td>
                            <td>{{ $profile->sort_order }}</td>
                        </tr>
                        <tr>
                            <td><strong>Status:</strong></td>
                            <td>
                                @if ($profile->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Non-aktif</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Dibuat:</strong></td>
                            <td>{{ $profile->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Terakhir Update:</strong></td>
                            <td>{{ $profile->updated_at->format('d M Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- SEO Info -->
            @if ($profile->meta_title || $profile->meta_description)
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="bi bi-search"></i> SEO Information</h6>
                    </div>
                    <div class="card-body">
                        @if ($profile->meta_title)
                            <div class="mb-3">
                                <strong>Meta Title:</strong>
                                <p class="small text-muted mb-0">{{ $profile->meta_title }}</p>
                            </div>
                        @endif

                        @if ($profile->meta_description)
                            <div class="mb-0">
                                <strong>Meta Description:</strong>
                                <p class="small text-muted mb-0">{{ $profile->meta_description }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0"><i class="bi bi-lightning"></i> Aksi Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('backend.organization-profile.edit', $profile->id) }}"
                            class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i> Edit Halaman
                        </a>
                        <a href="#"
                            onclick="copyToClipboard('{{ route('organization-profile.show', $profile->slug) }}')"
                            class="btn btn-info btn-sm">
                            <i class="bi bi-link-45deg"></i> Salin Link
                        </a>
                        @if ($profile->is_active)
                            <a href="{{ route('organization-profile.show', $profile->slug) }}" target="_blank"
                                class="btn btn-success btn-sm">
                                <i class="bi bi-eye"></i> Lihat di Website
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Content Stats -->
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0"><i class="bi bi-bar-chart"></i> Statistik Konten</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h4 class="mb-1">{{ str_word_count(strip_tags($profile->content)) }}</h4>
                                <small class="text-muted">Kata</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <h4 class="mb-1">{{ strlen(strip_tags($profile->content)) }}</h4>
                            <small class="text-muted">Karakter</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                // Show success message
                const toast = document.createElement('div');
                toast.className = 'toast align-items-center text-white bg-success border-0';
                toast.setAttribute('role', 'alert');
                toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                        Link berhasil disalin ke clipboard!
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;

                document.body.appendChild(toast);
                const bsToast = new bootstrap.Toast(toast);
                bsToast.show();

                // Remove toast after it's hidden
                toast.addEventListener('hidden.bs.toast', () => {
                    document.body.removeChild(toast);
                });
            });
        }
    </script>
@endpush
