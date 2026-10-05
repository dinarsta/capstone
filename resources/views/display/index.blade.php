<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Display TV — Project</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
    * {
        box-sizing: border-box;
    }

    html,
    body {
        margin: 0;
        width: 100%;
        height: 100%;
    }

    body {
        background: #071019;
        color: #f4f7fa;
        font-family: 'Poppins', sans-serif;
        overflow: hidden;
    }

    .screen {
        width: 100vw;
        height: 100vh;
        display: flex;
        flex-direction: column;
    }


    /* =========================
           JAM
        ========================= */

    .clock {
        position: absolute;
        top: 20px;
        right: 45px;

        color: #36d7a4;

        font-size: 30px;
        font-weight: 700;

        letter-spacing: 1px;

        z-index: 20;
    }


    /* =========================
           PROJECT
        ========================= */

    .project-wrapper {
        flex: 1;
        min-height: 0;

        padding: 25px 3.5vw 15px;
    }

    .project-card {
        width: 100%;
        height: 100%;

        background: #101c29;

        border: 1px solid #233344;
        border-radius: 18px;

        padding: 18px 22px 12px;

        display: flex;
        flex-direction: column;

        overflow: hidden;
    }


    /* =========================
           HEADER PROJECT
        ========================= */

    .project-header {
        display: flex;
        align-items: center;
        justify-content: space-between;

        padding-bottom: 10px;
    }

    .project-title {
        display: flex;
        align-items: center;

        gap: 12px;

        font-size: 27px;
        font-weight: 800;
    }

    .project-title::before {
        content: "";

        width: 13px;
        height: 32px;

        border-radius: 5px;

        background: #36d7a4;
    }

    .project-count {
        padding: 7px 16px;

        border-radius: 20px;

        background: #1b2b3c;

        color: #b9c7d4;

        font-size: 16px;
    }

    .project-count strong {
        color: white;
        font-size: 17px;
    }


    /* =========================
           GRID
        ========================= */

    .project-grid {
        flex: 1;
        min-height: 0;

        display: grid;

        grid-template-columns: 1fr 1fr;

        column-gap: 45px;

        overflow: hidden;
    }

    .project-column {
        min-width: 0;
        overflow: hidden;
    }


    /* =========================
           PROJECT ITEM
        ========================= */

    .project-item {
        padding: 7px 0 10px;

        border-bottom: 1px solid #263746;

        min-height: 72px;
    }

    .project-top {
        display: flex;

        align-items: center;

        gap: 12px;
    }

    .project-number {
        width: 25px;

        color: #8fa1b3;

        font-size: 13px;

        font-weight: 600;

        text-align: center;
    }

    .project-name {
        flex: 1;

        min-width: 0;

        color: #f4f7fa;

        font-size: 16px;

        font-weight: 700;

        white-space: nowrap;

        overflow: hidden;

        text-overflow: ellipsis;
    }

    .project-percent {
        color: #36d7a4;

        font-size: 14px;

        font-weight: 700;
    }


    /* =========================
           PROGRESS
        ========================= */

    .progress-track {
        margin:

            6px 0 7px 37px;

        height: 7px;

        background: #263543;

        border-radius: 10px;

        overflow: hidden;
    }

    .progress-bar {
        height: 100%;

        background: #36d7a4;

        border-radius: 10px;
    }


    /* =========================
           INFO
        ========================= */

    .project-info {
        margin-left: 37px;

        display: flex;

        gap: 25px;

        align-items: center;

        white-space: nowrap;

        overflow: hidden;
    }

    .info-group {
        display: flex;

        align-items: center;

        gap: 7px;

        min-width: 0;
    }

    .info-label {
        color: #71879a;

        font-size: 9px;

        font-weight: 700;

        letter-spacing: .4px;
    }

    .info-value {
        color: #e3eaf0;

        font-size: 11px;

        font-weight: 600;

        overflow: hidden;

        text-overflow: ellipsis;
    }


    /* =========================
           EMPTY
        ========================= */

    .empty-project {
        grid-column: 1 / -1;

        display: flex;

        align-items: center;

        justify-content: center;

        color: #718497;

        font-size: 20px;
    }


    /* =========================
           RUNNING TEXT
        ========================= */

    .running-wrapper {

        height: 90px;

        flex-shrink: 0;

        display: flex;

        align-items: stretch;

        border-top: 1px solid #263545;

        background: #0b141d;

        overflow: hidden;
    }


    .running-label {

        width: 170px;

        flex-shrink: 0;

        background: #ffb52e;

        color: #111;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 24px;

        font-weight: 800;

        letter-spacing: .5px;

        clip-path: polygon(0 0,
                100% 0,
                90% 100%,
                0 100%);
    }


    .running-content {

        flex: 1;

        overflow: hidden;

        display: flex;

        align-items: center;

        white-space: nowrap;
    }


    .running-text {

        display: inline-block;

        padding-left: 100%;

        color: #ffffff;

        font-size: 27px;

        font-weight: 600;

        letter-spacing: .3px;

        animation: running 25s linear infinite;
    }


    .running-text span {

        color: #ffb52e;

        margin: 0 25px;

        font-size: 28px;
    }


    @keyframes running {

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

    <div class="screen">


        {{-- JAM --}}

        <div class="clock" id="clock">
            00:00:00
        </div>


        {{-- PROJECT --}}

        <main class="project-wrapper">

            <div class="project-card">


                <div class="project-header">

                    <div class="project-title">
                        SEMUA PROJECT
                    </div>

                    <div class="project-count">

                        <strong>
                            {{ $projects->count() }}
                        </strong>

                        PROJECT

                    </div>

                </div>


                <div class="project-grid">

                    @if($projects->count() > 0)

                    {{-- KIRI --}}

                    <div class="project-column">

                        @foreach(
                        $projects->slice(
                        0,
                        ceil($projects->count() / 2)
                        )
                        as $index => $project
                        )

                        @php

                        $progress = max(
                        0,
                        min(
                        100,
                        (int) $project->progress
                        )
                        );

                        $koordinator =
                        $project->createdBy?->name
                        ?? 'Belum ada';

                        $tim = $project->timProjects
                        ->map(
                        fn ($tim) =>
                        $tim->pegawai?->nama
                        )
                        ->filter()
                        ->implode(', ');

                        @endphp


                        <div class="project-item">

                            <div class="project-top">

                                <div class="project-number">
                                    {{ $index + 1 }}
                                </div>

                                <div class="project-name">
                                    {{ $project->nama_project }}
                                </div>

                                <div class="project-percent">
                                    {{ $progress }}%
                                </div>

                            </div>


                            <div class="progress-track">

                                <div class="progress-bar" style="width: {{ $progress }}%;">
                                </div>

                            </div>


                            <div class="project-info">

                                <div class="info-group">

                                    <span class="info-label">
                                        KOORDINATOR
                                    </span>

                                    <span class="info-value">
                                        {{ $koordinator }}
                                    </span>

                                </div>


                                <div class="info-group">

                                    <span class="info-label">
                                        TIM
                                    </span>

                                    <span class="info-value">

                                        {{ $tim ?: 'Belum ada' }}

                                    </span>

                                </div>

                            </div>

                        </div>

                        @endforeach

                    </div>


                    {{-- KANAN --}}

                    <div class="project-column">

                        @foreach(
                        $projects->slice(
                        ceil($projects->count() / 2)
                        )
                        as $index => $project
                        )

                        @php

                        $progress = max(
                        0,
                        min(
                        100,
                        (int) $project->progress
                        )
                        );

                        $nomor =
                        ceil($projects->count() / 2)
                        + $index
                        + 1;

                        $koordinator =
                        $project->createdBy?->name
                        ?? 'Belum ada';

                        $tim = $project->timProjects
                        ->map(
                        fn ($tim) =>
                        $tim->pegawai?->nama
                        )
                        ->filter()
                        ->implode(', ');

                        @endphp


                        <div class="project-item">

                            <div class="project-top">

                                <div class="project-number">
                                    {{ $nomor }}
                                </div>

                                <div class="project-name">
                                    {{ $project->nama_project }}
                                </div>

                                <div class="project-percent">
                                    {{ $progress }}%
                                </div>

                            </div>


                            <div class="progress-track">

                                <div class="progress-bar" style="width: {{ $progress }}%;">
                                </div>

                            </div>


                            <div class="project-info">

                                <div class="info-group">

                                    <span class="info-label">
                                        KOORDINATOR
                                    </span>

                                    <span class="info-value">
                                        {{ $koordinator }}
                                    </span>

                                </div>


                                <div class="info-group">

                                    <span class="info-label">
                                        TIM
                                    </span>

                                    <span class="info-value">

                                        {{ $tim ?: 'Belum ada' }}

                                    </span>

                                </div>

                            </div>

                        </div>

                        @endforeach

                    </div>

                    @else

                    <div class="empty-project">

                        Belum ada project yang tersedia.

                    </div>

                    @endif

                </div>

            </div>

        </main>


        {{-- TEKS BERJALAN --}}

        <footer class="running-wrapper">

            <div class="running-label">
                INFO
            </div>


            <div class="running-content">

                <div class="running-text">

                    @forelse($teksBerjalans as $teks)

                    {{ $teks->teks }}

                    <span>•</span>

                    @empty

                    Selamat datang di Display Informasi

                    <span>•</span>

                    Pusat Informasi dan Kegiatan

                    <span>•</span>

                    Bagi yang bertugas harap selalu menyampaikan laporan kepada Admin

                    @endforelse

                </div>

            </div>

        </footer>

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