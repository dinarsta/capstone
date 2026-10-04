<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Display Informasi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
          rel="stylesheet">

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #050a0f;
            color: white;
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
        }

        .display-screen {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .display-header {
            padding: 25px 40px;
            border-bottom: 1px solid #263545;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .display-title {
            font-size: 30px;
            font-weight: 700;
        }

        .display-clock {
            font-size: 25px;
            color: #ffb52e;
        }

        .display-content {
            flex: 1;
            padding: 35px 40px;
        }

        .display-card {
            background: #101b27;
            border: 1px solid #263545;
            border-radius: 18px;
            padding: 25px;
            height: 100%;
        }

        .agenda-title {
            font-size: 24px;
            font-weight: 600;
            color: #ffb52e;
        }

        .agenda-item {
            padding: 18px 0;
            border-bottom: 1px solid #263545;
        }

        .agenda-name {
            font-size: 20px;
            font-weight: 600;
        }

        .agenda-info {
            color: #91a4b7;
            font-size: 15px;
        }

        .running-text {
            background: #ffb52e;
            color: #111;
            padding: 12px 0;
            overflow: hidden;
            white-space: nowrap;
        }

        .running-text span {
            display: inline-block;
            padding-left: 100%;
            animation: jalan 20s linear infinite;
        }

        @keyframes jalan {

            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }

        }

    </style>

</head>

<body>

<div class="display-screen">

    <header class="display-header">

        <div>
            <div class="display-title">
                INFORMASI & KEGIATAN
            </div>

            <small class="text-secondary">
                Display Informasi
            </small>
        </div>

        <div class="display-clock"
             id="clock">
        </div>

    </header>


    <main class="display-content">

        <div class="display-card">

            <div class="agenda-title mb-3">
                AGENDA HARI INI
            </div>

            @forelse($agendas as $agenda)

                <div class="agenda-item">

                    <div class="agenda-name">
                        {{ $agenda->judul }}
                    </div>

                    <div class="agenda-info">

                        {{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('l, d F Y') }}

                        @if($agenda->waktu)
                            • {{ $agenda->waktu }}
                        @endif

                        • {{ $agenda->lokasi ?? 'Lokasi belum ditentukan' }}

                    </div>

                </div>

            @empty

                <div class="text-secondary">
                    Tidak ada agenda hari ini.
                </div>

            @endforelse

        </div>

    </main>


    <div class="running-text">

        <span>

            @forelse($teksBerjalans as $teks)

                {{ $teks->teks }} &nbsp;&nbsp;&nbsp; • &nbsp;&nbsp;&nbsp;

            @empty

                Selamat datang di display informasi.

            @endforelse

        </span>

    </div>

</div>


<script>

function updateClock() {

    const now = new Date();

    const time = now.toLocaleTimeString('id-ID', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    });

    document.getElementById('clock').innerText = time;

}

updateClock();

setInterval(updateClock, 1000);

</script>

</body>
</html>