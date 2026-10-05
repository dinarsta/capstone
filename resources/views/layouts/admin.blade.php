<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Panel Admin')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        background: #050a0f;
        color: #dbe5f0;
        font-family: 'Poppins', sans-serif;
    }

    .admin-wrapper {
        max-width: 1180px;
        margin: 25px auto;
        background: #101b27;
        border: 1px solid #263545;
        min-height: calc(100vh - 50px);
    }

    .brand-logo {
        width: 300px;
        height: auto;
    }

    .admin-header {
        padding: 18px 22px;
        border-bottom: 1px solid #263545;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .brand-logo {
        width: 44px;
        height: 44px;
        object-fit: contain;
    }

    .brand-title {
        font-size: 22px;
        font-weight: 700;
        color: #edf4fb;
    }

    .brand-subtitle {
        font-size: 14px;
        color: #8194aa;
        margin-left: 8px;
    }

    .header-actions {
        display: flex;
        gap: 8px;
    }

    .btn-dark-custom {
        background: transparent;
        border: 1px solid #354658;
        color: #dbe5f0;
        padding: 9px 15px;
        border-radius: 9px;
        font-size: 13px;
        text-decoration: none;
    }

    .btn-dark-custom:hover {
        background: #1b2938;
        color: white;
    }

    .btn-orange {
        background: #ffb52e;
        border: 0;
        color: #111;
        padding: 10px 18px;
        border-radius: 9px;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-orange:hover {
        background: #ffc04d;
        color: #111;
    }

    .admin-tabs {
        display: flex;
        padding: 0 18px;
        border-bottom: 1px solid #263545;
        overflow-x: auto;
    }

    .admin-tabs a {
        color: #8fa4bb;
        text-decoration: none;
        padding: 17px 20px 14px;
        font-size: 14px;
        border-bottom: 3px solid transparent;
        white-space: nowrap;
    }

    .admin-tabs a:hover,
    .admin-tabs a.active {
        color: #ffb52e;
    }

    .admin-tabs a.active {
        border-bottom-color: #ffb52e;
    }

    .admin-content {
        padding: 18px;
    }

    .content-card {
        background: #0d1723;
        border: 1px solid #263545;
        border-radius: 16px;
        padding: 20px;
    }

    .page-title {
        font-size: 18px;
        font-weight: 600;
        color: #e9f1f8;
    }

    .form-label {
        color: #8fa8c0;
        font-size: 13px;
    }

    .form-control,
    .form-select {
        background: #0d1723;
        border: 1px solid #2b3a4a;
        color: #e6eef6;
        border-radius: 9px;
        padding: 10px 12px;
    }

    .form-control:focus,
    .form-select:focus {
        background: #0d1723;
        color: white;
        border-color: #ffb52e;
        box-shadow: none;
    }

    .form-control::placeholder {
        color: #607388;
    }

    .table-custom {
        width: 100%;
        border-collapse: collapse;
    }

    .table-custom th {
        color: #8198b0;
        font-size: 12px;
        font-weight: 500;
        text-transform: uppercase;
        padding: 13px 12px;
        border-bottom: 1px solid #263545;
    }

    .table-custom td {
        padding: 14px 12px;
        border-bottom: 1px solid #202f3e;
        font-size: 13px;
        vertical-align: middle;
    }

    .modal-content {
        background: #101b27 !important;
        border: 1px solid #263545 !important;
        color: #dbe5f0;
        border-radius: 14px;
    }

    .modal-header,
    .modal-footer {
        border-color: #263545 !important;
    }

    .status {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 6px;
        font-size: 11px;
    }

    .status-draft {
        background: #29343f;
        color: #bdc8d2;
    }

    .status-diajukan {
        background: #453817;
        color: #ffca55;
    }

    .status-disetujui {
        background: #173b2b;
        color: #67d89a;
    }

    .status-ditolak {
        background: #401f23;
        color: #ed7e87;
    }

    .modal-title {
        font-size: 17px;
        font-weight: 600;
    }

    @media(max-width:768px) {
        .admin-wrapper {
            margin: 0;
        }

        .admin-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .header-actions {
            overflow-x: auto;
            width: 100%;
        }
    }
    </style>

    @stack('styles')
</head>

<body>

    <div class="admin-wrapper">

        <header class="admin-header">

            <div class="brand">

                <img src="{{ asset('logo.png') }}" class="brand-logo">

                <div>
                    <span class="brand-title">PANEL ADMIN</span>
                    <span class="brand-subtitle">Informasi & Kegiatan</span>
                </div>

            </div>

            <div class="header-actions">

                <a href="#" class="btn-dark-custom">
                    Ganti Password
                </a>

                <a href="#" class="btn-dark-custom">
                    Reset Data
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn-dark-custom">
                        Logout
                    </button>
                </form>

                <a href="{{ route('display') }}" target="_blank" class="btn-orange">
                    Lihat Display
                </a>

            </div>

        </header>

        <nav class="admin-tabs">

            <a href="{{ route('admin.agenda.index') }}"
                class="{{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}">
                Agenda
            </a>


            <a href="{{ route('admin.pegawai.index') }}"
                class="{{ request()->routeIs('admin.pegawai.*') ? 'active' : '' }}">
                Petugas
            </a>

            <a href="{{ route('admin.surat-tugas.index') }}"
                class="{{ request()->routeIs('admin.surat-tugas.*') ? 'active' : '' }}">
                Bertugas
            </a>

            <a href="{{ route('admin.project.index') }}"
                class="{{ request()->routeIs('admin.project.*') ? 'active' : '' }}">
                Project
            </a>
            <a href="{{ route('admin.tim-project.index') }}"
                class="{{ request()->routeIs('admin.tim-project.*') ? 'active' : '' }}">
                Tim Project
            </a>

            <a href="{{ route('admin.teks-berjalan.index') }}"
                class="{{ request()->routeIs('admin.teks-berjalan.*') ? 'active' : '' }}">
                Teks Berjalan
            </a>

            <a href="{{ route('admin.slide-display.index') }}"
                class="{{ request()->routeIs('admin.slide-display.*') ? 'active' : '' }}">
                Slide Display
            </a>

        </nav>

        <main class="admin-content">

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

            @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
            @endif

            @yield('content')

        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>

</html>