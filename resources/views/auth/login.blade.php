<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login</title>

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

        .login-card {
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

        .register-link {
            color: #ffb52e;
            text-decoration: none;
            font-weight: 500;
        }

        .register-link:hover {
            color: #ffc04d;
            text-decoration: underline;
        }

    </style>

</head>

<body>

<div class="login-card">

    <h3 class="mb-1">
        Login Sistem
    </h3>

    <p class="text-secondary mb-4">
        Informasi & Kegiatan
    </p>


    @if($errors->any())

        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>

    @endif


    <form action="{{ route('login.process') }}"
          method="POST">

        @csrf

        <div class="mb-3">

            <label class="form-label text-white">
                Email
            </label>

            <input
                type="email"
                name="email"
                class="form-control"
                value="{{ old('email') }}"
                required
            >

        </div>


        <div class="mb-4">

            <label class="form-label text-white">
                Password
            </label>

            <input
                type="password"
                name="password"
                class="form-control"
                required
            >

        </div>


        <button
            type="submit"
            class="btn btn-warning w-100"
        >
            Login
        </button>

    </form>


    {{-- REGISTER --}}

    <div class="text-center mt-4">

        <span class="text-secondary">
            Belum punya akun?
        </span>

        <a
            href="{{ route('register') }}"
            class="register-link"
        >
            Daftar
        </a>

    </div>

</div>

</body>

</html>