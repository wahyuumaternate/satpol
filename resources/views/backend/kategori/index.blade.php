@extends('backend.layouts.main')

@section('title', 'Kelola Kategori')
@section('page-title', 'Kelola Kategori')

@section('breadcrumb')
    <li class="breadcrumb-item">Kategori</li>
    <li class="breadcrumb-item active">Kelola Kategori</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Kategori</h5>

                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Terakhir Update</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $key => $category)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $category->nama }}</td>
                                        <td><code>{{ $category->slug }}</code></td>
                                        <td>
                                            @if ($category->is_active)
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-secondary">Non-aktif</span>
                                            @endif
                                        </td>
                                        <td>{{ $category->updated_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#editCategoryModal"
                                                    onclick="editCategory({{ $category->id }})">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </button>
                                                <form action="{{ route('backend.kategori.destroy', $category->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada kategori</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal for Add Category -->
                    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="addCategoryForm" action="{{ route('backend.kategori.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addCategoryModalLabel">Tambah Kategori</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="slug" class="form-label">Slug</label>
                                            <input type="text" class="form-control" id="slug" name="slug"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="is_active" class="form-label">Status</label>
                                            <select class="form-select" id="is_active" name="is_active">
                                                <option value="1">Aktif</option>
                                                <option value="0">Non-aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Edit Category -->
                    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="editCategoryForm" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editCategoryModalLabel">Edit Kategori</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="editNama" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="editNama" name="nama"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editSlug" class="form-label">Slug</label>
                                            <input type="text" class="form-control" id="editSlug" name="slug"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editIsActive" class="form-label">Status</label>
                                            <select class="form-select" id="editIsActive" name="is_active">
                                                <option value="1">Aktif</option>
                                                <option value="0">Non-aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function editCategory(id) {
            // Fetch category data
            fetch(`/backend/kategori/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editCategoryForm').action = `/backend/kategori/${id}`;
                    document.getElementById('editNama').value = data.nama;
                    document.getElementById('editSlug').value = data.slug;
                    document.getElementById('editIsActive').value = data.is_active;
                });
        }

        // Optionally, handle form submission via AJAX (for Add/Edit)
        document.getElementById('addCategoryForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            fetch(this.action, {
                method: 'POST',
                body: formData
            }).then(response => response.json()).then(data => {
                // Handle success
                $('#addCategoryModal').modal('hide');
                location.reload(); // Reload page to reflect new category
            });
        });

        document.getElementById('editCategoryForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            fetch(this.action, {
                method: 'PUT',
                body: formData
            }).then(response => response.json()).then(data => {
                // Handle success
                $('#editCategoryModal').modal('hide');
                location.reload(); // Reload page to reflect updated category
            });
        });
    </script>
@endpush
