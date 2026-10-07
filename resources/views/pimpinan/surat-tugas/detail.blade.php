<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Surat Tugas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    /* =====================================================
           GLOBAL
        ===================================================== */

    * {
        box-sizing: border-box;
    }

    body {
        background: #000000 !important;
        color: #ffffff !important;
        font-family: Arial, sans-serif;
        font-size: 14px;
    }

    /* Paksa teks Bootstrap menjadi putih */
    body,
    p,
    span,
    small,
    label,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    strong,
    a {
        color: #ffffff;
    }


    /* =====================================================
           SIDEBAR
        ===================================================== */

    .sidebar {
        width: 220px;
        min-height: 100vh;
        background: #000000 !important;

        position: fixed;
        left: 0;
        top: 0;

        padding: 20px 15px;

        border-right: 1px solid #222222;
    }

    .sidebar h4 {
        color: #ffffff !important;
        font-size: 18px;
        font-weight: 700;

        margin-bottom: 25px;
    }

    .sidebar a {
        display: block;

        color: #ffffff !important;
        text-decoration: none;

        padding: 10px 13px;
        margin-bottom: 4px;

        border-radius: 7px;

        transition: .2s;
    }

    .sidebar a:hover {
        background: #222222 !important;
        color: #ffffff !important;
    }

    .sidebar a.active {
        background: #dc5f00 !important;
        color: #ffffff !important;
    }


    /* =====================================================
           CONTENT
        ===================================================== */

    .content {
        margin-left: 220px;

        min-height: 100vh;

        padding: 22px;

        background: #000000 !important;
    }


    /* =====================================================
           TOPBAR
        ===================================================== */

    .topbar {
        background: #000000 !important;

        border: 1px solid #222222;

        border-radius: 10px;

        padding: 15px 18px;

        margin-bottom: 18px;
    }

    .topbar h3 {
        color: #ffffff !important;

        font-size: 20px;

        font-weight: 700;
    }

    .topbar small {
        color: #ffffff !important;

        opacity: .8;
    }


    /* =====================================================
           CARD
        ===================================================== */

    .card-custom {
        background: #000000 !important;

        color: #ffffff !important;

        border: 1px solid #222222;

        border-radius: 10px;

        padding: 18px;

        margin-bottom: 18px;

        box-shadow: none;
    }

    .card-custom h5 {
        color: #ffffff !important;

        font-size: 16px;

        font-weight: 600;
    }


    /* =====================================================
           LABEL & VALUE
        ===================================================== */

    .label {
        color: #ffffff !important;

        font-size: 12px;

        font-weight: 500;

        margin-bottom: 4px;
    }

    .value {
        color: #ffffff !important;

        font-size: 14px;

        font-weight: 600;

        margin-bottom: 15px;
    }


    /* =====================================================
           BUTTON ORANGE
        ===================================================== */

    .btn-orange {
        background: #dc5f00 !important;

        color: #ffffff !important;

        border: 1px solid #dc5f00 !important;

        font-size: 13px;

        padding: 7px 13px;

        border-radius: 7px;
    }

    .btn-orange:hover {
        background: #b94f00 !important;

        border-color: #b94f00 !important;

        color: #ffffff !important;
    }


    /* =====================================================
           OUTLINE BUTTON
        ===================================================== */

    .btn-outline-secondary,
    .btn-outline-dark,
    .btn-outline-light {
        background: #000000 !important;

        color: #ffffff !important;

        border: 1px solid #444444 !important;

        font-size: 13px;

        padding: 7px 13px;

        border-radius: 7px;
    }

    .btn-outline-secondary:hover,
    .btn-outline-dark:hover,
    .btn-outline-light:hover {
        background: #222222 !important;

        border-color: #666666 !important;

        color: #ffffff !important;
    }


    /* =====================================================
           ALL BUTTON
        ===================================================== */

    .btn {
        color: #ffffff !important;
    }


    /* =====================================================
           STATUS BADGE
        ===================================================== */

    .badge {
        color: #ffffff !important;

        font-size: 11px;

        padding: 6px 10px;
    }

    .badge.bg-warning {
        background: #dc5f00 !important;

        color: #ffffff !important;
    }

    .badge.bg-success {
        background: #198754 !important;

        color: #ffffff !important;
    }

    .badge.bg-danger {
        background: #8f2525 !important;

        color: #ffffff !important;
    }

    .badge.bg-secondary {
        background: #333333 !important;

        color: #ffffff !important;
    }


    /* =====================================================
           PDF
        ===================================================== */

    .pdf-container {
        width: 100%;

        height: 550px;

        background: #000000 !important;

        border: 1px solid #222222;

        border-radius: 8px;

        overflow: hidden;
    }

    .pdf-container iframe {
        width: 100%;

        height: 100%;

        border: none;

        background: #000000;
    }


    /* =====================================================
           ALERT
        ===================================================== */

    .alert {
        background: #000000 !important;

        color: #ffffff !important;

        border: 1px solid #333333 !important;
    }

    .alert-secondary {
        background: #000000 !important;

        color: #ffffff !important;

        border-color: #333333 !important;
    }

    .alert-warning {
        background: #000000 !important;

        color: #ffffff !important;

        border-color: #dc5f00 !important;
    }


    /* =====================================================
           MODAL
        ===================================================== */

    .modal-content {
        background: #000000 !important;

        color: #ffffff !important;

        border: 1px solid #333333 !important;
    }

    .modal-header {
        background: #000000 !important;

        border-bottom: 1px solid #333333 !important;
    }

    .modal-footer {
        background: #000000 !important;

        border-top: 1px solid #333333 !important;
    }

    .modal-title {
        color: #ffffff !important;

        font-size: 16px;
    }

    .btn-close {
        filter: invert(1);

        opacity: 1;
    }


    /* =====================================================
           FORM
        ===================================================== */

    .form-label {
        color: #ffffff !important;

        font-size: 13px;

        font-weight: 500;
    }

    .form-control,
    .form-select {
        background: #000000 !important;

        color: #ffffff !important;

        border: 1px solid #444444 !important;

        font-size: 13px;

        border-radius: 7px;
    }

    .form-control:focus,
    .form-select:focus {
        background: #000000 !important;

        color: #ffffff !important;

        border-color: #dc5f00 !important;

        box-shadow: 0 0 0 .15rem rgba(220, 95, 0, .15);
    }

    .form-control::placeholder {
        color: #ffffff !important;

        opacity: .6;
    }

    .form-select option {
        background: #000000;

        color: #ffffff;
    }


    /* =====================================================
           LOGOUT
        ===================================================== */

    .btn-danger {
        background: #8f2525 !important;

        border-color: #8f2525 !important;

        color: #ffffff !important;
    }

    .btn-danger:hover {
        background: #a82d2d !important;

        border-color: #a82d2d !important;

        color: #ffffff !important;
    }


    /* =====================================================
           RESPONSIVE
        ===================================================== */

    @media (max-width: 768px) {

        .sidebar {
            width: 100%;

            min-height: auto;

            position: relative;

            border-right: none;

            border-bottom: 1px solid #222222;
        }

        .sidebar h4 {
            margin-bottom: 18px;
        }

        .content {
            margin-left: 0;

            padding: 15px;
        }

        .topbar {
            padding: 14px;
        }

        .card-custom {
            padding: 15px;
        }

        .pdf-container {
            height: 400px;
        }

    }


    /* =====================================================
           PRINT
        ===================================================== */

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

            background: #ffffff !important;
        }

        .card-custom {
            background: #ffffff !important;

            color: #000000 !important;

            border: none !important;

            box-shadow: none !important;

            padding: 0 !important;
        }

        .card-custom h5,
        .label,
        .value,
        .card-custom span,
        .card-custom strong {
            color: #000000 !important;
        }

        .badge {
            color: #000000 !important;

            background: #ffffff !important;

            border: 1px solid #000000;
        }

        .print-title {
            display: block !important;

            color: #000000 !important;

            margin-bottom: 20px;
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


    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

    <div class="sidebar no-print">

        <h4>
            Panel Pimpinan
        </h4>


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


    {{-- =====================================================
         CONTENT
    ====================================================== --}}

    <div class="content">


        {{-- TOPBAR --}}

        <div class="topbar no-print">

            <div class="d-flex justify-content-between align-items-center gap-3">

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


        {{-- =================================================
             JUDUL CETAK
        ================================================== --}}

        <div class="print-title">

            <h2 class="text-center">
                SURAT TUGAS
            </h2>

            <hr>

        </div>


        {{-- =================================================
             INFORMASI SURAT
        ================================================== --}}

        <div class="card-custom print-section">


            <div class="d-flex justify-content-between align-items-center mb-3">

                <h5 class="mb-0">
                    Informasi Surat Tugas
                </h5>


                @if($suratTugas->status === 'diajukan')

                <span class="badge bg-warning">
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


                {{-- KIRI --}}

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


                {{-- KANAN --}}

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


            {{-- CATATAN --}}

            @if($suratTugas->catatan)

            <div class="alert alert-secondary mb-0">

                <strong>
                    Catatan:
                </strong>

                <br>

                {{ $suratTugas->catatan }}

            </div>

            @endif

        </div>


        {{-- =================================================
             DOKUMEN PDF
        ================================================== --}}

        <div class="card-custom no-print">


            <div class="d-flex justify-content-between align-items-center mb-3">

                <h5 class="mb-0">
                    Dokumen Surat Tugas
                </h5>


                @if($suratTugas->dokumen_pdf)

                <a href="{{ asset('storage/' . $suratTugas->dokumen_pdf) }}" target="_blank"
                    class="btn btn-outline-light btn-sm">

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


        {{-- =================================================
             VALIDASI
        ================================================== --}}

        @if($suratTugas->status === 'diajukan')

        <div class="card-custom no-print">

            <h5 class="mb-2">
                Validasi Surat Tugas
            </h5>

            <p class="mb-3">
                Silakan melakukan persetujuan atau penolakan
                terhadap Surat Tugas ini.
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


        {{-- =================================================
             CETAK
        ================================================== --}}

        @if($suratTugas->status === 'disetujui')

        <div class="card-custom no-print">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h5 class="mb-1">
                        Surat Telah Disetujui
                    </h5>

                    <small>
                        Surat Tugas dapat dicetak.
                    </small>

                </div>


                <button type="button" class="btn btn-orange" onclick="cetakSurat()">

                    Cetak Surat

                </button>

            </div>

        </div>

        @endif

    </div>


    {{-- =====================================================
         MODAL TOLAK
    ====================================================== --}}

    <div class="modal fade" id="modalTolak" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">


                <form action="{{ route('pimpinan.surat-tugas.reject', $suratTugas->id) }}" method="POST">

                    @csrf


                    {{-- HEADER --}}

                    <div class="modal-header">

                        <h5 class="modal-title">
                            Tolak Surat Tugas
                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>

                    </div>


                    {{-- BODY --}}

                    <div class="modal-body">

                        <label class="form-label">
                            Alasan Penolakan
                        </label>

                        <textarea name="catatan" class="form-control" rows="3" required
                            placeholder="Masukkan alasan penolakan..."></textarea>

                    </div>


                    {{-- FOOTER --}}

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


    {{-- =====================================================
         BOOTSTRAP JS
    ====================================================== --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>


    {{-- =====================================================
         CETAK JAVASCRIPT
    ====================================================== --}}

    <script>
    function cetakSurat() {
        window.print();
    }
    </script>


</body>

</html>