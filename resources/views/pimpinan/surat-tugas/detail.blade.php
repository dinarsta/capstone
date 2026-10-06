<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Surat Tugas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background: #121212;
        font-family: Arial, sans-serif;
        color: #f1f1f1;
    }

    /* SIDEBAR */
    .sidebar {
        width: 250px;
        min-height: 100vh;
        background: #0d0d0d;
        position: fixed;
        left: 0;
        top: 0;
        padding: 25px 18px;
        border-right: 1px solid #292929;
    }

    .sidebar h4 {
        color: #ffffff;
        margin-bottom: 35px;
        font-weight: 700;
    }

    .sidebar a {
        display: block;
        color: #b8b8b8;
        text-decoration: none;
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 5px;
        transition: .2s;
    }

    .sidebar a:hover,
    .sidebar a.active {
        background: #dc5f00;
        color: #ffffff;
    }

    /* CONTENT */
    .content {
        margin-left: 250px;
        padding: 30px;
    }

    /* TOPBAR */
    .topbar {
        background: #1b1b1b;
        border: 1px solid #292929;
        border-radius: 12px;
        padding: 20px 25px;
        margin-bottom: 25px;
    }

    .topbar h3 {
        color: #ffffff;
        font-weight: 700;
    }

    .topbar small {
        color: #999 !important;
    }

    /* CARD */
    .card-custom {
        background: #1b1b1b;
        border: 1px solid #292929;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, .25);
    }

    .card-custom h5 {
        color: #ffffff;
    }

    /* LABEL */
    .label {
        color: #999;
        font-size: 13px;
        margin-bottom: 5px;
    }

    /* VALUE */
    .value {
        font-weight: 600;
        color: #eeeeee;
        margin-bottom: 20px;
    }

    /* BUTTON ORANGE */
    .btn-orange {
        background: #dc5f00;
        color: #ffffff;
        border: none;
    }

    .btn-orange:hover {
        background: #b94f00;
        color: #ffffff;
    }

    /* OUTLINE BUTTON */
    .btn-outline-secondary {
        color: #bbbbbb;
        border-color: #555555;
    }

    .btn-outline-secondary:hover {
        background: #333333;
        border-color: #666666;
        color: #ffffff;
    }

    .btn-outline-dark {
        color: #dddddd;
        border-color: #555555;
    }

    .btn-outline-dark:hover {
        background: #333333;
        border-color: #666666;
        color: #ffffff;
    }

    /* PDF */
    .pdf-container {
        width: 100%;
        height: 650px;
        border: 1px solid #333333;
        border-radius: 8px;
        overflow: hidden;
        background: #242424;
    }

    .pdf-container iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    /* ALERT */
    .alert-secondary {
        background: #242424;
        border: 1px solid #3a3a3a;
        color: #cccccc;
    }

    .alert-warning {
        background: #3a2d16;
        border: 1px solid #6b5225;
        color: #f0c674;
    }

    /* MODAL */
    .modal-content {
        background: #1b1b1b;
        color: #eeeeee;
        border: 1px solid #333333;
    }

    .modal-header {
        border-bottom: 1px solid #333333;
    }

    .modal-footer {
        border-top: 1px solid #333333;
    }

    .modal-title {
        color: #ffffff;
    }

    .btn-close {
        filter: invert(1);
    }

    .form-label {
        color: #dddddd;
    }

    .form-control {
        background: #242424;
        border: 1px solid #444444;
        color: #ffffff;
    }

    .form-control:focus {
        background: #242424;
        border-color: #dc5f00;
        color: #ffffff;
        box-shadow: 0 0 0 .2rem rgba(220, 95, 0, .15);
    }

    .form-control::placeholder {
        color: #777777;
    }

    /* LOGOUT */
    .btn-danger {
        background: #8f2525;
        border-color: #8f2525;
    }

    .btn-danger:hover {
        background: #a82d2d;
        border-color: #a82d2d;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {

        .sidebar {
            width: 100%;
            min-height: auto;
            position: relative;
            border-right: none;
            border-bottom: 1px solid #292929;
        }

        .sidebar h4 {
            margin-bottom: 20px;
        }

        .content {
            margin-left: 0;
            padding: 20px;
        }

        .topbar {
            padding: 18px;
        }

        .card-custom {
            padding: 18px;
        }

        .pdf-container {
            height: 500px;
        }
    }

    /* PRINT */
    @media print {

        body {
            background: #ffffff !important;
            color: #000000 !important;
        }

        .sidebar,
        .topbar,
        .no-print,
        .btn,
        .modal,
        .pdf-container {
            display: none !important;
        }

        .content {
            margin-left: 0 !important;
            padding: 0 !important;
        }

        .card-custom {
            background: #ffffff !important;
            color: #000000 !important;
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
        }

        .label {
            color: #555555 !important;
        }

        .value {
            color: #000000 !important;
        }

        .badge {
            border: 1px solid #000000;
            color: #000000 !important;
            background: #ffffff !important;
        }

        .print-title {
            display: block !important;
            margin-bottom: 25px;
        }

        .print-section {
            page-break-inside: avoid;
        }
    }

    .print-title {
        display: none;
    }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <div class="sidebar no-print">

        <h4>Panel Pimpinan</h4>

        <a href="{{ route('pimpinan.dashboard') }}">
            Dashboard
        </a>

        <a href="{{ route('pimpinan.surat-tugas.index') }}" class="active">
            Surat Tugas
        </a>

        <a href="{{ route('display') }}" target="_blank">
            TV Display
        </a>

        <form action="{{ route('logout') }}" method="POST" class="mt-3">
            @csrf

            <button type="submit" class="btn btn-danger w-100">
                Logout
            </button>
        </form>

    </div>


    {{-- CONTENT --}}
    <div class="content">

        {{-- TOPBAR --}}
        <div class="topbar no-print">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h3 class="mb-1">
                        Detail Surat Tugas
                    </h3>

                    <small>
                        Validasi Surat Tugas
                    </small>

                </div>

                <a href="{{ route('pimpinan.surat-tugas.index') }}" class="btn btn-outline-secondary">

                    Kembali

                </a>

            </div>

        </div>


        {{-- JUDUL CETAK --}}
        <div class="print-title">

            <h2 class="text-center">
                SURAT TUGAS
            </h2>

            <hr>

        </div>


        {{-- INFORMASI SURAT --}}
        <div class="card-custom print-section">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <h5 class="mb-0">
                    Informasi Surat Tugas
                </h5>

                @if($suratTugas->status === 'diajukan')

                <span class="badge bg-warning text-dark">
                    Diajukan
                </span>

                @elseif($suratTugas->status === 'disetujui')

                <span class="badge bg-success">
                    Disetujui
                </span>

                @elseif($suratTugas->status === 'ditolak')

                <span class="badge bg-danger">
                    Ditolak
                </span>

                @else

                <span class="badge bg-secondary">
                    Draft
                </span>

                @endif

            </div>


            <div class="row">

                <div class="col-md-6">

                    <div class="label">
                        Nomor Surat
                    </div>

                    <div class="value">
                        {{ $suratTugas->nomor_surat }}
                    </div>


                    <div class="label">
                        Kegiatan
                    </div>

                    <div class="value">
                        {{ $suratTugas->kegiatan }}
                    </div>


                    <div class="label">
                        Pegawai
                    </div>

                    <div class="value">
                        {{ $suratTugas->pegawai->nama ?? '-' }}
                    </div>


                    <div class="label">
                        Jabatan
                    </div>

                    <div class="value">
                        {{ $suratTugas->pegawai->jabatan ?? '-' }}
                    </div>

                </div>


                <div class="col-md-6">

                    <div class="label">
                        Instansi
                    </div>

                    <div class="value">
                        {{ $suratTugas->instansi->nama ?? '-' }}
                    </div>


                    <div class="label">
                        Lokasi
                    </div>

                    <div class="value">
                        {{ $suratTugas->lokasi->nama ?? '-' }}
                    </div>


                    <div class="label">
                        Jenis Kegiatan
                    </div>

                    <div class="value">
                        {{ $suratTugas->jenisKegiatan->nama ?? '-' }}
                    </div>


                    <div class="label">
                        Tanggal
                    </div>

                    <div class="value">

                        {{ $suratTugas->tanggal_mulai?->format('d/m/Y') ?? '-' }}

                        @if($suratTugas->tanggal_selesai)

                        -
                        {{ $suratTugas->tanggal_selesai->format('d/m/Y') }}

                        @endif

                    </div>

                </div>

            </div>


            @if($suratTugas->catatan)

            <div class="alert alert-secondary mb-0">

                <strong>Catatan:</strong>

                <br>

                {{ $suratTugas->catatan }}

            </div>

            @endif

        </div>


        {{-- DOKUMEN PDF --}}
        <div class="card-custom no-print">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <h5 class="mb-0">
                    Dokumen Surat Tugas
                </h5>

                @if($suratTugas->dokumen_pdf)

                <a href="{{ asset('storage/' . $suratTugas->dokumen_pdf) }}" target="_blank"
                    class="btn btn-outline-dark btn-sm">

                    Buka PDF

                </a>

                @endif

            </div>


            @if($suratTugas->dokumen_pdf)

            <div class="pdf-container">

                <iframe src="{{ asset('storage/' . $suratTugas->dokumen_pdf) }}">
                </iframe>

            </div>

            @else

            <div class="alert alert-warning mb-0">

                Dokumen PDF belum diupload.

            </div>

            @endif

        </div>


        {{-- VALIDASI --}}
        @if($suratTugas->status === 'diajukan')

        <div class="card-custom no-print">

            <h5 class="mb-3">
                Validasi Surat Tugas
            </h5>

            <p class="text-muted">
                Silakan melakukan persetujuan atau penolakan terhadap Surat Tugas ini.
            </p>


            <div class="d-flex gap-2">

                {{-- APPROVE --}}
                <form action="{{ route('pimpinan.surat-tugas.approve', $suratTugas->id) }}" method="POST">

                    @csrf

                    <button type="submit" class="btn btn-success"
                        onclick="return confirm('Apakah Anda yakin ingin menyetujui Surat Tugas ini?')">

                        Setujui

                    </button>

                </form>


                {{-- REJECT --}}
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTolak">

                    Tolak

                </button>

            </div>

        </div>

        @endif


        {{-- TOMBOL CETAK --}}
        @if($suratTugas->status === 'disetujui')

        <div class="card-custom no-print">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h5 class="mb-1">
                        Surat Telah Disetujui
                    </h5>

                    <small class="text-muted">
                        Surat Tugas dapat dicetak.
                    </small>

                </div>

                {{-- CETAK JAVASCRIPT --}}
                <button type="button" class="btn btn-orange" onclick="cetakSurat()">

                    Cetak Surat

                </button>

            </div>

        </div>

        @endif

    </div>


    {{-- MODAL TOLAK --}}
    <div class="modal fade" id="modalTolak" tabindex="-1">

        <div class="modal-dialog">

            <div class="modal-content">

                <form action="{{ route('pimpinan.surat-tugas.reject', $suratTugas->id) }}" method="POST">

                    @csrf

                    <div class="modal-header">

                        <h5 class="modal-title">
                            Tolak Surat Tugas
                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>

                    </div>


                    <div class="modal-body">

                        <label class="form-label">
                            Alasan Penolakan
                        </label>

                        <textarea name="catatan" class="form-control" rows="4" required
                            placeholder="Masukkan alasan penolakan..."></textarea>

                    </div>


                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                            Batal

                        </button>

                        <button type="submit" class="btn btn-danger">

                            Tolak Surat

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>


    {{-- JAVASCRIPT CETAK --}}
    <script>
    function cetakSurat() {
        window.print();
    }
    </script>

</body>

</html>