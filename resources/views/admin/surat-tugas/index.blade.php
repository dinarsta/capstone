@extends('layouts.admin')

@section('title', 'Bertugas')

@section('content')

<div class="content-card">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <div class="page-title">Bertugas</div>
            <small class="text-secondary">Kelola surat tugas pegawai</small>
        </div>

        <button type="button" class="btn-orange" data-bs-toggle="modal" data-bs-target="#tambahSurat">
            + Buat Surat Tugas
        </button>
    </div>

    {{-- TABEL SURAT TUGAS --}}
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
                    <td>{{ $surat->nomor_surat }}</td>

                    <td>{{ $surat->kegiatan }}</td>

                    <td>{{ $surat->pegawai->nama ?? '-' }}</td>

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
                        <span class="text-secondary">-</span>
                        @endif
                    </td>

                    <td>
                        <div class="d-flex align-items-center gap-2 flex-wrap">

                            {{-- LIHAT PDF --}}
                            @if($surat->dokumen_pdf)
                            <a href="{{ asset('surat-tugas/' . $surat->dokumen_pdf) }}" target="_blank"
                                rel="noopener noreferrer" class="btn-dark-custom text-decoration-none">
                                PDF
                            </a>
                            @endif

                            {{-- UPDATE PDF --}}
                            @if(in_array($surat->status, ['draft', 'ditolak']))
                            <button type="button" class="btn-orange" data-bs-toggle="modal"
                                data-bs-target="#updatePdf{{ $surat->id }}">
                                Update
                            </button>
                            @endif

                            {{-- AJUKAN --}}
                            @if(in_array($surat->status, ['draft', 'ditolak']) && $surat->dokumen_pdf)
                            <button type="button" class="btn-orange" data-bs-toggle="modal"
                                data-bs-target="#konfirmasiAjukan{{ $surat->id }}">
                                Ajukan
                            </button>
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


{{-- ====================================================== --}}
{{-- MODAL NOTIFIKASI SUKSES --}}
{{-- ====================================================== --}}

@if(session('success'))
<div class="modal fade" id="modalSukses" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Berhasil</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center py-4">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 55px;"></i>

                <p class="mt-3 mb-0">{{ session('success') }}</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-orange" data-bs-dismiss="modal">
                    Mengerti
                </button>
            </div>

        </div>
    </div>
</div>
@endif


{{-- ====================================================== --}}
{{-- MODAL NOTIFIKASI ERROR --}}
{{-- ====================================================== --}}

@if(session('error'))
<div class="modal fade" id="modalError" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Terjadi Kesalahan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center py-4">
                <i class="bi bi-x-circle-fill text-danger" style="font-size: 55px;"></i>

                <p class="mt-3 mb-0">{{ session('error') }}</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-orange" data-bs-dismiss="modal">
                    Mengerti
                </button>
            </div>

        </div>
    </div>
</div>
@endif


{{-- ====================================================== --}}
{{-- MODAL VALIDASI --}}
{{-- ====================================================== --}}

@if($errors->any())
<div class="modal fade" id="modalValidasi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Periksa Kembali Data</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="text-center mb-3">
                    <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 50px;"></i>

                    <p class="mt-2 mb-0">
                        Data belum dapat diproses. Silakan periksa kesalahan berikut.
                    </p>
                </div>

                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                    <li class="mb-1">{{ $error }}</li>
                    @endforeach
                </ul>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn-orange" data-bs-dismiss="modal">
                    Mengerti
                </button>
            </div>

        </div>
    </div>
</div>
@endif


{{-- ====================================================== --}}
{{-- MODAL TAMBAH SURAT TUGAS --}}
{{-- ====================================================== --}}

<div class="modal fade" id="tambahSurat" tabindex="-1" aria-labelledby="judulTambahSurat" aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <form action="{{ route('admin.surat-tugas.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="judulTambahSurat">
                        Buat Surat Tugas
                    </h5>

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        {{-- NOMOR SURAT --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nomor Surat</label>
                            <input type="text" name="nomor_surat" class="form-control" value="{{ old('nomor_surat') }}"
                                placeholder="Contoh: ST/008/2026" required>
                        </div>

                        {{-- PEGAWAI --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pegawai</label>

                            <select name="pegawai_id" class="form-select" required>
                                <option value="">Pilih Pegawai</option>

                                @foreach($pegawais as $pegawai)
                                <option value="{{ $pegawai->id }}"
                                    {{ old('pegawai_id') == $pegawai->id ? 'selected' : '' }}>
                                    {{ $pegawai->nama }} - {{ $pegawai->nip }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    {{-- KEGIATAN --}}
                    <div class="mb-3">
                        <label class="form-label">Kegiatan</label>
                        <input type="text" name="kegiatan" class="form-control" value="{{ old('kegiatan') }}"
                            placeholder="Masukkan nama kegiatan" required>
                    </div>

                    <div class="row">

                        {{-- INSTANSI --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Instansi</label>
                            <input type="text" name="instansi" class="form-control" value="{{ old('instansi') }}"
                                placeholder="Masukkan nama instansi" required>
                        </div>

                        {{-- LOKASI --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Lokasi</label>
                            <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi') }}"
                                placeholder="Masukkan lokasi kegiatan" required>
                        </div>

                        {{-- JENIS KEGIATAN --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Jenis Kegiatan</label>
                            <input type="text" name="jenis_kegiatan" class="form-control"
                                value="{{ old('jenis_kegiatan') }}" placeholder="Masukkan jenis kegiatan" required>
                        </div>

                    </div>

                    <div class="row">

                        {{-- TANGGAL MULAI --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="form-control"
                                value="{{ old('tanggal_mulai') }}" required>
                        </div>

                        {{-- TANGGAL SELESAI --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control"
                                value="{{ old('tanggal_selesai') }}">
                        </div>

                    </div>

                    {{-- PDF --}}
                    <div class="mb-3">
                        <label class="form-label">Upload PDF</label>
                        <input type="file" name="dokumen_pdf" class="form-control" accept=".pdf,application/pdf"
                            required>

                        <small class="text-secondary">
                            Format PDF, maksimal 10 MB.
                        </small>
                    </div>

                    {{-- CATATAN --}}
                    <div class="mb-3">
                        <label class="form-label">Catatan</label>
                        <textarea name="catatan" class="form-control" rows="3"
                            placeholder="Masukkan catatan (opsional)">{{ old('catatan') }}</textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-dark-custom" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit" class="btn-orange">
                        Simpan Surat Tugas
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


{{-- ====================================================== --}}
{{-- MODAL UPDATE PDF --}}
{{-- ====================================================== --}}

@foreach($suratTugas as $surat)

@if(in_array($surat->status, ['draft', 'ditolak']))

<div class="modal fade" id="updatePdf{{ $surat->id }}" tabindex="-1" aria-labelledby="judulUpdate{{ $surat->id }}"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('admin.surat-tugas.update', $surat) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="judulUpdate{{ $surat->id }}">
                        Update Surat Tugas
                    </h5>

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    {{-- NOMOR SURAT --}}
                    <div class="mb-3">
                        <label class="form-label">Nomor Surat</label>
                        <input type="text" class="form-control" value="{{ $surat->nomor_surat }}"
                            style="color: #000 !important; background-color: #f8f9fa;" disabled>
                    </div>

                    {{-- KEGIATAN --}}
                    <div class="mb-3">
                        <label class="form-label">Kegiatan</label>
                        <input type="text" class="form-control" value="{{ $surat->kegiatan }}"
                            style="color: #000 !important; background-color: #f8f9fa;" disabled>
                    </div>

                    {{-- PDF SAAT INI --}}
                    @if($surat->dokumen_pdf)
                    <div class="mb-3">
                        <label class="form-label">PDF Saat Ini</label>

                        <div>
                            <a href="{{ asset('surat-tugas/' . $surat->dokumen_pdf) }}" target="_blank"
                                rel="noopener noreferrer" class="btn btn-sm btn-outline-danger">

                                <i class="bi bi-file-earmark-pdf"></i>
                                Lihat PDF Saat Ini
                            </a>
                        </div>
                    </div>
                    @endif

                    {{-- UPLOAD PDF BARU --}}
                    <div class="mb-3">
                        <label class="form-label">
                            {{ $surat->dokumen_pdf ? 'Ganti Dokumen PDF' : 'Upload Dokumen PDF' }}
                        </label>

                        <input type="file" name="dokumen_pdf" class="form-control" accept=".pdf,application/pdf"
                            required>

                        <small class="text-secondary">
                            Format PDF, maksimal 10 MB.
                            PDF lama akan diganti setelah berhasil disimpan.
                        </small>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-dark-custom" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit" class="btn-orange">
                        <i class="bi bi-save"></i>
                        Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- MODAL KONFIRMASI AJUKAN --}}
@if($surat->dokumen_pdf)
<div class="modal fade" id="konfirmasiAjukan{{ $surat->id }}" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Pengajuan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center py-4">
                <i class="bi bi-send-check text-warning" style="font-size: 50px;"></i>

                <p class="mt-3 mb-1">
                    Yakin ingin mengajukan surat tugas ini?
                </p>

                <strong>{{ $surat->nomor_surat }}</strong>
                <p class="text-secondary mb-0">
                    {{ $surat->kegiatan }}
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-dark-custom" data-bs-dismiss="modal">
                    Batal
                </button>

                <form action="{{ route('admin.surat-tugas.ajukan', $surat) }}" method="POST" class="m-0">
                    @csrf

                    <button type="submit" class="btn-orange">
                        Ya, Ajukan
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endif

@endif

@endforeach


{{-- ====================================================== --}}
{{-- JAVASCRIPT MODAL NOTIFIKASI --}}
{{-- ====================================================== --}}

<script>
document.addEventListener('DOMContentLoaded', function() {

    const modalSukses = document.getElementById('modalSukses');
    const modalError = document.getElementById('modalError');
    const modalValidasi = document.getElementById('modalValidasi');

    // Prioritas notifikasi
    if (modalSukses) {
        bootstrap.Modal.getOrCreateInstance(modalSukses).show();
    } else if (modalError) {
        bootstrap.Modal.getOrCreateInstance(modalError).show();
    } else if (modalValidasi) {
        bootstrap.Modal.getOrCreateInstance(modalValidasi).show();
    }

});
</script>

@endsection