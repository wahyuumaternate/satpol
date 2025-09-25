@extends('masyarakat.layouts.main')

@section('title', 'Pengaduan Saya')

@section('breadcrumb')
    <li class="breadcrumb-item active">Pengaduan Saya</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Pengaduan Saya</h5>

                    <!-- Filter Section -->
                    <div class="row mb-4">
                        <div class="col-md-9">
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control"
                                    placeholder="Cari pengaduan berdasarkan judul, kode atau tanggal...">
                                <button class="btn btn-primary" type="button">Cari</button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="filterStatus">
                                <option value="">Semua Status</option>
                                <option value="menunggu">Menunggu</option>
                                <option value="proses">Diproses</option>
                                <option value="selesai">Selesai</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                        </div>
                    </div>

                    <!-- Status Summary -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="alert alert-light border d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-wrap gap-3">
                                    <div class="px-3">
                                        <span class="badge bg-secondary rounded-pill mb-1">Total</span>
                                        <h5 class="fs-5 mb-0">{{ $totalPengaduan ?? 0 }}</h5>
                                    </div>
                                    <div class="border-start ps-3">
                                        <span class="badge bg-warning text-dark rounded-pill mb-1">Menunggu</span>
                                        <h5 class="fs-5 mb-0">{{ $countByStatus['menunggu'] ?? 0 }}</h5>
                                    </div>
                                    <div class="border-start ps-3">
                                        <span class="badge bg-primary rounded-pill mb-1">Diproses</span>
                                        <h5 class="fs-5 mb-0">{{ $countByStatus['proses'] ?? 0 }}</h5>
                                    </div>
                                    <div class="border-start ps-3">
                                        <span class="badge bg-success rounded-pill mb-1">Selesai</span>
                                        <h5 class="fs-5 mb-0">{{ $countByStatus['selesai'] ?? 0 }}</h5>
                                    </div>
                                    <div class="border-start ps-3">
                                        <span class="badge bg-danger rounded-pill mb-1">Ditolak</span>
                                        <h5 class="fs-5 mb-0">{{ $countByStatus['ditolak'] ?? 0 }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($pengaduan->count() > 0)
                        <!-- Pengaduan Table -->
                        <div class="table-responsive">
                            <table class="table table-borderless datatable table-striped table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Kode</th>
                                        <th scope="col">Judul Pengaduan</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengaduan as $item)
                                        <tr>
                                            <td><code>{{ $item->kode_pengaduan }}</code></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="pengaduan-icon bg-light rounded-circle p-2 me-2">
                                                        @if ($item->kategori)
                                                            <i
                                                                class="bi bi-{{ $item->kategori->icon ?? 'exclamation-triangle' }} text-{{ $item->kategori->color ?? 'secondary' }}"></i>
                                                        @else
                                                            <i class="bi bi-exclamation-triangle text-secondary"></i>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        {{ $item->judul }}
                                                        <div class="small text-muted">
                                                            <i
                                                                class="bi bi-geo-alt me-1"></i>{{ $item->kelurahan->nama ?? 'N/A' }},
                                                            {{ $item->kelurahan->kecamatan->nama ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark border">
                                                    {{ $item->kategori->nama ?? 'Tanpa Kategori' }}
                                                </span>
                                            </td>
                                            <td>{{ $item->created_at->format('d M Y') }}</td>
                                            <td>
                                                @if ($item->status == 'menunggu')
                                                    <div class="badge bg-warning text-dark px-3 py-2">
                                                        <i class="bi bi-clock me-1"></i> Menunggu
                                                    </div>
                                                @elseif($item->status == 'proses')
                                                    <div class="badge bg-primary px-3 py-2">
                                                        <i class="bi bi-gear me-1"></i> Diproses
                                                    </div>
                                                @elseif($item->status == 'selesai')
                                                    <div class="badge bg-success px-3 py-2">
                                                        <i class="bi bi-check-circle me-1"></i> Selesai
                                                    </div>
                                                @elseif($item->status == 'ditolak')
                                                    <div class="badge bg-danger px-3 py-2">
                                                        <i class="bi bi-x-circle me-1"></i> Ditolak
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('masyarakat.pengaduan.show', $item->id) }}"
                                                    class="btn btn-sm btn-primary rounded-pill">
                                                    <i class="bi bi-eye me-1"></i> Lihat
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div>
                                <p class="text-muted small">Menampilkan {{ $pengaduan->firstItem() ?? 0 }} -
                                    {{ $pengaduan->lastItem() ?? 0 }} dari {{ $pengaduan->total() ?? 0 }} data</p>
                            </div>
                            <div>
                                {{ $pengaduan->appends(request()->query())->links() }}
                            </div>
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-5">
                            <img src="{{ asset('backend/assets/img/illustrations/empty.svg') }}" alt="No Data"
                                class="img-fluid mb-4" style="max-width: 200px;">
                            <h5>Belum Ada Pengaduan</h5>
                            <p class="text-muted col-lg-6 mx-auto">
                                Anda belum memiliki data pengaduan. Silakan buat pengaduan baru melalui menu "Buat
                                Pengaduan".
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Pengaduan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalContent">
                    <!-- Content will be loaded here -->
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p>Memuat data...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <a href="#" class="btn btn-primary" id="viewFullDetail">Lihat Detail Lengkap</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add icon styling
            document.querySelectorAll('.pengaduan-icon').forEach(icon => {
                icon.style.width = '36px';
                icon.style.height = '36px';
                icon.style.display = 'flex';
                icon.style.alignItems = 'center';
                icon.style.justifyContent = 'center';
            });

            // Initialize datatable if available
            if (typeof $.fn.DataTable !== 'undefined') {
                const dataTable = new simpleDatatables.DataTable(".datatable", {
                    perPageSelect: [10, 25, 50, 100],
                    columns: [
                        // Define searchable columns
                        {
                            select: 0,
                            sort: "asc"
                        },
                        {
                            select: 1,
                            sort: "asc"
                        },
                        {
                            select: 2,
                            sort: "asc"
                        },
                        {
                            select: 3,
                            sort: "desc"
                        },
                        {
                            select: 4,
                            sort: "asc"
                        },
                        {
                            select: 5,
                            sort: "asc",
                            searchable: false,
                            sortable: false
                        }
                    ]
                });
            }

            // Filter functionality
            document.getElementById('filterStatus').addEventListener('change', function() {
                // This would typically submit the form or update the page via AJAX
                // For demo purposes, we'll just log the selected value
                console.log('Filter by status: ' + this.value);
                // In a real implementation, you would redirect or reload with the filter
                // window.location.href = '{{ route('masyarakat.pengaduan.index') }}?status=' + this.value;
            });

            // Row hover effect with smooth transition
            document.querySelectorAll('tbody tr').forEach(row => {
                row.addEventListener('mouseover', () => {
                    row.style.transition = 'all 0.2s ease';
                    row.style.backgroundColor = 'rgba(65, 84, 241, 0.05)';
                });

                row.addEventListener('mouseout', () => {
                    row.style.backgroundColor = '';
                });
            });

            // Modal functionality for quick view (if implemented)
            const viewButtons = document.querySelectorAll('.btn-view-modal');
            if (viewButtons.length > 0) {
                viewButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        document.getElementById('viewFullDetail').href =
                            "{{ route('masyarakat.pengaduan.show', '') }}/" + id;

                        // AJAX call to load pengaduan details would go here
                        // For demo purposes, we'll just show the modal
                        const modal = new bootstrap.Modal(document.getElementById('detailModal'));
                        modal.show();
                    });
                });
            }

            // Animation for page load
            function fadeInContent() {
                document.querySelector('.card').style.opacity = '1';
            }

            document.querySelector('.card').style.opacity = '0';
            document.querySelector('.card').style.transition = 'opacity 0.5s ease';

            setTimeout(fadeInContent, 100);
        });
    </script>
@endpush
