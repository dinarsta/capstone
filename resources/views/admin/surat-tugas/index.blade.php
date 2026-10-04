@extends('layouts.admin')

@section('title', 'Bertugas')

@section('content')

<div class="content-card">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <div class="page-title">Bertugas</div>
            <small class="text-secondary">
                Kelola surat tugas pegawai
            </small>
        </div>

        <button class="btn-orange"
                data-bs-toggle="modal"
                data-bs-target="#tambahSurat">
            + Buat Surat Tugas
        </button>

    </div>

    <div class="table-responsive">

        <table class="table-custom">

            <thead>

                <tr>
                    <th>Nomor</th>
                    <th>Kegiatan</th>
                    <th>Pegawai</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

            @forelse($suratTugas as $surat)

                <tr>

                    <td>{{ $surat->nomor_surat }}</td>

                    <td>{{ $surat->kegiatan }}</td>

                    <td>{{ $surat->pegawai->nama ?? '-' }}</td>

                    <td>
                        {{ $surat->tanggal_mulai->format('d/m/Y') }}
                    </td>

                    <td>

                        <span class="status status-{{ $surat->status }}">
                            {{ ucfirst($surat->status) }}
                        </span>

                    </td>

                    <td>

                        <button class="btn-dark-custom"
                                data-bs-toggle="modal"
                                data-bs-target="#editSurat{{ $surat->id }}">
                            Ubah
                        </button>

                        @if(in_array($surat->status, ['draft','ditolak']))

                            <form action="{{ route('admin.surat-tugas.ajukan', $surat) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf

                                <button class="btn-orange">
                                    Ajukan
                                </button>

                            </form>

                        @endif

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6"
                        class="text-center text-secondary py-4">
                        Belum ada surat tugas.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- TAMBAH SURAT --}}

<div class="modal fade" id="tambahSurat" tabindex="-1">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.surat-tugas.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">
                        Buat Surat Tugas
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Nomor Surat
                            </label>

                            <input type="text"
                                   name="nomor_surat"
                                   class="form-control"
                                   required>

                        </div>

                        <div class="col-md-6 mb-3">

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
                                        {{ $pegawai->nama }} - {{ $pegawai->nip }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Kegiatan
                        </label>

                        <input type="text"
                               name="kegiatan"
                               class="form-control"
                               required>

                    </div>

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Instansi
                            </label>

                            <select name="instansi_id"
                                    class="form-select">

                                <option value="">
                                    Pilih
                                </option>

                                @foreach($instansi as $item)

                                    <option value="{{ $item->id }}">
                                        {{ $item->nama }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Lokasi
                            </label>

                            <select name="lokasi_id"
                                    class="form-select">

                                <option value="">
                                    Pilih
                                </option>

                                @foreach($lokasi as $item)

                                    <option value="{{ $item->id }}">
                                        {{ $item->nama }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Jenis Kegiatan
                            </label>

                            <select name="jenis_kegiatan_id"
                                    class="form-select">

                                <option value="">
                                    Pilih
                                </option>

                                @foreach($jenisKegiatan as $item)

                                    <option value="{{ $item->id }}">
                                        {{ $item->nama }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Tanggal Mulai
                            </label>

                            <input type="date"
                                   name="tanggal_mulai"
                                   class="form-control"
                                   required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Tanggal Selesai
                            </label>

                            <input type="date"
                                   name="tanggal_selesai"
                                   class="form-control">

                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Upload PDF
                        </label>

                        <input type="file"
                               name="dokumen_pdf"
                               class="form-control"
                               accept=".pdf"
                               required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Catatan
                        </label>

                        <textarea name="catatan"
                                  class="form-control"
                                  rows="3"></textarea>

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


{{-- EDIT SURAT --}}

@foreach($suratTugas as $surat)

@if(in_array($surat->status, ['draft','ditolak']))

<div class="modal fade"
     id="editSurat{{ $surat->id }}"
     tabindex="-1">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.surat-tugas.update', $surat) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="modal-header">

                    <h5 class="modal-title">
                        Ubah Surat Tugas
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Nomor Surat
                            </label>

                            <input type="text"
                                   name="nomor_surat"
                                   class="form-control"
                                   value="{{ $surat->nomor_surat }}"
                                   required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Pegawai
                            </label>

                            <select name="pegawai_id"
                                    class="form-select"
                                    required>

                                @foreach($pegawais as $pegawai)

                                    <option value="{{ $pegawai->id }}"
                                        @selected($surat->pegawai_id == $pegawai->id)>
                                        {{ $pegawai->nama }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Kegiatan
                        </label>

                        <input type="text"
                               name="kegiatan"
                               class="form-control"
                               value="{{ $surat->kegiatan }}"
                               required>

                    </div>

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Instansi
                            </label>

                            <select name="instansi_id"
                                    class="form-select">

                                <option value="">Pilih</option>

                                @foreach($instansi as $item)

                                    <option value="{{ $item->id }}"
                                        @selected($surat->instansi_id == $item->id)>
                                        {{ $item->nama }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Lokasi
                            </label>

                            <select name="lokasi_id"
                                    class="form-select">

                                <option value="">Pilih</option>

                                @foreach($lokasi as $item)

                                    <option value="{{ $item->id }}"
                                        @selected($surat->lokasi_id == $item->id)>
                                        {{ $item->nama }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Jenis Kegiatan
                            </label>

                            <select name="jenis_kegiatan_id"
                                    class="form-select">

                                <option value="">Pilih</option>

                                @foreach($jenisKegiatan as $item)

                                    <option value="{{ $item->id }}"
                                        @selected($surat->jenis_kegiatan_id == $item->id)>
                                        {{ $item->nama }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Tanggal Mulai
                            </label>

                            <input type="date"
                                   name="tanggal_mulai"
                                   class="form-control"
                                   value="{{ $surat->tanggal_mulai->format('Y-m-d') }}"
                                   required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Tanggal Selesai
                            </label>

                            <input type="date"
                                   name="tanggal_selesai"
                                   class="form-control"
                                   value="{{ $surat->tanggal_selesai?->format('Y-m-d') }}">

                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Ganti PDF
                        </label>

                        <input type="file"
                               name="dokumen_pdf"
                               class="form-control"
                               accept=".pdf">

                        @if($surat->dokumen_pdf)
                            <small class="text-secondary">
                                PDF sudah tersedia. Kosongkan jika tidak ingin mengganti.
                            </small>
                        @endif

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Catatan
                        </label>

                        <textarea name="catatan"
                                  class="form-control"
                                  rows="3">{{ $surat->catatan }}</textarea>

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

@endif

@endforeach

@endsection