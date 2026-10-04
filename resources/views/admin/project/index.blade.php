@extends('layouts.admin')

@section('title', 'Project')

@section('content')

<div class="content-card">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <div class="page-title">Project</div>
            <small class="text-secondary">
                Kelola project
            </small>
        </div>

        <button class="btn-orange"
                data-bs-toggle="modal"
                data-bs-target="#tambahProject">
            + Tambah Project
        </button>

    </div>

    <div class="table-responsive">

        <table class="table-custom">

            <thead>
                <tr>
                    <th>Project</th>
                    <th>Periode</th>
                    <th>Progress</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            @forelse($projects as $project)

                <tr>

                    <td>{{ $project->nama_project }}</td>

                    <td>
                        {{ $project->tanggal_mulai ? \Carbon\Carbon::parse($project->tanggal_mulai)->format('d/m/Y') : '-' }}
                        -
                        {{ $project->tanggal_selesai ? \Carbon\Carbon::parse($project->tanggal_selesai)->format('d/m/Y') : '-' }}
                    </td>

                    <td style="min-width:160px">

                        {{ $project->progress }}%

                        <div class="progress mt-1"
                             style="height:5px;background:#263545">

                            <div class="progress-bar"
                                 style="width:{{ $project->progress }}%;background:#ffb52e">
                            </div>

                        </div>

                    </td>

                    <td>{{ ucfirst($project->status) }}</td>

                    <td>

                        <button class="btn-dark-custom"
                                data-bs-toggle="modal"
                                data-bs-target="#editProject{{ $project->id }}">
                            Ubah
                        </button>

                        <button class="btn-dark-custom"
                                data-bs-toggle="modal"
                                data-bs-target="#hapusProject{{ $project->id }}">
                            Hapus
                        </button>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="5"
                        class="text-center text-secondary py-4">
                        Belum ada project.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- TAMBAH --}}

<div class="modal fade" id="tambahProject" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.project.store') }}" method="POST">

                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Project</h5>
                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Nama Project
                        </label>

                        <input type="text"
                               name="nama_project"
                               class="form-control"
                               required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Deskripsi
                        </label>

                        <textarea name="deskripsi"
                                  class="form-control"
                                  rows="3"></textarea>

                    </div>

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Mulai</label>
                            <input type="date"
                                   name="tanggal_mulai"
                                   class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Selesai</label>
                            <input type="date"
                                   name="tanggal_selesai"
                                   class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Progress</label>
                            <input type="number"
                                   name="progress"
                                   class="form-control"
                                   min="0"
                                   max="100"
                                   value="0">
                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select name="status"
                                class="form-select">

                            <option value="berjalan">Berjalan</option>
                            <option value="selesai">Selesai</option>
                            <option value="ditunda">Ditunda</option>

                        </select>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn-dark-custom"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button class="btn-orange">
                        Tambah
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


@foreach($projects as $project)

{{-- EDIT --}}

<div class="modal fade"
     id="editProject{{ $project->id }}"
     tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.project.update', $project) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="modal-header">

                    <h5 class="modal-title">
                        Ubah Project
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Nama Project
                        </label>

                        <input type="text"
                               name="nama_project"
                               class="form-control"
                               value="{{ $project->nama_project }}"
                               required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Deskripsi
                        </label>

                        <textarea name="deskripsi"
                                  class="form-control"
                                  rows="3">{{ $project->deskripsi }}</textarea>

                    </div>

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Mulai
                            </label>

                            <input type="date"
                                   name="tanggal_mulai"
                                   class="form-control"
                                   value="{{ $project->tanggal_mulai }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Selesai
                            </label>

                            <input type="date"
                                   name="tanggal_selesai"
                                   class="form-control"
                                   value="{{ $project->tanggal_selesai }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Progress
                            </label>

                            <input type="number"
                                   name="progress"
                                   class="form-control"
                                   min="0"
                                   max="100"
                                   value="{{ $project->progress }}">

                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select name="status"
                                class="form-select">

                            <option value="berjalan"
                                @selected($project->status == 'berjalan')>
                                Berjalan
                            </option>

                            <option value="selesai"
                                @selected($project->status == 'selesai')>
                                Selesai
                            </option>

                            <option value="ditunda"
                                @selected($project->status == 'ditunda')>
                                Ditunda
                            </option>

                        </select>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn-dark-custom"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button class="btn-orange">
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- DELETE --}}

<div class="modal fade"
     id="hapusProject{{ $project->id }}"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.project.destroy', $project) }}"
                  method="POST">

                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title">Hapus Project</h5>
                </div>

                <div class="modal-body">
                    Yakin ingin menghapus
                    <strong>{{ $project->nama_project }}</strong>?
                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn-dark-custom"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button class="btn btn-danger">
                        Hapus
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endforeach

@endsection