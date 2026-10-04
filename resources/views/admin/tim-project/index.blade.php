@extends('layouts.admin')

@section('title', 'Tim Project')

@section('content')

<div class="content-card">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <div class="page-title">Tim Project</div>
            <small class="text-secondary">
                Kelola anggota project
            </small>
        </div>

        <button class="btn-orange"
                data-bs-toggle="modal"
                data-bs-target="#tambahTim">
            + Tambah Anggota
        </button>

    </div>

    <div class="table-responsive">

        <table class="table-custom">

            <thead>

                <tr>
                    <th>Project</th>
                    <th>Pegawai</th>
                    <th>Peran</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

            @forelse($timProjects as $tim)

                <tr>

                    <td>{{ $tim->project->nama_project ?? '-' }}</td>
                    <td>{{ $tim->pegawai->nama ?? '-' }}</td>
                    <td>{{ $tim->peran ?? '-' }}</td>

                    <td>

                        <button class="btn-dark-custom"
                                data-bs-toggle="modal"
                                data-bs-target="#editTim{{ $tim->id }}">
                            Ubah
                        </button>

                        <button class="btn-dark-custom"
                                data-bs-toggle="modal"
                                data-bs-target="#hapusTim{{ $tim->id }}">
                            Hapus
                        </button>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="4"
                        class="text-center text-secondary py-4">
                        Belum ada anggota tim.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- TAMBAH --}}

<div class="modal fade" id="tambahTim" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.tim-project.store') }}"
                  method="POST">

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">
                        Tambah Anggota Tim
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Project
                        </label>

                        <select name="project_id"
                                class="form-select"
                                required>

                            <option value="">
                                Pilih Project
                            </option>

                            @foreach($projects as $project)

                                <option value="{{ $project->id }}">
                                    {{ $project->nama_project }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Pegawai
                        </label>

                        <select name="pegawai_id"
                                class="form-select"
                                required>

                            <option value="">
                                Pilih Pegawai
                            </option>

                            @foreach($pegawais as $pegawai)

                                <option value="{{ $pegawai->id }}">
                                    {{ $pegawai->nama }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Peran
                        </label>

                        <input type="text"
                               name="peran"
                               class="form-control">

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


@foreach($timProjects as $tim)

{{-- EDIT --}}

<div class="modal fade"
     id="editTim{{ $tim->id }}"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.tim-project.update', $tim) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="modal-header">

                    <h5 class="modal-title">
                        Ubah Anggota Tim
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Project
                        </label>

                        <select name="project_id"
                                class="form-select"
                                required>

                            @foreach($projects as $project)

                                <option value="{{ $project->id }}"
                                    @selected($tim->project_id == $project->id)>
                                    {{ $project->nama_project }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Pegawai
                        </label>

                        <select name="pegawai_id"
                                class="form-select"
                                required>

                            @foreach($pegawais as $pegawai)

                                <option value="{{ $pegawai->id }}"
                                    @selected($tim->pegawai_id == $pegawai->id)>
                                    {{ $pegawai->nama }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Peran
                        </label>

                        <input type="text"
                               name="peran"
                               class="form-control"
                               value="{{ $tim->peran }}">

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
     id="hapusTim{{ $tim->id }}"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.tim-project.destroy', $tim) }}"
                  method="POST">

                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title">
                        Hapus Anggota
                    </h5>
                </div>

                <div class="modal-body">
                    Yakin ingin menghapus anggota ini?
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