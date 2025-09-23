@extends('backend.layouts.main')

@section('title', 'Edit Profil Organisasi')
@section('page-title', 'Edit Profil Organisasi')

@section('breadcrumb')
    <li class="breadcrumb-item">Profil Organisasi</li>
    <li class="breadcrumb-item"><a href="{{ route('backend.organization-profile.admin.index') }}">Kelola Profil</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@push('styles')
    <style>
        .image-preview {
            max-width: 200px;
            max-height: 200px;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 5px;
            object-fit: cover;
        }

        .content-preview {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            background-color: #f8f9fa;
            min-height: 100px;
        }

        .readonly-field {
            background-color: #f8f9fa;
            cursor: not-allowed;
        }

        .permanent-info {
            background-color: #e3f2fd;
            border: 1px solid #bbdefb;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        input.form-control.readonly-field[readonly] {
            background-color: #ced4da !important;
            /* abu-abu lebih pekat */
            color: #212529 !important;
            border: 1px solid #adb5bd !important;
            cursor: not-allowed;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Halaman: {{ $profile->title }}</h5>



                    <form action="{{ route('backend.organization-profile.update', $profile->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-8">
                                <!-- Readonly Title Field -->
                                <div class="mb-4">
                                    <label for="title" class="form-label modern">
                                        Judul Halaman
                                        <span class="info-badge ms-2">PERMANEN</span>
                                    </label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control modern readonly-field bg-light text-dark"
                                            id="title" value="{{ $profile->title }}" readonly>
                                        <i class="bi bi-lock position-absolute icon-lock"
                                            style="right: 15px; top: 50%; transform: translateY(-50%);"></i>
                                    </div>

                                    <small class="text-muted">Judul ini tidak dapat diubah untuk menjaga konsistensi
                                        sistem</small>
                                    <input type="hidden" name="title" value="{{ $profile->title }}">
                                </div>


                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi Singkat</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                        rows="3" placeholder="Deskripsi singkat untuk halaman ini">{{ old('description', $profile->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label">Konten</label>
                                    <textarea class="form-control tinymce-editor @error('content') is-invalid @enderror" id="content" name="content">{{ old('content', $profile->content) }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- SEO Section -->
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">SEO Settings</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="meta_title" class="form-label">Meta Title</label>
                                            <input type="text"
                                                class="form-control @error('meta_title') is-invalid @enderror"
                                                id="meta_title" name="meta_title"
                                                value="{{ old('meta_title', $profile->meta_title) }}"
                                                placeholder="Jika kosong akan menggunakan judul halaman">
                                            @error('meta_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="meta_description" class="form-label">Meta Description</label>
                                            <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description"
                                                name="meta_description" rows="3" placeholder="Deskripsi untuk search engine (maksimal 160 karakter)">{{ old('meta_description', $profile->meta_description) }}</textarea>
                                            @error('meta_description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">
                                                <span id="meta-description-count">0</span>/160 karakter
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Pengaturan Publish</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="is_active"
                                                    name="is_active" value="1"
                                                    {{ old('is_active', $profile->is_active) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_active">
                                                    Status Aktif
                                                </label>
                                            </div>
                                            <small class="text-muted">Centang untuk menampilkan halaman ini di
                                                website</small>
                                        </div>

                                        {{-- <div class="mb-3">
                                            <label for="sort_order" class="form-label">Urutan Tampil</label>
                                            <input type="number"
                                                class="form-control @error('sort_order') is-invalid @enderror"
                                                id="sort_order" name="sort_order"
                                                value="{{ old('sort_order', $profile->sort_order) }}" min="0">
                                            @error('sort_order')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Semakin kecil angka, semakin atas urutannya</small>
                                        </div> --}}

                                        <hr>

                                        <div class="mb-3">
                                            <label for="image" class="form-label">Gambar Header</label>
                                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                                id="image" name="image" accept="image/*"
                                                onchange="previewImage(event)">
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                                        </div>

                                        @if ($profile->image)
                                            <div class="mb-3">
                                                <label class="form-label">Gambar Saat Ini:</label><br>
                                                <img src="{{ asset('storage/' . $profile->image) }}" alt="Current Image"
                                                    class="image-preview" id="currentImage">
                                            </div>
                                        @endif

                                        <div id="imagePreviewContainer" style="display: none;">
                                            <label class="form-label">Preview Gambar Baru:</label><br>
                                            <img id="imagePreview" class="image-preview" alt="Image Preview">
                                        </div>

                                        <hr>

                                        <div class="mb-3">
                                            <label class="form-label">Info Halaman:</label>
                                            <ul class="list-unstyled small text-muted">
                                                <li><strong>Slug:</strong>
                                                    <code>{{ $profile->slug }}</code>
                                                    <i class="bi bi-lock text-muted ms-1" title="Slug permanen"></i>
                                                </li>
                                                <li><strong>Dibuat:</strong>
                                                    {{ $profile->created_at->format('d/m/Y H:i') }}</li>
                                                <li><strong>Terakhir Update:</strong>
                                                    {{ $profile->updated_at->format('d/m/Y H:i') }}</li>
                                            </ul>

                                            <!-- Hidden input untuk slug -->
                                            <input type="hidden" name="slug" value="{{ $profile->slug }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('backend.organization-profile.admin.index') }}"
                                        class="btn btn-secondary">
                                        <i class="bi bi-arrow-left"></i> Kembali
                                    </a>
                                    <div>
                                        <a href="{{ route('backend.organization-profile.show', $profile->id) }}"
                                            class="btn btn-info me-2">
                                            <i class="bi bi-eye"></i> Preview
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-lg"></i> Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Initialize TinyMCE
        tinymce.init({
            selector: '.tinymce-editor',
            height: 500,
            menubar: false,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
                'bold italic forecolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_css: '{{ asset('backend/assets/css/tinymce-content.css') }}',
            branding: false,
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            }
        });

        // Image preview function
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                    document.getElementById('imagePreviewContainer').style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                document.getElementById('imagePreviewContainer').style.display = 'none';
            }
        }

        // Meta description character counter
        document.getElementById('meta_description').addEventListener('input', function() {
            const count = this.value.length;
            document.getElementById('meta-description-count').textContent = count;

            if (count > 160) {
                document.getElementById('meta-description-count').style.color = '#dc3545';
            } else {
                document.getElementById('meta-description-count').style.color = '#6c757d';
            }
        });

        // Initial count
        document.addEventListener('DOMContentLoaded', function() {
            const metaDesc = document.getElementById('meta_description');
            document.getElementById('meta-description-count').textContent = metaDesc.value.length;
        });
    </script>
@endpush
