@extends('backend.layouts.main')

@section('title', 'Kelola Profil Organisasi')
@section('page-title', 'Kelola Profil Organisasi')

@section('breadcrumb')
    <li class="breadcrumb-item">Profil Organisasi</li>
    <li class="breadcrumb-item active">Kelola Profil</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Halaman Profil Organisasi</h5>

                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    {{-- <th>Urutan</th> --}}
                                    <th>Terakhir Update</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($profiles as $key => $profile)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $profile->title }}</td>
                                        <td><code>{{ $profile->slug }}</code></td>
                                        <td>
                                            @if ($profile->is_active)
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-secondary">Non-aktif</span>
                                            @endif
                                        </td>
                                        {{-- <td>{{ $profile->sort_order }}</td> --}}
                                        <td>{{ $profile->updated_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('backend.organization-profile.show', $profile->id) }}"
                                                    class="btn btn-sm btn-info" title="Lihat">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('backend.organization-profile.edit', $profile->id) }}"
                                                    class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data profil organisasi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
