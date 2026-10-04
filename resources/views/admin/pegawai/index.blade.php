@extends('layouts.admin')

@section('title', 'Pegawai')

@section('content')

<div class="content-card">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <div class="page-title">Pegawai</div>
            <small class="text-secondary">
                Data master pegawai
            </small>
        </div>

        <button class="btn-orange"
                data-bs-toggle="modal"
                data-bs-target="#tambahPegawai">
            + Tambah Pegawai
        </button>

    </div>

    <div class="table-responsive">

        <table class="table-custom">

            <thead>
                <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Unit Kerja</th>
                    <th>Pangkat</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            @forelse($pegawais as $pegawai)

                <tr>

                    <td>{{ $pegawai->nip }}</td>
                    <td>{{ $pegawai->nama }}</td>
                    <td>{{ $pegawai->jabatan ?? '-' }}</td>
                    <td>{{ $pegawai->unit_kerja ?? '-' }}</td>
                    <td>{{ $pegawai->pangkat ?? '-' }}</td>

                    <td>

                        <button class="btn-dark-custom"
                                data-bs-toggle="modal"
                                data-bs-target="#editPegawai{{ $pegawai->id }}">
                            Ubah
                        </button>

                        <button class="btn-dark-custom"
                                data-bs-toggle="modal"
                                data-bs-target="#hapusPegawai{{ $pegawai->id }}">
                            Hapus
                        </button>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6"
                        class="text-center text-secondary py-4">
                        Belum ada data pegawai.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- TAMBAH --}}

<div class="modal fade" id="tambahPegawai" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.pegawai.store') }}" method="POST">

                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pegawai</h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">NIP</label>
                            <input type="text"
                                   name="nip"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text"
                                   name="nama"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jabatan</label>
                            <input type="text"
                                   name="jabatan"
                                   class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Unit Kerja</label>
                            <input type="text"
                                   name="unit_kerja"
                                   class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pangkat</label>
                            <input type="text"
                                   name="pangkat"
                                   class="form-control">
                        </div>

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


@foreach($pegawais as $pegawai)

{{-- EDIT --}}

<div class="modal fade"
     id="editPegawai{{ $pegawai->id }}"
     tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.pegawai.update', $pegawai) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="modal-header">

                    <h5 class="modal-title">
                        Ubah Pegawai
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">NIP</label>

                            <input type="text"
                                   name="nip"
                                   class="form-control"
                                   value="{{ $pegawai->nip }}"
                                   required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Nama</label>

                            <input type="text"
                                   name="nama"
                                   class="form-control"
                                   value="{{ $pegawai->nama }}"
                                   required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Jabatan</label>

                            <input type="text"
                                   name="jabatan"
                                   class="form-control"
                                   value="{{ $pegawai->jabatan }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Unit Kerja</label>

                            <input type="text"
                                   name="unit_kerja"
                                   class="form-control"
                                   value="{{ $pegawai->unit_kerja }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Pangkat</label>

                            <input type="text"
                                   name="pangkat"
                                   class="form-control"
                                   value="{{ $pegawai->pangkat }}">

                        </div>

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
     id="hapusPegawai{{ $pegawai->id }}"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.pegawai.destroy', $pegawai) }}"
                  method="POST">

                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title">Hapus Pegawai</h5>
                </div>

                <div class="modal-body">
                    Yakin ingin menghapus
                    <strong>{{ $pegawai->nama }}</strong>?
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