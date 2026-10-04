<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        body {
            min-height: 100vh;
            background: #050a0f;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
        }

        .register-card {
            width: 400px;
            background: #101b27;
            border: 1px solid #263545;
            border-radius: 15px;
            padding: 30px;
            color: white;
        }

        .form-control {
            background: #0d1723;
            border: 1px solid #2b3a4a;
            color: white;
        }

        .form-control:focus {
            background: #0d1723;
            color: white;
            border-color: #ffb52e;
            box-shadow: none;
        }

        .register-btn {
            background: #ffb52e;
            border: none;
            color: #111;
            font-weight: 600;
        }

        .register-btn:hover {
            background: #ffc04d;
            color: #111;
        }

        .login-link {
            color: #ffb52e;
            text-decoration: none;
        }

        .login-link:hover {
            color: #ffc04d;
            text-decoration: underline;
        }

    </style>

</head>

<body>

<div class="register-card">

    <h3 class="mb-1">
        Register
    </h3>

    <p class="text-secondary mb-4">
        Buat akun sistem
    </p>


    @if($errors->any())

        <div class="alert alert-danger">

            {{ $errors->first() }}

        </div>

    @endif


    <form action="{{ route('register.process') }}"
          method="POST">

        @csrf


        {{-- NAMA --}}

        <div class="mb-3">

            <label class="form-label">
                Nama
            </label>

            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ old('name') }}"
                placeholder="Masukkan nama"
                required
            >

        </div>


        {{-- EMAIL --}}

        <div class="mb-3">

            <label class="form-label">
                Email
            </label>

            <input
                type="email"
                name="email"
                class="form-control"
                value="{{ old('email') }}"
                placeholder="Masukkan email"
                required
            >

        </div>


        {{-- PASSWORD --}}

        <div class="mb-3">

            <label class="form-label">
                Password
            </label>

            <input
                type="password"
                name="password"
                class="form-control"
                placeholder="Masukkan password"
                required
            >

        </div>


        {{-- KONFIRMASI PASSWORD --}}

        <div class="mb-4">

            <label class="form-label">
                Konfirmasi Password
            </label>

            <input
                type="password"
                name="password_confirmation"
                class="form-control"
                placeholder="Ulangi password"
                required
            >

        </div>


        <button
            type="submit"
            class="btn register-btn w-100"
        >
            Daftar
        </button>

    </form>


    <div class="text-center mt-4">

        <span class="text-secondary">
            Sudah punya akun?
        </span>

        <a
            href="{{ route('login') }}"
            class="login-link"
        >
            Login
        </a>

    </div>

</div>

</body>

</html>