@extends('layouts.admin')

@section('title', 'Agenda')

@section('content')

<div class="content-card">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <div class="page-title">Agenda</div>
            <small class="text-secondary">
                Kelola agenda dan kegiatan
            </small>
        </div>

        <button class="btn-orange"
                data-bs-toggle="modal"
                data-bs-target="#tambahAgenda">
            + Tambah Agenda
        </button>

    </div>

    <div class="table-responsive">

        <table class="table-custom">

            <thead>
                <tr>
                    <th>Kegiatan</th>
                    <th>Instansi</th>
                    <th>Waktu</th>
                    <th>Lokasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            @forelse($agendas as $agenda)

                <tr>

                    <td>{{ $agenda->judul }}</td>

                    <td>{{ $agenda->deskripsi ?? '-' }}</td>

                    <td>
                        {{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('D, d M Y') }}

                        @if($agenda->waktu)
                            <br>
                            {{ $agenda->waktu }}
                        @endif
                    </td>

                    <td>{{ $agenda->lokasi ?? '-' }}</td>

                    <td>

                        <div class="d-flex gap-2">

                            <button class="btn-dark-custom"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editAgenda{{ $agenda->id }}">
                                Ubah
                            </button>

                            <button class="btn-dark-custom"
                                    data-bs-toggle="modal"
                                    data-bs-target="#hapusAgenda{{ $agenda->id }}">
                                Hapus
                            </button>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="5" class="text-center text-secondary py-4">
                        Belum ada agenda.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- TAMBAH --}}

<div class="modal fade" id="tambahAgenda" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.agenda.store') }}" method="POST">

                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Agenda</h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Kegiatan</label>
                        <input type="text"
                               name="judul"
                               class="form-control"
                               required>
                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Instansi</label>
                            <input type="text"
                                   name="deskripsi"
                                   class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Lokasi</label>
                            <input type="text"
                                   name="lokasi"
                                   class="form-control">
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date"
                                   name="tanggal"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Waktu</label>
                            <input type="time"
                                   name="waktu"
                                   class="form-control">
                        </div>

                    </div>

                    <input type="hidden" name="status" value="aktif">

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


{{-- EDIT + DELETE --}}

@foreach($agendas as $agenda)

<div class="modal fade"
     id="editAgenda{{ $agenda->id }}"
     tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.agenda.update', $agenda) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="modal-header">

                    <h5 class="modal-title">
                        Ubah Agenda
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Kegiatan
                        </label>

                        <input type="text"
                               name="judul"
                               class="form-control"
                               value="{{ $agenda->judul }}"
                               required>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Instansi
                            </label>

                            <input type="text"
                                   name="deskripsi"
                                   class="form-control"
                                   value="{{ $agenda->deskripsi }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Lokasi
                            </label>

                            <input type="text"
                                   name="lokasi"
                                   class="form-control"
                                   value="{{ $agenda->lokasi }}">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Tanggal
                            </label>

                            <input type="date"
                                   name="tanggal"
                                   class="form-control"
                                   value="{{ $agenda->tanggal }}"
                                   required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Waktu
                            </label>

                            <input type="time"
                                   name="waktu"
                                   class="form-control"
                                   value="{{ $agenda->waktu }}">

                        </div>

                    </div>

                    <input type="hidden"
                           name="status"
                           value="{{ $agenda->status }}">

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


<div class="modal fade"
     id="hapusAgenda{{ $agenda->id }}"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.agenda.destroy', $agenda) }}"
                  method="POST">

                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title">
                        Hapus Agenda
                    </h5>
                </div>

                <div class="modal-body">

                    Yakin ingin menghapus
                    <strong>{{ $agenda->judul }}</strong>?

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