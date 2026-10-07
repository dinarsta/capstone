<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Surat Tugas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        background: #000;
        color: #fff;
        font-family: Arial, sans-serif;
        font-size: 14px;
    }

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
        color: #fff;
    }


    /* =====================================================
           SIDEBAR
        ===================================================== */

    .sidebar {
        width: 220px;
        min-height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        padding: 20px 15px;
        background: #000;
        border-right: 1px solid #222;
    }

    .sidebar h4 {
        margin-bottom: 25px;
        color: #fff;
        font-size: 18px;
        font-weight: 700;
    }

    .sidebar a {
        display: block;
        padding: 10px 13px;
        margin-bottom: 4px;
        color: #fff;
        text-decoration: none;
        border-radius: 7px;
        transition: .2s;
    }

    .sidebar a:hover {
        background: #222;
        color: #fff;
    }

    .sidebar a.active {
        background: #dc5f00;
        color: #fff;
    }


    /* =====================================================
           CONTENT
        ===================================================== */

    .content {
        width: calc(100% - 220px);
        min-height: 100vh;
        margin-left: 220px;
        padding: 22px;
        background: #000;
    }


    /* =====================================================
           TOPBAR
        ===================================================== */

    .topbar {
        padding: 15px 18px;
        margin-bottom: 18px;
        background: #000;
        border: 1px solid #222;
        border-radius: 10px;
    }

    .topbar h3 {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
    }

    .topbar small {
        opacity: .8;
    }


    /* =====================================================
           CARD
        ===================================================== */

    .card-custom {
        padding: 18px;
        margin-bottom: 18px;
        background: #000;
        color: #fff;
        border: 1px solid #222;
        border-radius: 10px;
    }

    .card-custom h5 {
        font-size: 16px;
        font-weight: 600;
    }


    /* =====================================================
           LABEL
        ===================================================== */

    .label {
        margin-bottom: 4px;
        color: #aaa;
        font-size: 12px;
        font-weight: 500;
    }

    .value {
        margin-bottom: 15px;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
    }


    /* =====================================================
           BUTTON
        ===================================================== */

    .btn-orange {
        padding: 7px 13px;
        color: #fff !important;
        background: #dc5f00 !important;
        border: 1px solid #dc5f00 !important;
        border-radius: 7px;
        font-size: 13px;
    }

    .btn-orange:hover {
        color: #fff !important;
        background: #b94f00 !important;
        border-color: #b94f00 !important;
    }

    .btn-outline-secondary,
    .btn-outline-light {
        padding: 7px 13px;
        color: #fff !important;
        background: #000 !important;
        border: 1px solid #444 !important;
        border-radius: 7px;
        font-size: 13px;
    }

    .btn-outline-secondary:hover,
    .btn-outline-light:hover {
        color: #fff !important;
        background: #222 !important;
        border-color: #666 !important;
    }


    /* =====================================================
           STATUS
        ===================================================== */

    .badge {
        padding: 6px 10px;
        color: #fff !important;
        font-size: 11px;
    }

    .badge.bg-warning {
        background: #dc5f00 !important;
    }

    .badge.bg-success {
        background: #198754 !important;
    }

    .badge.bg-danger {
        background: #8f2525 !important;
    }

    .badge.bg-secondary {
        background: #333 !important;
    }


    /* =====================================================
           PDF
        ===================================================== */

    .pdf-container {
        width: 100%;
        height: 550px;
        overflow: hidden;
        background: #000;
        border: 1px solid #222;
        border-radius: 8px;
    }

    .pdf-container iframe {
        width: 100%;
        height: 100%;
        border: 0;
    }


    /* =====================================================
           ALERT
        ===================================================== */

    .alert {
        color: #fff !important;
        background: #000 !important;
        border: 1px solid #333 !important;
    }

    .alert-warning {
        border-color: #dc5f00 !important;
    }


    /* =====================================================
           MODAL
        ===================================================== */

    .modal-content {
        color: #fff;
        background: #000;
        border: 1px solid #333;
    }

    .modal-header {
        background: #000;
        border-bottom: 1px solid #333;
    }

    .modal-footer {
        background: #000;
        border-top: 1px solid #333;
    }

    .modal-title {
        color: #fff;
        font-size: 16px;
    }

    .btn-close {
        filter: invert(1);
    }


    /* =====================================================
           FORM
        ===================================================== */

    .form-label {
        color: #fff;
        font-size: 13px;
        font-weight: 500;
    }

    .form-control {
        color: #fff !important;
        background: #000 !important;
        border: 1px solid #444 !important;
        border-radius: 7px;
    }

    .form-control:focus {
        color: #fff !important;
        background: #000 !important;
        border-color: #dc5f00 !important;
        box-shadow: 0 0 0 .15rem rgba(220, 95, 0, .15);
    }

    .form-control::placeholder {
        color: #aaa !important;
    }


    /* =====================================================
           PRINT DOCUMENT
        ===================================================== */

    .print-document {
        display: none;
    }


    /* =====================================================
           RESPONSIVE
        ===================================================== */

    @media (max-width: 768px) {

        .sidebar {
            width: 100%;
            min-height: auto;
            position: relative;
            padding: 15px;
            border-right: 0;
            border-bottom: 1px solid #222;
        }

        .sidebar h4 {
            margin-bottom: 15px;
        }

        .content {
            width: 100%;
            margin-left: 0;
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

        @page {
            size: A4;
            margin: 18mm 20mm 18mm 20mm;
        }

        html,
        body {
            width: 100% !important;
            min-height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            background: #fff !important;
            color: #000 !important;
        }

        body {
            font-family: "Times New Roman", Times, serif !important;
        }

        /*
             * Jangan gunakan body * { visibility:hidden }
             * karena bisa membuat hasil print kosong.
             */

        .sidebar,
        .topbar,
        .card-custom,
        .pdf-container,
        .modal,
        .no-print {
            display: none !important;
        }

        .content {
            display: block !important;
            width: 100% !important;
            min-height: auto !important;
            margin: 0 !important;
            padding: 0 !important;
            background: #fff !important;
        }

        .print-document {
            display: block !important;
            position: relative !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            background: #fff !important;
            color: #000 !important;
            font-family: "Times New Roman", Times, serif !important;
            font-size: 12pt;
            line-height: 1.5;
        }

        .print-document * {
            color: #000 !important;
        }


        /* =================================================
               KOP SURAT
            ================================================= */

        .print-header {
            width: 100%;
            display: flex !important;
            align-items: center;
            gap: 18px;
            padding-bottom: 10px;
            border-bottom: 3px solid #000;
        }

        .print-logo {
            display: block !important;
            width: 78px !important;
            height: 78px !important;
            object-fit: contain !important;
            flex-shrink: 0;
        }

        .print-header-text {
            flex: 1;
            text-align: center;
            line-height: 1.2;
        }

        .print-header-text .instansi-atas {
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
        }

        .print-header-text .instansi {
            margin-top: 2px;
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
        }

        .print-header-text .alamat {
            margin-top: 5px;
            font-size: 9.5pt;
            line-height: 1.3;
        }


        /* =================================================
               JUDUL
            ================================================= */

        .print-title {
            display: block !important;
            margin-top: 25px;
            margin-bottom: 25px;
            text-align: center;
        }

        .print-title h1 {
            margin: 0;
            font-size: 16pt;
            font-weight: bold;
            text-decoration: underline;
        }

        .print-title .nomor {
            margin-top: 5px;
            font-size: 12pt;
        }


        /* =================================================
               ISI
            ================================================= */

        .print-opening {
            margin-bottom: 18px;
            text-align: justify;
        }

        .print-table {
            width: 100%;
            margin: 10px 0 20px;
            border-collapse: collapse;
        }

        .print-table td {
            padding: 3px 0;
            vertical-align: top;
        }

        .print-table .label-col {
            width: 160px;
        }

        .print-table .separator-col {
            width: 15px;
            text-align: center;
        }

        .print-closing {
            margin-top: 20px;
            text-align: justify;
        }


        /* =================================================
               CATATAN
            ================================================= */

        .print-catatan {
            margin-top: 20px;
            padding-top: 8px;
            border-top: 1px solid #000;
            font-size: 10pt;
        }


        /* =================================================
               TANDA TANGAN
            ================================================= */

        .print-signature {
            width: 42%;
            margin-top: 55px;
            margin-left: auto;
            text-align: center;
        }

        .print-signature .tempat-tanggal {
            margin-bottom: 3px;
        }

        .print-signature .jabatan {
            margin-bottom: 65px;
        }

        .print-signature .nama {
            font-weight: bold;
            text-decoration: underline;
        }

        .print-signature .nip {
            margin-top: 2px;
        }

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


        {{-- =================================================
             TOPBAR
        ================================================== --}}

        <div class="topbar no-print">

            <div class="d-flex justify-content-between align-items-center gap-3">

                <div>

                    <h3>
                        Detail Surat Tugas
                    </h3>

                    <small>
                        Validasi dan lihat dokumen surat tugas
                    </small>

                </div>


                <a href="{{ route('pimpinan.surat-tugas.index') }}" class="btn btn-outline-secondary">

                    Kembali

                </a>

            </div>

        </div>


        {{-- =================================================
             PRINT DOCUMENT
        ================================================== --}}

        <div class="print-document">


            {{-- KOP SURAT --}}

            <div class="print-header">

                <img src="{{ asset('logo.png') }}" class="print-logo" alt="Logo">


                <div class="print-header-text">

                    <div class="instansi-atas">
                        {{ strtoupper($suratTugas->instansi->nama ?? 'INSTANSI') }}
                    </div>

                    <div class="instansi">
                        SURAT TUGAS
                    </div>

                    <div class="alamat">
                        Dokumen Resmi Surat Tugas
                    </div>

                </div>

            </div>


            {{-- JUDUL --}}

            <div class="print-title">

                <h1>
                    SURAT TUGAS
                </h1>

                <div class="nomor">
                    Nomor:
                    {{ $suratTugas->nomor_surat }}
                </div>

            </div>


            {{-- ISI SURAT --}}

            <div class="print-body">


                <div class="print-opening">

                    Dalam rangka pelaksanaan kegiatan

                    <strong>
                        {{ $suratTugas->kegiatan }}
                    </strong>,

                    dengan ini menugaskan kepada:

                </div>


                {{-- DATA PEGAWAI --}}

                <table class="print-table">

                    <tr>

                        <td class="label-col">
                            Nama
                        </td>

                        <td class="separator-col">
                            :
                        </td>

                        <td>
                            {{ $suratTugas->pegawai->nama ?? '-' }}
                        </td>

                    </tr>


                    <tr>

                        <td class="label-col">
                            NIP
                        </td>

                        <td class="separator-col">
                            :
                        </td>

                        <td>
                            {{ $suratTugas->pegawai->nip ?? '-' }}
                        </td>

                    </tr>


                    <tr>

                        <td class="label-col">
                            Jabatan
                        </td>

                        <td class="separator-col">
                            :
                        </td>

                        <td>
                            {{ $suratTugas->pegawai->jabatan ?? '-' }}
                        </td>

                    </tr>


                    <tr>

                        <td class="label-col">
                            Unit Kerja
                        </td>

                        <td class="separator-col">
                            :
                        </td>

                        <td>
                            {{ $suratTugas->pegawai->unit_kerja ?? '-' }}
                        </td>

                    </tr>


                    <tr>

                        <td class="label-col">
                            Pangkat/Golongan
                        </td>

                        <td class="separator-col">
                            :
                        </td>

                        <td>
                            {{ $suratTugas->pegawai->pangkat ?? '-' }}
                        </td>

                    </tr>


                    <tr>

                        <td class="label-col">
                            Instansi
                        </td>

                        <td class="separator-col">
                            :
                        </td>

                        <td>
                            {{ $suratTugas->instansi->nama ?? '-' }}
                        </td>

                    </tr>


                    <tr>

                        <td class="label-col">
                            Lokasi
                        </td>

                        <td class="separator-col">
                            :
                        </td>

                        <td>
                            {{ $suratTugas->lokasi->nama ?? '-' }}
                        </td>

                    </tr>


                    <tr>

                        <td class="label-col">
                            Jenis Kegiatan
                        </td>

                        <td class="separator-col">
                            :
                        </td>

                        <td>
                            {{ $suratTugas->jenisKegiatan->nama ?? '-' }}
                        </td>

                    </tr>


                    <tr>

                        <td class="label-col">
                            Tanggal Pelaksanaan
                        </td>

                        <td class="separator-col">
                            :
                        </td>

                        <td>

                            {{ $suratTugas->tanggal_mulai?->format('d/m/Y') ?? '-' }}

                            @if($suratTugas->tanggal_selesai)

                            s.d.
                            {{ $suratTugas->tanggal_selesai->format('d/m/Y') }}

                            @endif

                        </td>

                    </tr>

                </table>


                <div class="print-closing">

                    Demikian Surat Tugas ini dibuat untuk dapat
                    dilaksanakan dengan penuh tanggung jawab
                    sesuai dengan tugas dan kegiatan yang telah
                    ditetapkan.

                </div>


                {{-- CATATAN --}}

                @if($suratTugas->catatan)

                <div class="print-catatan">

                    <strong>
                        Catatan:
                    </strong>

                    <br>

                    {{ $suratTugas->catatan }}

                </div>

                @endif


                {{-- TANDA TANGAN --}}

                <div class="print-signature">

                    <div class="tempat-tanggal">

                        Jakarta,
                        {{ now()->format('d/m/Y') }}

                    </div>


                    <div class="jabatan">

                        Pimpinan

                    </div>


                    <div class="nama">

                        {{ $suratTugas->approver->name ?? 'Siti Aminah' }}

                    </div>


                    <div class="nip">

                        NIP. ______________________

                    </div>

                </div>

            </div>

        </div>


        {{-- =================================================
             INFORMASI SURAT
        ================================================== --}}

        <div class="card-custom no-print">

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


                {{-- SETUJUI --}}

                <form action="{{ route('pimpinan.surat-tugas.approve', $suratTugas->id) }}" method="POST">

                    @csrf

                    <button type="submit" class="btn btn-success"
                        onclick="return confirm('Apakah Anda yakin ingin menyetujui Surat Tugas ini?')">

                        Setujui

                    </button>

                </form>


                {{-- TOLAK --}}

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


                    <div class="modal-header">

                        <h5 class="modal-title">
                            Tolak Surat Tugas
                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
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


    {{-- =====================================================
         BOOTSTRAP JS
    ====================================================== --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>


    {{-- =====================================================
         CETAK
    ====================================================== --}}

    <script>
    function cetakSurat() {

        window.print();

    }
    </script>

</body>

</html>