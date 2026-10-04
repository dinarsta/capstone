@extends('layouts.admin')

@section('title', 'Master Data')

@section('content')

<div class="content-card">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <div class="page-title">Master Data</div>
            <small class="text-secondary">
                Kelola data dropdown sistem
            </small>
        </div>

        <button class="btn-orange"
                data-bs-toggle="modal"
                data-bs-target="#tambahMaster">
            + Tambah Data
        </button>

    </div>

    <div class="table-responsive">

        <table class="table-custom">

            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            @forelse($masters as $master)

                <tr>

                    <td>{{ $master->kategori }}</td>

                    <td>{{ $master->nama }}</td>

                    <td>
                        @if($master->aktif)
                            <span class="status status-disetujui">
                                Aktif
                            </span>
                        @else
                            <span class="status status-ditolak">
                                Nonaktif
                            </span>
                        @endif
                    </td>

                    <td>

                        <button class="btn-dark-custom"
                                data-bs-toggle="modal"
                                data-bs-target="#editMaster{{ $master->id }}">
                            Ubah
                        </button>

                        <button class="btn-dark-custom"
                                data-bs-toggle="modal"
                                data-bs-target="#hapusMaster{{ $master->id }}">
                            Hapus
                        </button>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="4"
                        class="text-center text-secondary py-4">
                        Belum ada master data.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- TAMBAH --}}

<div class="modal fade" id="tambahMaster" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.master-model.store') }}"
                  method="POST">

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">
                        Tambah Master Data
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Kategori
                        </label>

                        <select name="kategori"
                                class="form-select"
                                required>

                            <option value="">
                                Pilih Kategori
                            </option>

                            <option value="instansi">
                                Instansi
                            </option>

                            <option value="lokasi">
                                Lokasi
                            </option>

                            <option value="jenis_kegiatan">
                                Jenis Kegiatan
                            </option>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Nama
                        </label>

                        <input type="text"
                               name="nama"
                               class="form-control"
                               required>

                    </div>

                    <div class="form-check">

                        <input type="checkbox"
                               name="aktif"
                               value="1"
                               class="form-check-input"
                               checked>

                        <label class="form-check-label">
                            Aktif
                        </label>

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


@foreach($masters as $master)

{{-- EDIT --}}

<div class="modal fade"
     id="editMaster{{ $master->id }}"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.master-model.update', $master) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="modal-header">

                    <h5 class="modal-title">
                        Ubah Master Data
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Kategori
                        </label>

                        <select name="kategori"
                                class="form-select"
                                required>

                            <option value="instansi"
                                @selected($master->kategori == 'instansi')>
                                Instansi
                            </option>

                            <option value="lokasi"
                                @selected($master->kategori == 'lokasi')>
                                Lokasi
                            </option>

                            <option value="jenis_kegiatan"
                                @selected($master->kategori == 'jenis_kegiatan')>
                                Jenis Kegiatan
                            </option>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Nama
                        </label>

                        <input type="text"
                               name="nama"
                               class="form-control"
                               value="{{ $master->nama }}"
                               required>

                    </div>

                    <div class="form-check">

                        <input type="checkbox"
                               name="aktif"
                               value="1"
                               class="form-check-input"
                               @checked($master->aktif)>

                        <label class="form-check-label">
                            Aktif
                        </label>

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
     id="hapusMaster{{ $master->id }}"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.master-model.destroy', $master) }}"
                  method="POST">

                @csrf
                @method('DELETE')

                <div class="modal-header">

                    <h5 class="modal-title">
                        Hapus Data
                    </h5>

                </div>

                <div class="modal-body">

                    Yakin ingin menghapus
                    <strong>{{ $master->nama }}</strong>?

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