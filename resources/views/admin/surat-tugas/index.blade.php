@extends('layouts.admin')

@section('title', 'Bertugas')

@section('content')

<div class="content-card">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <div class="page-title">
                Bertugas
            </div>

            <small class="text-secondary">
                Kelola surat tugas pegawai
            </small>
        </div>

        <button class="btn-orange" data-bs-toggle="modal" data-bs-target="#tambahSurat">

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
                    <th>Catatan Pimpinan</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($suratTugas as $surat)

                <tr>

                    <td>
                        {{ $surat->nomor_surat }}
                    </td>

                    <td>
                        {{ $surat->kegiatan }}
                    </td>

                    <td>
                        {{ $surat->pegawai->nama ?? '-' }}
                    </td>

                    <td>

                        @if($surat->tanggal_mulai)

                        {{ $surat->tanggal_mulai->format('d/m/Y') }}

                        @else

                        -

                        @endif

                        @if($surat->tanggal_selesai)

                        <br>

                        <small class="text-secondary">
                            s/d {{ $surat->tanggal_selesai->format('d/m/Y') }}
                        </small>

                        @endif

                    </td>

                    <td>

                        <span class="status status-{{ $surat->status }}">
                            {{ ucfirst($surat->status) }}
                        </span>

                    </td>

                    <td>

                        @if($surat->catatan)

                        <span title="{{ $surat->catatan }}">
                            {{ \Illuminate\Support\Str::limit($surat->catatan, 60) }}
                        </span>

                        @else

                        <span class="text-secondary">
                            -
                        </span>

                        @endif

                    </td>

                    <td>

                        <div class="d-flex align-items-center gap-2">

                            {{-- PDF SUDAH ADA --}}

                            @if($surat->dokumen_pdf)

                            <a href="{{ asset('storage/' . $surat->dokumen_pdf) }}" target="_blank"
                                class="btn-dark-custom text-decoration-none">

                                PDF

                            </a>

                            @else

                            {{-- PDF BELUM ADA --}}

                            @if(in_array($surat->status, ['draft', 'ditolak']))

                            <button type="button" class="btn-orange" data-bs-toggle="modal"
                                data-bs-target="#updatePdf{{ $surat->id }}">

                                Update

                            </button>

                            @endif

                            @endif


                            {{-- AJUKAN HANYA JIKA PDF SUDAH ADA --}}

                            @if(
                            in_array($surat->status, ['draft', 'ditolak'])
                            && $surat->dokumen_pdf
                            )

                            <form action="{{ route('admin.surat-tugas.ajukan', $surat) }}" method="POST" class="m-0">

                                @csrf

                                <button type="submit" class="btn-orange">

                                    Ajukan

                                </button>

                            </form>

                            @endif

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7" class="text-center text-secondary py-4">

                        Belum ada surat tugas.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>



{{-- ========================================================= --}}
{{-- MODAL TAMBAH SURAT TUGAS --}}
{{-- ========================================================= --}}

<div class="modal fade" id="tambahSurat" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.surat-tugas.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">
                        Buat Surat Tugas
                    </h5>

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal">
                    </button>

                </div>


                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Nomor Surat
                            </label>

                            <input type="text" name="nomor_surat" class="form-control" required>

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Pegawai
                            </label>

                            <select name="pegawai_id" class="form-select" required>

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

                        <input type="text" name="kegiatan" class="form-control" required>

                    </div>


                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Instansi
                            </label>

                            <select name="instansi_id" class="form-select">

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

                            <select name="lokasi_id" class="form-select">

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

                            <select name="jenis_kegiatan_id" class="form-select">

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

                            <input type="date" name="tanggal_mulai" class="form-control" required>

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Tanggal Selesai
                            </label>

                            <input type="date" name="tanggal_selesai" class="form-control">

                        </div>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Upload PDF
                        </label>

                        <input type="file" name="dokumen_pdf" class="form-control" accept=".pdf" required>

                        <small class="text-secondary">
                            Format PDF, maksimal 10 MB.
                        </small>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Catatan
                        </label>

                        <textarea name="catatan" class="form-control" rows="3"></textarea>

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="button" class="btn-dark-custom" data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button type="submit" class="btn-orange">

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>



{{-- ========================================================= --}}
{{-- MODAL UPDATE PDF --}}
{{-- ========================================================= --}}

@foreach($suratTugas as $surat)

@if(
!$surat->dokumen_pdf &&
in_array($surat->status, ['draft', 'ditolak'])
)

<div class="modal fade" id="updatePdf{{ $surat->id }}" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.surat-tugas.update', $surat) }}" method="POST" enctype="multipart/form-data">

                @csrf

                @method('PUT')


                <div class="modal-header">

                    <h5 class="modal-title">
                        Update Surat Tugas
                    </h5>

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal">
                    </button>

                </div>


                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Nomor Surat
                        </label>

                        <input type="text" class="form-control" value="{{ $surat->nomor_surat }}" disabled>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Kegiatan
                        </label>

                        <input type="text" class="form-control" value="{{ $surat->kegiatan }}" disabled>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Upload PDF
                        </label>

                        <input type="file" name="dokumen_pdf" class="form-control" accept=".pdf" required>

                        <small class="text-secondary">
                            Format PDF, maksimal 10 MB.
                        </small>

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="button" class="btn-dark-custom" data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button type="submit" class="btn-orange">

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