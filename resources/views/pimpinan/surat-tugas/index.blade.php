<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Surat Tugas - Pimpinan</title>

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
    .content-card {
        background: #1b1b1b;
        border: 1px solid #292929;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, .25);
    }

    .content-card h5 {
        color: #ffffff;
    }

    .content-card small {
        color: #999 !important;
    }

    /* TABLE */
    .table {
        color: #eeeeee;
        margin-bottom: 0;
    }

    .table th {
        white-space: nowrap;
        background: #242424;
        color: #bdbdbd;
        border-color: #333;
        font-weight: 600;
    }

    .table td {
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

    .badge.bg-dark {
        background: #dc5f00 !important;
        color: #ffffff;
    }

    /* BUTTON */
    .btn-orange {
        background: #dc5f00;
        color: #ffffff;
        border: none;
    }

    .btn-orange:hover {
        background: #b94f00;
        color: #ffffff;
    }

    /* ALERT */
    .alert-success {
        background: #17351f;
        border: 1px solid #245c35;
        color: #9be2ad;
    }

    .alert-danger {
        background: #3a1b1b;
        border: 1px solid #6b2929;
        color: #f3a4a4;
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

        .content-card {
            padding: 18px;
        }

        .table {
            min-width: 900px;
        }

        .table-responsive {
            border-radius: 8px;
        }
    }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <div class="sidebar">

        <h4>Panel Pimpinan</h4>

        <a href="{{ route('pimpinan.dashboard') }}">
            Dashboard
        </a>

        <a href="{{ route('pimpinan.surat-tugas.index') }}" class="active">
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

        {{-- TOPBAR --}}
        <div class="topbar">

            <h3 class="mb-1">
                Surat Tugas
            </h3>

            <small>
                Daftar Surat Tugas yang diajukan untuk validasi pimpinan
            </small>

        </div>


        {{-- CARD --}}
        <div class="content-card">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>
                    <h5 class="mb-1">
                        Daftar Surat Tugas
                    </h5>

                    <small>
                        Pimpinan dapat melihat, menyetujui, atau menolak Surat Tugas.
                    </small>
                </div>

                <span class="badge bg-dark">
                    {{ $suratTugas->count() }} Surat
                </span>

            </div>


            {{-- ALERT --}}
            @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

            @endif


            @if(session('error'))

            <div class="alert alert-danger">
                {{ session('error') }}
            </div>

            @endif


            {{-- TABLE --}}
            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>
                            <th>No</th>
                            <th>Nomor Surat</th>
                            <th>Kegiatan</th>
                            <th>Pegawai</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th width="100">Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($suratTugas as $surat)

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

                            <td>

                                <a href="{{ route('pimpinan.surat-tugas.detail', $surat->id) }}"
                                    class="btn btn-sm btn-orange">
                                    Detail
                                </a>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="text-center text-muted py-5" style="background: #1b1b1b;">

                                Belum ada Surat Tugas.

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