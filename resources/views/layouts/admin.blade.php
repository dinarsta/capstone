<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Panel Admin')</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- POPPINS -->
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

    /* =====================================================
           ADMIN WRAPPER
        ===================================================== */

    .admin-wrapper {
        max-width: 1180px;
        margin: 25px auto;
        background: #101b27;
        border: 1px solid #263545;
        min-height: calc(100vh - 50px);
    }

    /* =====================================================
           HEADER
        ===================================================== */

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

    /* =====================================================
           HEADER BUTTON
        ===================================================== */

    .header-actions {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .btn-dark-custom {
        background: transparent;
        border: 1px solid #354658;
        color: #dbe5f0;

        padding: 9px 15px;

        border-radius: 9px;

        font-size: 13px;
        font-family: 'Poppins', sans-serif;

        text-decoration: none;

        cursor: pointer;

        transition: .2s ease;
    }

    .btn-dark-custom:hover {
        background: #1b2938;
        border-color: #465b70;
        color: white;
    }

    .btn-orange {
        background: #ffb52e;
        border: 0;

        color: #111;

        padding: 10px 18px;

        border-radius: 9px;

        font-weight: 600;
        font-size: 13px;

        text-decoration: none;

        cursor: pointer;

        transition: .2s ease;
    }

    .btn-orange:hover {
        background: #ffc04d;
        color: #111;
    }

    .btn-danger-custom {
        background: #b8323c;
        border: 0;

        color: #fff;

        padding: 10px 18px;

        border-radius: 9px;

        font-weight: 600;
        font-size: 13px;

        cursor: pointer;

        transition: .2s ease;
    }

    .btn-danger-custom:hover {
        background: #d9434d;
        color: #fff;
    }

    /* =====================================================
           NAVIGATION
        ===================================================== */

    .admin-tabs {
        display: flex;

        padding: 0 18px;

        border-bottom: 1px solid #263545;

        overflow-x: auto;

        scrollbar-width: thin;
    }

    .admin-tabs a {
        color: #8fa4bb;

        text-decoration: none;

        padding: 17px 20px 14px;

        font-size: 14px;

        border-bottom: 3px solid transparent;

        white-space: nowrap;

        transition: .2s ease;
    }

    .admin-tabs a:hover,
    .admin-tabs a.active {
        color: #ffb52e;
    }

    .admin-tabs a.active {
        border-bottom-color: #ffb52e;
    }

    /* =====================================================
           CONTENT
        ===================================================== */

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

    /* =====================================================
           FORM
        ===================================================== */

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

    /* =====================================================
           TABLE
        ===================================================== */

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

    /* =====================================================
           MODAL
        ===================================================== */

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

    .modal-title {
        font-size: 17px;

        font-weight: 600;
    }

    .btn-close-white {
        filter: invert(1) grayscale(100%) brightness(200%);
    }

    /* =====================================================
           STATUS
        ===================================================== */

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

    /* =====================================================
           RESET WARNING
        ===================================================== */

    .reset-warning {
        display: flex;

        gap: 15px;

        padding: 15px;

        background: #24171a;

        border: 1px solid #51282d;

        border-radius: 10px;
    }

    .reset-icon {
        width: 42px;
        height: 42px;

        min-width: 42px;

        display: flex;

        align-items: center;
        justify-content: center;

        background: #401f23;

        color: #ed7e87;

        border-radius: 50%;

        font-size: 19px;

        font-weight: 700;
    }

    .reset-warning h6 {
        color: #f2f5f8;

        margin-bottom: 5px;

        font-size: 14px;
    }

    .reset-warning p {
        color: #9aabba;

        font-size: 13px;

        margin-bottom: 5px;

        line-height: 1.6;
    }

    /* =====================================================
           SUCCESS MESSAGE
        ===================================================== */

    .custom-message {
        font-size: 13px;
    }

    /* =====================================================
           MOBILE
        ===================================================== */

    @media(max-width: 768px) {

        .admin-wrapper {
            margin: 0;

            min-height: 100vh;

            border-left: 0;
            border-right: 0;
        }

        .admin-header {
            flex-direction: column;

            align-items: flex-start;
        }

        .brand {
            width: 100%;
        }

        .brand-title {
            font-size: 18px;
        }

        .brand-subtitle {
            display: block;

            margin-left: 0;

            font-size: 12px;
        }

        .header-actions {
            width: 100%;

            overflow-x: auto;

            padding-bottom: 3px;
        }

        .header-actions>* {
            flex-shrink: 0;
        }

        .admin-tabs {
            padding: 0 8px;
        }

        .admin-tabs a {
            padding: 15px 13px 12px;

            font-size: 12px;
        }

        .admin-content {
            padding: 12px;
        }

        .content-card {
            padding: 15px;

            border-radius: 12px;
        }

        .reset-warning {
            gap: 10px;
        }
    }
    </style>

    @stack('styles')

</head>


<body>


    <div class="admin-wrapper">


        <!-- =====================================================
             HEADER
        ====================================================== -->

        <header class="admin-header">


            <!-- BRAND -->

            <div class="brand">

                <img src="{{ asset('logo.png') }}" class="brand-logo" alt="Logo">

                <div>

                    <span class="brand-title">
                        PANEL ADMIN
                    </span>

                    <span class="brand-subtitle">
                        Informasi & Kegiatan
                    </span>

                </div>

            </div>


            <!-- HEADER ACTIONS -->

            <div class="header-actions">


                <!-- LUPA PASSWORD -->

                <button type="button" class="btn-dark-custom" onclick="openForgotPassword()">
                    Lupa Password
                </button>


                <!-- RESET DATA -->

                <button type="button" class="btn-dark-custom" onclick="openResetData()">
                    Reset Data
                </button>


                <!-- LOGOUT -->

                <form action="{{ route('logout') }}" method="POST" style="margin:0;">

                    @csrf

                    <button type="submit" class="btn-dark-custom">
                        Logout
                    </button>

                </form>


                <!-- DISPLAY -->

                <a href="{{ route('display') }}" target="_blank" class="btn-orange">
                    Lihat Display
                </a>


            </div>

        </header>


        <!-- =====================================================
             NAVIGATION
        ====================================================== -->

        <nav class="admin-tabs">


            <!-- AGENDA -->

            <a href="{{ route('admin.agenda.index') }}"
                class="{{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}">
                Agenda
            </a>


            <!-- PETUGAS -->

            <a href="{{ route('admin.pegawai.index') }}"
                class="{{ request()->routeIs('admin.pegawai.*') ? 'active' : '' }}">
                Petugas
            </a>


            <!-- BERTUGAS -->

            <a href="{{ route('admin.surat-tugas.index') }}"
                class="{{ request()->routeIs('admin.surat-tugas.*') ? 'active' : '' }}">
                Bertugas
            </a>


            <!-- PROJECT -->

            <a href="{{ route('admin.project.index') }}"
                class="{{ request()->routeIs('admin.project.*') ? 'active' : '' }}">
                Project
            </a>


            <!-- TIM PROJECT -->

            <a href="{{ route('admin.tim-project.index') }}"
                class="{{ request()->routeIs('admin.tim-project.*') ? 'active' : '' }}">
                Tim Project
            </a>


            <!-- TEKS BERJALAN -->

            <a href="{{ route('admin.teks-berjalan.index') }}"
                class="{{ request()->routeIs('admin.teks-berjalan.*') ? 'active' : '' }}">
                Teks Berjalan
            </a>


            <!-- SLIDE DISPLAY -->

            <a href="{{ route('admin.slide-display.index') }}"
                class="{{ request()->routeIs('admin.slide-display.*') ? 'active' : '' }}">
                Slide Display
            </a>


        </nav>


        <!-- =====================================================
             CONTENT
        ====================================================== -->

        <main class="admin-content">


            <!-- SUCCESS -->

            @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

            @endif


            <!-- ERROR -->

            @if(session('error'))

            <div class="alert alert-danger">
                {{ session('error') }}
            </div>

            @endif


            <!-- VALIDATION -->

            @if($errors->any())

            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>

            @endif


            @yield('content')


        </main>


    </div>


    <!-- =========================================================
         MODAL LUPA PASSWORD
    ========================================================== -->

    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">


                <div class="modal-header">

                    <h5 class="modal-title">
                        Lupa Password
                    </h5>

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>

                </div>


                <div class="modal-body">


                    <p style="
                            color:#8fa8c0;
                            font-size:13px;
                            line-height:1.7;
                        ">
                        Masukkan email akun yang digunakan
                        untuk login ke panel admin.
                    </p>


                    <label class="form-label">
                        Email
                    </label>


                    <input type="email" id="forgotEmail" class="form-control" placeholder="contoh@email.com"
                        autocomplete="email">


                    <div id="forgotPasswordMessage" class="mt-3" style="display:none;"></div>


                </div>


                <div class="modal-footer">


                    <button type="button" class="btn-dark-custom" data-bs-dismiss="modal">
                        Batal
                    </button>


                    <button type="button" class="btn-orange" onclick="sendForgotPassword()">
                        Kirim
                    </button>


                </div>


            </div>

        </div>

    </div>


    <!-- =========================================================
         MODAL RESET DATA
    ========================================================== -->

    <div class="modal fade" id="resetDataModal" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">


                <div class="modal-header">

                    <h5 class="modal-title">
                        Reset Data
                    </h5>

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>

                </div>


                <div class="modal-body">


                    <div class="reset-warning">


                        <div class="reset-icon">
                            !
                        </div>


                        <div>

                            <h6>
                                Perhatian
                            </h6>

                            <p>
                                Reset data akan menghapus
                                data sementara yang tersimpan
                                pada browser.
                            </p>

                            <p class="mb-0">
                                Pastikan Anda sudah yakin
                                sebelum melanjutkan.
                            </p>

                        </div>


                    </div>


                    <div id="resetMessage" class="mt-3" style="display:none;"></div>


                </div>


                <div class="modal-footer">


                    <button type="button" class="btn-dark-custom" data-bs-dismiss="modal">
                        Batal
                    </button>


                    <button type="button" class="btn-danger-custom" onclick="confirmResetData()">
                        Ya, Reset Data
                    </button>


                </div>


            </div>

        </div>

    </div>


    <!-- =========================================================
         BOOTSTRAP JS
    ========================================================== -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- =========================================================
         CUSTOM JAVASCRIPT
    ========================================================== -->

    <script>
    /*
        |--------------------------------------------------------------------------
        | MODAL LUPA PASSWORD
        |--------------------------------------------------------------------------
        */

    function openForgotPassword() {

        const emailInput =
            document.getElementById('forgotEmail');

        const message =
            document.getElementById('forgotPasswordMessage');


        // Reset input

        emailInput.value = '';


        // Reset message

        message.style.display = 'none';

        message.innerHTML = '';


        // Tampilkan modal

        const modalElement =
            document.getElementById('forgotPasswordModal');

        const modal =
            new bootstrap.Modal(modalElement);

        modal.show();

    }


    /*
    |--------------------------------------------------------------------------
    | KIRIM LUPA PASSWORD
    |--------------------------------------------------------------------------
    */

    function sendForgotPassword() {

        const emailInput =
            document.getElementById('forgotEmail');

        const message =
            document.getElementById('forgotPasswordMessage');


        const email =
            emailInput.value.trim();


        /*
        | Validasi kosong
        */

        if (email === '') {

            showForgotMessage(
                'Email wajib diisi.',
                'danger'
            );

            emailInput.focus();

            return;
        }


        /*
        | Validasi format email
        */

        if (!validateEmail(email)) {

            showForgotMessage(
                'Format email tidak valid.',
                'danger'
            );

            emailInput.focus();

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | DEMO
        |--------------------------------------------------------------------------
        |
        | Untuk sementara hanya simulasi JavaScript.
        | Jika ingin benar-benar mengirim email reset password,
        | bagian ini harus diarahkan ke route Laravel.
        |
        */

        showForgotMessage(
            'Link reset password akan dikirim ke <strong>' +
            escapeHtml(email) +
            '</strong>.',
            'success'
        );

    }


    /*
    |--------------------------------------------------------------------------
    | MESSAGE LUPA PASSWORD
    |--------------------------------------------------------------------------
    */

    function showForgotMessage(text, type) {

        const message =
            document.getElementById('forgotPasswordMessage');


        message.style.display = 'block';


        message.innerHTML = `
                <div class="alert alert-${type} mb-0 custom-message">
                    ${text}
                </div>
            `;

    }


    /*
    |--------------------------------------------------------------------------
    | VALIDASI EMAIL
    |--------------------------------------------------------------------------
    */

    function validateEmail(email) {

        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

    }


    /*
    |--------------------------------------------------------------------------
    | RESET DATA - BUKA MODAL
    |--------------------------------------------------------------------------
    */

    function openResetData() {

        const message =
            document.getElementById('resetMessage');


        message.style.display = 'none';

        message.innerHTML = '';


        const modalElement =
            document.getElementById('resetDataModal');


        const modal =
            new bootstrap.Modal(modalElement);


        modal.show();

    }


    /*
    |--------------------------------------------------------------------------
    | RESET DATA
    |--------------------------------------------------------------------------
    */

    function confirmResetData() {

        /*
        |--------------------------------------------------------------------------
        | CLEAR LOCAL STORAGE
        |--------------------------------------------------------------------------
        */

        try {

            localStorage.clear();

        } catch (error) {

            console.log(
                'localStorage tidak dapat dihapus.',
                error
            );

        }


        /*
        |--------------------------------------------------------------------------
        | CLEAR SESSION STORAGE
        |--------------------------------------------------------------------------
        */

        try {

            sessionStorage.clear();

        } catch (error) {

            console.log(
                'sessionStorage tidak dapat dihapus.',
                error
            );

        }


        /*
        |--------------------------------------------------------------------------
        | RESET FORM
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll(
                'input:not([type="hidden"]), textarea, select'
            )
            .forEach(function(element) {


                /*
                | Checkbox
                */

                if (
                    element.type === 'checkbox'
                ) {

                    element.checked = false;

                }


                /*
                | Radio
                */
                else if (
                    element.type === 'radio'
                ) {

                    element.checked = false;

                }


                /*
                | Input lainnya
                */
                else {

                    element.value = '';

                }

            });


        /*
        |--------------------------------------------------------------------------
        | RESET MESSAGE
        |--------------------------------------------------------------------------
        */

        const message =
            document.getElementById('resetMessage');


        message.style.display = 'block';


        message.innerHTML = `
                <div class="alert alert-success mb-0 custom-message">
                    Data sementara berhasil direset.
                </div>
            `;


        /*
        |--------------------------------------------------------------------------
        | TUTUP MODAL
        |--------------------------------------------------------------------------
        */

        setTimeout(function() {


            const modalElement =
                document.getElementById('resetDataModal');


            const modal =
                bootstrap.Modal.getInstance(
                    modalElement
                );


            if (modal) {

                modal.hide();

            }


        }, 1200);

    }


    /*
    |--------------------------------------------------------------------------
    | ESCAPE HTML
    |--------------------------------------------------------------------------
    */

    function escapeHtml(text) {

        const div =
            document.createElement('div');

        div.textContent = text;

        return div.innerHTML;

    }


    /*
    |--------------------------------------------------------------------------
    | ENTER DI INPUT EMAIL
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'DOMContentLoaded',
        function() {


            const emailInput =
                document.getElementById('forgotEmail');


            if (emailInput) {


                emailInput.addEventListener(
                    'keydown',
                    function(event) {


                        if (event.key === 'Enter') {

                            event.preventDefault();

                            sendForgotPassword();

                        }

                    }
                );

            }

        }
    );
    </script>


    @stack('scripts')

</body>

</html>