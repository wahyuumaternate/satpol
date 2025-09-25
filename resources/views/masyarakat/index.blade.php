@extends('masyarakat.layouts.main')

@section('title', 'History Pengaduan')
@section('page-title', 'History Pengaduan')

@section('breadcrumb')
    <li class="breadcrumb-item">Pengaduan</li>
    <li class="breadcrumb-item active">History Pengaduan</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title mb-0">Daftar History Pengaduan</h5>

                        {{-- Filter Section --}}
                        <div class="d-flex gap-2">
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button"
                                    id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-funnel"></i> Filter Status
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                                    <li><a class="dropdown-item"
                                            href="{{ request()->fullUrlWithQuery(['status' => '']) }}">Semua Status</a></li>
                                    <li><a class="dropdown-item"
                                            href="{{ request()->fullUrlWithQuery(['status' => 'menunggu']) }}">Menunggu</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="{{ request()->fullUrlWithQuery(['status' => 'diproses']) }}">Diproses</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="{{ request()->fullUrlWithQuery(['status' => 'selesai']) }}">Selesai</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="{{ request()->fullUrlWithQuery(['status' => 'ditolak']) }}">Ditolak</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="dropdown">
                                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button"
                                    id="kategoriDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-tags"></i> Filter Kategori
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="kategoriDropdown">
                                    <li><a class="dropdown-item"
                                            href="{{ request()->fullUrlWithQuery(['kategori' => '']) }}">Semua Kategori</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="{{ request()->fullUrlWithQuery(['kategori' => 'keamanan']) }}">Keamanan</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="{{ request()->fullUrlWithQuery(['kategori' => 'kebersihan']) }}">Kebersihan</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="{{ request()->fullUrlWithQuery(['kategori' => 'kebisingan']) }}">Kebisingan</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="{{ request()->fullUrlWithQuery(['kategori' => 'parkir_liar']) }}">Parkir
                                            Liar</a></li>
                                    <li><a class="dropdown-item"
                                            href="{{ request()->fullUrlWithQuery(['kategori' => 'pedagang_kaki_lima']) }}">Pedagang
                                            Kaki Lima</a></li>
                                    <li><a class="dropdown-item"
                                            href="{{ request()->fullUrlWithQuery(['kategori' => 'vandalisme']) }}">Vandalisme</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="{{ request()->fullUrlWithQuery(['kategori' => 'lainnya']) }}">Lainnya</a>
                                    </li>
                                </ul>
                            </div>

                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#exportModal">
                                <i class="bi bi-download"></i> Export
                            </button>
                        </div>
                    </div>

                    {{-- Statistics Cards --}}
                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <div class="text-warning mb-2">
                                        <i class="bi bi-clock-history" style="font-size: 2rem;"></i>
                                    </div>
                                    <h5 class="text-warning mb-1">{{ $stats['menunggu'] ?? 0 }}</h5>
                                    <small class="text-muted">Menunggu</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <div class="text-info mb-2">
                                        <i class="bi bi-gear-fill" style="font-size: 2rem;"></i>
                                    </div>
                                    <h5 class="text-info mb-1">{{ $stats['diproses'] ?? 0 }}</h5>
                                    <small class="text-muted">Diproses</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <div class="text-success mb-2">
                                        <i class="bi bi-check-circle-fill" style="font-size: 2rem;"></i>
                                    </div>
                                    <h5 class="text-success mb-1">{{ $stats['selesai'] ?? 0 }}</h5>
                                    <small class="text-muted">Selesai</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <div class="text-danger mb-2">
                                        <i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i>
                                    </div>
                                    <h5 class="text-danger mb-1">{{ $stats['ditolak'] ?? 0 }}</h5>
                                    <small class="text-muted">Ditolak</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Search Bar --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <form method="GET" action="{{ route('backend.pengaduan.history') }}">
                                <div class="input-group">
                                    <input type="text" class="form-control"
                                        placeholder="Cari kode pengaduan, judul, atau pelapor..." name="search"
                                        value="{{ request('search') }}">
                                    <input type="hidden" name="status" value="{{ request('status') }}">
                                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 text-end">
                            <small class="text-muted">
                                Menampilkan {{ $pengaduans->firstItem() ?? 0 }} - {{ $pengaduans->lastItem() ?? 0 }}
                                dari {{ $pengaduans->total() ?? 0 }} pengaduan
                            </small>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="12%">Kode</th>
                                    <th width="20%">Pelapor</th>
                                    <th width="25%">Judul</th>
                                    <th width="12%">Kategori</th>
                                    <th width="10%">Status</th>
                                    <th width="12%">Tanggal</th>
                                    <th width="4%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pengaduans as $key => $pengaduan)
                                    <tr>
                                        <td>{{ $pengaduans->firstItem() + $key }}</td>
                                        <td>
                                            <code class="fs-6">{{ $pengaduan->kode_pengaduan }}</code>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="avatar-sm bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center me-2">
                                                    <i class="bi bi-person text-primary"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-medium">{{ $pengaduan->user->name }}</div>
                                                    <small class="text-muted">{{ $pengaduan->user->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-medium mb-1">{{ Str::limit($pengaduan->judul, 40) }}</div>
                                            <small class="text-muted">
                                                <i class="bi bi-geo-alt me-1"></i>
                                                {{ $pengaduan->kelurahan->nama ?? 'N/A' }},
                                                {{ $pengaduan->kecamatan->nama ?? 'N/A' }}
                                            </small>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                {{ str_replace('_', ' ', ucfirst($pengaduan->kategori_ketertiban)) }}
                                            </span>
                                        </td>
                                        <td>
                                            @php
                                                $statusConfig = [
                                                    'menunggu' => [
                                                        'class' => 'warning',
                                                        'icon' => 'clock',
                                                        'text' => 'Menunggu',
                                                    ],
                                                    'diproses' => [
                                                        'class' => 'info',
                                                        'icon' => 'gear',
                                                        'text' => 'Diproses',
                                                    ],
                                                    'selesai' => [
                                                        'class' => 'success',
                                                        'icon' => 'check-circle',
                                                        'text' => 'Selesai',
                                                    ],
                                                    'ditolak' => [
                                                        'class' => 'danger',
                                                        'icon' => 'x-circle',
                                                        'text' => 'Ditolak',
                                                    ],
                                                ];
                                                $config = $statusConfig[$pengaduan->status] ?? [
                                                    'class' => 'secondary',
                                                    'icon' => 'question',
                                                    'text' => ucfirst($pengaduan->status),
                                                ];
                                            @endphp
                                            <span class="badge bg-{{ $config['class'] }}">
                                                <i class="bi bi-{{ $config['icon'] }} me-1"></i>
                                                {{ $config['text'] }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="fw-medium">{{ $pengaduan->created_at->format('d/m/Y') }}</div>
                                            <small class="text-muted">{{ $pengaduan->created_at->format('H:i') }}</small>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <button class="dropdown-item"
                                                            onclick="viewDetail({{ $pengaduan->id }})">
                                                            <i class="bi bi-eye me-2"></i> Lihat Detail
                                                        </button>
                                                    </li>
                                                    @if ($pengaduan->foto_bukti)
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ Storage::url($pengaduan->foto_bukti) }}"
                                                                target="_blank">
                                                                <i class="bi bi-image me-2"></i> Lihat Foto
                                                            </a>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item text-primary"
                                                            onclick="editStatus({{ $pengaduan->id }})">
                                                            <i class="bi bi-pencil-square me-2"></i> Edit Status
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <form
                                                            action="{{ route('backend.pengaduan.destroy', $pengaduan->id) }}"
                                                            method="POST" style="display:inline;"
                                                            onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-danger">
                                                                <i class="bi bi-trash me-2"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                                                <div class="mt-2">Tidak ada data pengaduan</div>
                                                @if (request()->hasAny(['search', 'status', 'kategori']))
                                                    <small>Coba ubah filter atau kata kunci pencarian</small>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if ($pengaduans->hasPages())
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div>
                                <small class="text-muted">
                                    Menampilkan {{ $pengaduans->firstItem() }} - {{ $pengaduans->lastItem() }}
                                    dari {{ $pengaduans->total() }} hasil
                                </small>
                            </div>
                            <div>
                                {{ $pengaduans->appends(request()->query())->links() }}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    {{-- Modal Detail Pengaduan --}}
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Pengaduan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="detailContent">
                    {{-- Content will be loaded via AJAX --}}
                    <div class="text-center py-4">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit Status --}}
    <div class="modal fade" id="editStatusModal" tabindex="-1" aria-labelledby="editStatusModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editStatusForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editStatusModalLabel">Edit Status Pengaduan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editStatus" class="form-label">Status</label>
                            <select class="form-select" id="editStatus" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="menunggu">Menunggu</option>
                                <option value="diproses">Diproses</option>
                                <option value="selesai">Selesai</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editTanggapan" class="form-label">Tanggapan</label>
                            <textarea class="form-control" id="editTanggapan" name="tanggapan" rows="4"
                                placeholder="Berikan tanggapan atau keterangan..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Export --}}
    <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exportModalLabel">Export Data Pengaduan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('backend.pengaduan.export') }}" method="GET">
                        <div class="mb-3">
                            <label for="exportFormat" class="form-label">Format</label>
                            <select class="form-select" id="exportFormat" name="format" required>
                                <option value="">Pilih Format</option>
                                <option value="excel">Excel (.xlsx)</option>
                                <option value="csv">CSV (.csv)</option>
                                <option value="pdf">PDF (.pdf)</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exportDateFrom" class="form-label">Dari Tanggal</label>
                                    <input type="date" class="form-control" id="exportDateFrom" name="date_from">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exportDateTo" class="form-label">Sampai Tanggal</label>
                                    <input type="date" class="form-control" id="exportDateTo" name="date_to">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exportStatus" class="form-label">Filter Status</label>
                            <select class="form-select" id="exportStatus" name="status">
                                <option value="">Semua Status</option>
                                <option value="menunggu">Menunggu</option>
                                <option value="diproses">Diproses</option>
                                <option value="selesai">Selesai</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                        </div>
                        <div class="modal-footer px-0 pb-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-download me-1"></i> Export
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function viewDetail(id) {
            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('detailModal'));
            modal.show();

            // Load detail content
            fetch(`/backend/pengaduan/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('detailContent').innerHTML = `
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-3">INFORMASI PELAPOR</h6>
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">Nama</td>
                                    <td><strong>${data.user.name}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Email</td>
                                    <td>${data.user.email}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Telepon</td>
                                    <td>${data.nomor_telepon || 'Tidak tersedia'}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-3">INFORMASI PENGADUAN</h6>
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">Kode</td>
                                    <td><code>${data.kode_pengaduan}</code></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Status</td>
                                    <td><span class="badge bg-${getStatusClass(data.status)}">${getStatusText(data.status)}</span></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Kategori</td>
                                    <td>${data.kategori_ketertiban.replace('_', ' ').toUpperCase()}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Waktu Kejadian</td>
                                    <td>${formatDate(data.waktu_kejadian)}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-12">
                            <h6 class="text-muted mb-3">DETAIL KEJADIAN</h6>
                            <div class="mb-3">
                                <strong>Judul:</strong>
                                <p class="mt-1">${data.judul}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Deskripsi:</strong>
                                <p class="mt-1">${data.deskripsi}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Lokasi:</strong>
                                <p class="mt-1">${data.alamat_kejadian}<br>
                                <small class="text-muted">${data.lokasi_kejadian}</small></p>
                            </div>
                            ${data.foto_bukti ? `
                                        <div class="mb-3">
                                            <strong>Foto Bukti:</strong>
                                            <div class="mt-2">
                                                <img src="/storage/${data.foto_bukti}" alt="Foto Bukti" class="img-fluid rounded" style="max-height: 300px;">
                                            </div>
                                        </div>
                                    ` : ''}
                            ${data.tanggapan ? `
                                        <div class="mb-3">
                                            <strong>Tanggapan:</strong>
                                            <div class="alert alert-info mt-2">
                                                <p class="mb-1">${data.tanggapan}</p>
                                                <small class="text-muted">Tanggal: ${formatDate(data.tanggal_tanggapan)}</small>
                                            </div>
                                        </div>
                                    ` : ''}
                        </div>
                    </div>
                `;
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('detailContent').innerHTML = `
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        Terjadi kesalahan saat memuat data
                    </div>
                `;
                });
        }

        function editStatus(id) {
            // Load current data
            fetch(`/backend/pengaduan/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editStatusForm').action = `/backend/pengaduan/${id}/status`;
                    document.getElementById('editStatus').value = data.status;
                    document.getElementById('editTanggapan').value = data.tanggapan || '';

                    // Show modal
                    const modal = new bootstrap.Modal(document.getElementById('editStatusModal'));
                    modal.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memuat data');
                });
        }

        // Handle edit status form submission
        document.getElementById('editStatusForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;

            // Show loading state
            submitButton.innerHTML =
                '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Loading...';
            submitButton.disabled = true;

            fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Hide modal
                        bootstrap.Modal.getInstance(document.getElementById('editStatusModal')).hide();

                        // Show success message
                        showAlert('success', 'Status pengaduan berhasil diupdate');

                        // Reload page
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        throw new Error(data.message || 'Terjadi kesalahan');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('danger', 'Terjadi kesalahan saat mengupdate status');
                })
                .finally(() => {
                    // Restore button state
                    submitButton.innerHTML = originalText;
                    submitButton.disabled = false;
                });
        });

        // Helper functions
        function getStatusClass(status) {
            const classes = {
                'menunggu': 'warning',
                'diproses': 'info',
                'selesai': 'success',
                'ditolak': 'danger'
            };
            return classes[status] || 'secondary';
        }

        function getStatusText(status) {
            const texts = {
                'menunggu': 'Menunggu',
                'diproses': 'Diproses',
                'selesai': 'Selesai',
                'ditolak': 'Ditolak'
            };
            return texts[status] || status;
        }

        function formatDate(dateString) {
            if (!dateString) return 'Tidak tersedia';
            return new Date(dateString).toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        function showAlert(type, message) {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
            alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
            document.body.appendChild(alertDiv);

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (alertDiv.parentNode) {
                    alertDiv.parentNode.removeChild(alertDiv);
                }
            }, 5000);
        }

        // Set current date as default for export date range
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            const lastMonth = new Date();
            lastMonth.setMonth(lastMonth.getMonth() - 1);
            const lastMonthFormatted = lastMonth.toISOString().split('T')[0];

            document.getElementById('exportDateFrom').value = lastMonthFormatted;
            document.getElementById('exportDateTo').value = today;
        });
    </script>
@endpush
