@extends('backend.layouts.main')

@section('title', 'Kelola Pengaduan')
@section('page-title', 'Kelola Pengaduan Masyarakat')

@section('breadcrumb')
    <li class="breadcrumb-item">Pengaduan</li>
    <li class="breadcrumb-item active">Kelola Pengaduan</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title">Daftar Pengaduan Masyarakat</h5>
                        <div class="d-flex gap-2">
                            <select class="form-select form-select-sm" id="filterStatus" style="width: auto;">
                                <option value="">Semua Status</option>
                                <option value="menunggu">Menunggu</option>
                                <option value="proses">Proses</option>
                                <option value="selesai">Selesai</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                            <select class="form-select form-select-sm" id="filterKategori" style="width: auto;">
                                <option value="">Semua Kategori</option>
                                <option value="keamanan">Keamanan</option>
                                <option value="kebersihan">Kebersihan</option>
                                <option value="kebisingan">Kebisingan</option>
                                <option value="parkir_liar">Parkir Liar</option>
                                <option value="pedagang_kaki_lima">Pedagang Kaki Lima</option>
                                <option value="vandalisme">Vandalisme</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Judul</th>
                                    <th>Pelapor</th>
                                    <th>Kelurahan</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pengaduans as $key => $pengaduan)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><code>{{ $pengaduan->kode_pengaduan }}</code></td>
                                        <td>
                                            <div class="fw-bold">{{ $pengaduan->judul }}</div>
                                            <small class="text-muted">{{ Str::limit($pengaduan->deskripsi, 50) }}</small>
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $pengaduan->nama_pelapor }}</div>
                                            <small class="text-muted">{{ $pengaduan->email_pelapor }}</small>
                                        </td>
                                        <td>{{ $pengaduan->kelurahan->nama ?? '-' }}</td>
                                        <td>
                                            <span class="badge bg-info">
                                                {{ ucwords(str_replace('_', ' ', $pengaduan->kategori_ketertiban)) }}
                                            </span>
                                        </td>
                                        <td>
                                            @switch($pengaduan->status)
                                                @case('menunggu')
                                                    <span class="badge bg-warning">Menunggu</span>
                                                @break

                                                @case('proses')
                                                    <span class="badge bg-primary">Proses</span>
                                                @break

                                                @case('selesai')
                                                    <span class="badge bg-success">Selesai</span>
                                                @break

                                                @case('ditolak')
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td>{{ $pengaduan->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#detailPengaduanModal"
                                                    onclick="detailPengaduan({{ $pengaduan->id }})" title="Detail">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#tanggapanModal"
                                                    onclick="tanggapanPengaduan({{ $pengaduan->id }})" title="Tanggapan">
                                                    <i class="bi bi-chat-dots"></i>
                                                </button>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false"
                                                        title="Update Status">
                                                        <i class="bi bi-gear"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#"
                                                                onclick="updateStatus({{ $pengaduan->id }}, 'menunggu')">
                                                                <i class="bi bi-clock text-warning"></i> Menunggu</a></li>
                                                        <li><a class="dropdown-item" href="#"
                                                                onclick="updateStatus({{ $pengaduan->id }}, 'proses')">
                                                                <i class="bi bi-arrow-clockwise text-primary"></i>
                                                                Proses</a></li>
                                                        <li><a class="dropdown-item" href="#"
                                                                onclick="updateStatus({{ $pengaduan->id }}, 'selesai')">
                                                                <i class="bi bi-check-circle text-success"></i> Selesai</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="#"
                                                                onclick="updateStatus({{ $pengaduan->id }}, 'ditolak')">
                                                                <i class="bi bi-x-circle text-danger"></i> Ditolak</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">Tidak ada pengaduan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Modal Detail Pengaduan -->
                        <div class="modal fade" id="detailPengaduanModal" tabindex="-1"
                            aria-labelledby="detailPengaduanModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailPengaduanModalLabel">Detail Pengaduan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" id="detailContent">
                                        <!-- Content will be loaded here -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Tanggapan -->
                        <div class="modal fade" id="tanggapanModal" tabindex="-1" aria-labelledby="tanggapanModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form id="tanggapanForm" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tanggapanModalLabel">Berikan Tanggapan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="tanggapan" class="form-label">Tanggapan</label>
                                                <textarea class="form-control" id="tanggapan" name="tanggapan" rows="4"
                                                    placeholder="Berikan tanggapan untuk pengaduan ini..." required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" id="status" name="status" required>
                                                    <option value="proses">Proses</option>
                                                    <option value="selesai">Selesai</option>
                                                    <option value="ditolak">Ditolak</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Kirim Tanggapan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4>{{ $statistik['menunggu'] ?? 0 }}</h4>
                                <p class="mb-0">Menunggu</p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-clock-history fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4>{{ $statistik['proses'] ?? 0 }}</h4>
                                <p class="mb-0">Proses</p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-arrow-clockwise fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4>{{ $statistik['selesai'] ?? 0 }}</h4>
                                <p class="mb-0">Selesai</p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-check-circle fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4>{{ $statistik['ditolak'] ?? 0 }}</h4>
                                <p class="mb-0">Ditolak</p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-x-circle fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script>
            function detailPengaduan(id) {
                // Fetch pengaduan detail
                fetch(`/backend/pengaduan/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        const detailContent = document.getElementById('detailContent');
                        const waktuKejadian = data.waktu_kejadian ? new Date(data.waktu_kejadian).toLocaleString('id-ID') :
                            '-';
                        const tanggalTanggapan = data.tanggal_tanggapan ? new Date(data.tanggal_tanggapan).toLocaleString(
                            'id-ID') : '-';

                        detailContent.innerHTML = `
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Informasi Pengaduan</h6>
                                <table class="table table-borderless table-sm">
                                    <tr><td class="fw-bold">Kode:</td><td><code>${data.kode_pengaduan}</code></td></tr>
                                    <tr><td class="fw-bold">Judul:</td><td>${data.judul}</td></tr>
                                    <tr><td class="fw-bold">Kategori:</td><td><span class="badge bg-info">${data.kategori_ketertiban.replace('_', ' ').toUpperCase()}</span></td></tr>
                                    <tr><td class="fw-bold">Status:</td><td><span class="badge bg-${getStatusColor(data.status)}">${data.status.toUpperCase()}</span></td></tr>
                                    <tr><td class="fw-bold">Kelurahan:</td><td>${data.kelurahan?.nama || '-'}</td></tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Informasi Pelapor</h6>
                                <table class="table table-borderless table-sm">
                                    <tr><td class="fw-bold">Nama:</td><td>${data.nama_pelapor}</td></tr>
                                    <tr><td class="fw-bold">Email:</td><td>${data.email_pelapor || '-'}</td></tr>
                                    <tr><td class="fw-bold">Telepon:</td><td>${data.nomor_telepon || '-'}</td></tr>
                                    <tr><td class="fw-bold">Alamat:</td><td>${data.alamat_pelapor}</td></tr>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <h6 class="fw-bold">Deskripsi Pengaduan</h6>
                                <p class="bg-light p-3 rounded">${data.deskripsi}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Lokasi Kejadian</h6>
                                <p>${data.lokasi_kejadian}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Waktu Kejadian</h6>
                                <p>${waktuKejadian}</p>
                            </div>
                        </div>
                        ${data.foto_bukti ? `
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="fw-bold">Foto Bukti</h6>
                                        <img src="/storage/${data.foto_bukti}" class="img-fluid rounded" style="max-height: 300px;">
                                    </div>
                                </div>
                                ` : ''}
                        ${data.tanggapan ? `
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <h6 class="fw-bold">Tanggapan <small class="text-muted">(${tanggalTanggapan})</small></h6>
                                        <div class="alert alert-info">${data.tanggapan}</div>
                                    </div>
                                </div>
                                ` : ''}
                    `;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        document.getElementById('detailContent').innerHTML =
                            '<div class="alert alert-danger">Gagal memuat detail pengaduan.</div>';
                    });
            }

            function tanggapanPengaduan(id) {
                document.getElementById('tanggapanForm').action = `/backend/pengaduan/${id}/tanggapan`;
                document.getElementById('tanggapan').value = '';
                document.getElementById('status').value = 'proses';
            }

            function updateStatus(id, status) {
                if (confirm(`Apakah Anda yakin ingin mengubah status menjadi "${status}"?`)) {
                    fetch(`/backend/pengaduan/${id}/status`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                status: status
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            } else {
                                alert('Gagal mengubah status');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan');
                        });
                }
            }

            function getStatusColor(status) {
                switch (status) {
                    case 'menunggu':
                        return 'warning';
                    case 'proses':
                        return 'primary';
                    case 'selesai':
                        return 'success';
                    case 'ditolak':
                        return 'danger';
                    default:
                        return 'secondary';
                }
            }

            // Handle tanggapan form submission
            document.getElementById('tanggapanForm').addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(this);

                fetch(this.action, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            $('#tanggapanModal').modal('hide');
                            location.reload();
                        } else {
                            alert('Gagal mengirim tanggapan');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan');
                    });
            });

            // Filter functionality
            document.getElementById('filterStatus').addEventListener('change', function() {
                filterTable();
            });

            document.getElementById('filterKategori').addEventListener('change', function() {
                filterTable();
            });

            function filterTable() {
                const statusFilter = document.getElementById('filterStatus').value.toLowerCase();
                const kategoriFilter = document.getElementById('filterKategori').value.toLowerCase();
                const tableRows = document.querySelectorAll('tbody tr');

                tableRows.forEach(row => {
                    if (row.children.length === 1) return; // Skip "no data" row

                    const statusCell = row.children[6].textContent.toLowerCase();
                    const kategoriCell = row.children[5].textContent.toLowerCase();

                    const statusMatch = !statusFilter || statusCell.includes(statusFilter);
                    const kategoriMatch = !kategoriFilter || kategoriCell.includes(kategoriFilter.replace('_', ' '));

                    if (statusMatch && kategoriMatch) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
        </script>
    @endpush
