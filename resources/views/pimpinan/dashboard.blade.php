<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Pimpinan</title>

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
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .topbar h3 {
        margin: 0;
        font-weight: 700;
        color: #ffffff;
    }

    .topbar small {
        color: #999 !important;
    }

    /* STAT CARD */
    .card-stat {
        background: #1b1b1b;
        border: 1px solid #292929;
        border-radius: 12px;
        padding: 22px;
        height: 100%;
        box-shadow: 0 3px 15px rgba(0, 0, 0, .25);
    }

    .card-stat h6 {
        color: #999;
        margin-bottom: 10px;
    }

    .card-stat h2 {
        margin: 0;
        font-weight: 700;
        color: #ffffff;
    }

    .stat-icon {
        width: 45px;
        height: 45px;
        border-radius: 10px;
        background: #dc5f00;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    /* TABLE */
    .table-card {
        background: #1b1b1b;
        border: 1px solid #292929;
        border-radius: 12px;
        padding: 25px;
        margin-top: 25px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, .25);
    }

    .table-card h5 {
        color: #ffffff;
    }

    .table-card small {
        color: #999 !important;
    }

    .table {
        color: #eeeeee;
        margin-bottom: 0;
    }

    .table thead th {
        background: #242424;
        color: #bdbdbd;
        border-color: #333;
        font-weight: 600;
        white-space: nowrap;
    }

    .table tbody td {
        background: #1b1b1b;
        color: #dddddd;
        border-color: #2d2d2d;
    }

    .table tbody tr:hover td {
        background: #242424;
    }

    .table strong {
        color: #ffffff;
    }

    /* BADGE */
    .badge-status {
        padding: 7px 12px;
        border-radius: 20px;
        font-size: 12px;
    }

    /* BUTTON */
    .btn-orange {
        background: #dc5f00;
        color: white;
        border: none;
    }

    .btn-orange:hover {
        background: #b94f00;
        color: white;
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

    /* PIMPINAN BADGE */
    .badge.bg-dark {
        background: #dc5f00 !important;
        color: #ffffff;
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

        .content {
            margin-left: 0;
            padding: 20px;
        }

        .topbar {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .card-stat {
            margin-bottom: 5px;
        }
    }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <div class="sidebar">

        <h4>Panel Pimpinan</h4>

        <a href="{{ route('pimpinan.dashboard') }}" class="active">
            Dashboard
        </a>

        <a href="{{ route('pimpinan.surat-tugas.index') }}">
            Surat Tugas
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

        <div class="topbar">

            <div>
                <h3>Dashboard Pimpinan</h3>

                <small>
                    Selamat datang,
                    {{ auth()->user()->name }}
                </small>
            </div>

            <div>
                <span class="badge">
                    PIMPINAN
                </span>
            </div>

        </div>


        {{-- STATISTIK --}}
        <div class="row g-4">

            <div class="col-md-3">
                <div class="card-stat">

                    <div class="d-flex justify-content-between">

                        <div>
                            <h6>Total Surat</h6>

                            <h2>
                                {{ $totalSurat ?? 0 }}
                            </h2>
                        </div>

                        <div class="stat-icon">
                            ST
                        </div>

                    </div>

                </div>
            </div>


            <div class="col-md-3">
                <div class="card-stat">

                    <div class="d-flex justify-content-between">

                        <div>
                            <h6>Diajukan</h6>

                            <h2>
                                {{ $diajukan ?? 0 }}
                            </h2>
                        </div>

                        <div class="stat-icon">
                            DA
                        </div>

                    </div>

                </div>
            </div>


            <div class="col-md-3">
                <div class="card-stat">

                    <div class="d-flex justify-content-between">

                        <div>
                            <h6>Disetujui</h6>

                            <h2>
                                {{ $disetujui ?? 0 }}
                            </h2>
                        </div>

                        <div class="stat-icon">
                            OK
                        </div>

                    </div>

                </div>
            </div>


            <div class="col-md-3">
                <div class="card-stat">

                    <div class="d-flex justify-content-between">

                        <div>
                            <h6>Ditolak</h6>

                            <h2>
                                {{ $ditolak ?? 0 }}
                            </h2>
                        </div>

                        <div class="stat-icon">
                            NO
                        </div>

                    </div>

                </div>
            </div>

        </div>


        {{-- SURAT TERBARU --}}
        <div class="table-card">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>
                    <h5 class="mb-1">
                        Surat Tugas Terbaru
                    </h5>

                    <small>
                        Daftar surat tugas yang perlu diperhatikan
                    </small>
                </div>

                <a href="{{ route('pimpinan.surat-tugas.index') }}" class="btn btn-orange btn-sm">
                    Lihat Semua
                </a>

            </div>


            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Surat</th>
                            <th>Kegiatan</th>
                            <th>Pegawai</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($suratTerbaru ?? [] as $surat)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <strong>
                                    {{ $surat->nomor_surat }}
                                </strong>
                            </td>

                            <td>
                                {{ $surat->kegiatan }}
                            </td>

                            <td>
                                {{ $surat->pegawai->nama ?? '-' }}
                            </td>

                            <td>
                                {{ $surat->tanggal_mulai?->format('d/m/Y') ?? '-' }}
                            </td>

                            <td>

                                @if($surat->status === 'diajukan')

                                <span class="badge bg-warning text-dark badge-status">
                                    Diajukan
                                </span>

                                @elseif($surat->status === 'disetujui')

                                <span class="badge bg-success badge-status">
                                    Disetujui
                                </span>

                                @elseif($surat->status === 'ditolak')

                                <span class="badge bg-danger badge-status">
                                    Ditolak
                                </span>

                                @else

                                <span class="badge bg-secondary badge-status">
                                    Draft
                                </span>

                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Belum ada data Surat Tugas.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>

</html>