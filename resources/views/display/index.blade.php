<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Display Project</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    /* =====================================================
           GLOBAL
        ===================================================== */

    * {
        box-sizing: border-box;
    }

    html,
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
    }

    body {

        background:
            radial-gradient(circle at 20% 10%,
                rgba(43, 211, 160, .07),
                transparent 30%),
            radial-gradient(circle at 90% 90%,
                rgba(65, 105, 225, .08),
                transparent 35%),
            #07111c;

        color: #edf3f8;

        font-family:
            Arial,
            Helvetica,
            sans-serif;

        overflow: hidden;
    }


    /* =====================================================
           MAIN WRAPPER
        ===================================================== */

    .display-wrapper {

        width: 100%;

        height: 100vh;

        padding: 0 42px;

        display: flex;

        flex-direction: column;

    }


    /* =====================================================
           MAIN PANEL
        ===================================================== */

    .display-panel {

        flex: 1;

        min-height: 0;

        background:
            linear-gradient(135deg,
                #101d2c 0%,
                #0d1927 100%);

        border-left: 1px solid #1d3043;

        border-right: 1px solid #1d3043;

        border-bottom: 1px solid #1d3043;

        border-radius:
            0 0 18px 18px;

        overflow: hidden;

        display: flex;

        flex-direction: column;

        box-shadow:
            0 15px 50px rgba(0, 0, 0, .22);

    }


    /* =====================================================
           HEADER
        ===================================================== */

    .display-header {

        height: 76px;

        flex-shrink: 0;

        padding: 0 25px;

        background:
            linear-gradient(90deg,
                #14263a,
                #112133);

        border-bottom:
            1px solid #203449;

        display: flex;

        align-items: center;

        justify-content: space-between;

    }


    .header-title-wrapper {

        display: flex;

        align-items: center;

        gap: 13px;

    }


    .header-line {

        width: 7px;

        height: 38px;

        background:
            linear-gradient(180deg,
                #43e6b0,
                #24c894);

        border-radius: 20px;

        box-shadow:
            0 0 16px rgba(50, 217, 160, .35);

    }


    .header-title {

        color: #ffffff;

        font-size: 25px;

        font-weight: 800;

        letter-spacing: .8px;

    }


    .header-subtitle {

        margin-top: 2px;

        color: #71869a;

        font-size: 9px;

        font-weight: 600;

        letter-spacing: 1.5px;

    }


    /* =====================================================
           HEADER RIGHT
        ===================================================== */

    .header-right {

        display: flex;

        align-items: center;

        gap: 22px;

    }


    /* =====================================================
           CLOCK
        ===================================================== */

    .clock-box {

        display: flex;

        flex-direction: column;

        align-items: flex-end;

        line-height: 1;

    }


    .clock {

        color: #48e3b1;

        font-size: 25px;

        font-weight: 800;

        letter-spacing: 1.5px;

        text-shadow:
            0 0 15px rgba(54, 216, 161, .15);

    }


    .clock-label {

        margin-top: 5px;

        color: #5d7185;

        font-size: 8px;

        font-weight: 700;

        letter-spacing: 1.5px;

    }


    /* =====================================================
           PROJECT COUNTER
        ===================================================== */

    .project-count {

        min-width: 90px;

        padding: 9px 14px;

        background: #1a2c40;

        border:
            1px solid #294057;

        border-radius: 12px;

        text-align: center;

        box-shadow:
            inset 0 1px 0 rgba(255, 255, 255, .03);

    }


    .project-count-number {

        display: block;

        color: #ffffff;

        font-size: 17px;

        font-weight: 800;

        line-height: 1;

    }


    .project-count-label {

        display: block;

        margin-top: 4px;

        color: #71869a;

        font-size: 7px;

        font-weight: 800;

        letter-spacing: 1px;

    }


    /* =====================================================
           PROJECT AREA
        ===================================================== */

    .project-area {

        flex: 1;

        min-height: 0;

        padding: 15px 20px;

        overflow: hidden;

    }


    .project-grid {

        width: 100%;

        height: 100%;

        display: grid;

        grid-template-columns:
            1fr 1fr;

        gap: 18px;

    }


    .project-column {

        min-width: 0;

        height: 100%;

        display: flex;

        flex-direction: column;

        gap: 8px;

    }


    /* =====================================================
           PROJECT CARD
        ===================================================== */

    .project-card {

        flex: 1;

        min-height: 0;

        position: relative;

        display: flex;

        align-items: center;

        gap: 13px;

        padding: 10px 13px;

        background:
            linear-gradient(135deg,
                rgba(20, 35, 51, .95),
                rgba(14, 27, 41, .95));

        border:
            1px solid #203449;

        border-radius: 12px;

        overflow: hidden;

        transition:
            transform .2s ease,
            border-color .2s ease;

    }


    .project-card::before {

        content: "";

        position: absolute;

        left: 0;

        top: 0;

        bottom: 0;

        width: 3px;

        background: #35d7a0;

        opacity: .75;

    }


    .project-card:hover {

        border-color: #31506b;

        transform: translateY(-1px);

    }


    /* =====================================================
           PROJECT LOGO
        ===================================================== */

    .project-image {

        width: 50px;

        height: 50px;

        flex-shrink: 0;

        display: flex;

        align-items: center;

        justify-content: center;

        overflow: hidden;

        background:
            linear-gradient(145deg,
                #0d1a29,
                #122337);

        border:
            1px solid #2a4055;

        border-radius: 11px;

        box-shadow:
            inset 0 1px 0 rgba(255, 255, 255, .03);

    }


    .project-image img {

        width: 100%;

        height: 100%;

        padding: 5px;

        object-fit: contain;

        display: block;

    }


    .no-image {

        color: #52687c;

        font-size: 6px;

        font-weight: 800;

        text-align: center;

        letter-spacing: .5px;

    }


    /* =====================================================
           PROJECT DETAIL
        ===================================================== */

    .project-detail {

        flex: 1;

        min-width: 0;

    }


    /* =====================================================
           TOP ROW
        ===================================================== */

    .project-header-row {

        width: 100%;

        display: flex;

        align-items: center;

        gap: 8px;

    }


    .project-number {

        width: 24px;

        height: 24px;

        flex-shrink: 0;

        display: flex;

        align-items: center;

        justify-content: center;

        background: #1a3044;

        border:
            1px solid #29465c;

        border-radius: 7px;

        color: #7990a5;

        font-size: 8px;

        font-weight: 800;

    }


    .project-name {

        flex: 1;

        min-width: 0;

        color: #f5f8fa;

        font-size: 14px;

        font-weight: 800;

        white-space: nowrap;

        overflow: hidden;

        text-overflow: ellipsis;

    }


    .project-percent {

        min-width: 42px;

        flex-shrink: 0;

        color: #45dfac;

        font-size: 11px;

        font-weight: 800;

        text-align: right;

    }


    /* =====================================================
           PROGRESS
        ===================================================== */

    .project-progress {

        width: 100%;

        margin-top: 8px;

    }


    .project-progress .progress {

        height: 6px;

        background: #263746;

        border-radius: 20px;

        overflow: hidden;

    }


    .project-progress .progress-bar {

        position: relative;

        background:
            linear-gradient(90deg,
                #25c993,
                #46e5b1);

        border-radius: 20px;

        box-shadow:
            0 0 9px rgba(50, 217, 160, .25);

    }


    /* =====================================================
           PROJECT INFO
        ===================================================== */

    .project-info {

        display: flex;

        align-items: center;

        gap: 15px;

        margin-top: 8px;

        min-width: 0;

        overflow: hidden;

    }


    .info-group {

        min-width: 0;

        display: flex;

        align-items: center;

        gap: 5px;

    }


    .info-label {

        color: #526a7f;

        font-size: 7px;

        font-weight: 800;

        letter-spacing: .5px;

    }


    .info-value {

        color: #b8c7d4;

        font-size: 9px;

        font-weight: 700;

        max-width: 170px;

        overflow: hidden;

        text-overflow: ellipsis;

        white-space: nowrap;

    }


    /* =====================================================
           EMPTY
        ===================================================== */

    .empty-project {

        width: 100%;

        height: 100%;

        display: flex;

        align-items: center;

        justify-content: center;

        color: #62778b;

        font-size: 15px;

    }


    /* =====================================================
           RUNNING TEXT
        ===================================================== */

    .running-wrapper {

        height: 66px;

        flex-shrink: 0;

        margin-top: 10px;

        margin-left: -42px;

        margin-right: -42px;

        background:
            linear-gradient(90deg,
                #0b1723,
                #09131e);

        border-top:
            1px solid #233749;

        display: flex;

        align-items: center;

    }


    .running-label {

        width: 145px;

        height: 66px;

        flex-shrink: 0;

        display: flex;

        align-items: center;

        justify-content: center;

        background:
            linear-gradient(135deg,
                #f7bc3d,
                #e9a925);

        color: #111820;

        font-size: 16px;

        font-weight: 900;

        letter-spacing: .8px;

        clip-path:
            polygon(0 0,
                100% 0,
                88% 100%,
                0 100%);

    }


    .running-content {

        flex: 1;

        min-width: 0;

        height: 100%;

        overflow: hidden;

        display: flex;

        align-items: center;

    }


    .running-track {

        display: inline-flex;

        align-items: center;

        white-space: nowrap;

        animation:
            marquee 28s linear infinite;

    }


    .running-text {

        color: #e6edf3;

        font-size: 19px;

        font-weight: 700;

        letter-spacing: .2px;

        padding-right: 90px;

    }


    .running-text::after {

        content: "◆";

        color: #f0b52f;

        font-size: 8px;

        margin-left: 35px;

        vertical-align: middle;

    }


    @keyframes marquee {

        from {
            transform:
                translateX(100%);
        }

        to {
            transform:
                translateX(-100%);
        }

    }


    /* =====================================================
           RESPONSIVE
        ===================================================== */

    @media (max-width: 1100px) {

        .display-wrapper {

            padding-left: 20px;

            padding-right: 20px;

        }

        .running-wrapper {

            margin-left: -20px;

            margin-right: -20px;

        }

        .project-image {

            width: 42px;

            height: 42px;

        }

        .project-name {

            font-size: 12px;

        }

        .info-value {

            max-width: 110px;

        }

    }


    @media (max-width: 800px) {

        .display-wrapper {

            padding-left: 10px;

            padding-right: 10px;

        }

        .running-wrapper {

            margin-left: -10px;

            margin-right: -10px;

        }

        .project-grid {

            grid-template-columns: 1fr;

        }

        .project-column:nth-child(2) {

            display: none;

        }

        .header-subtitle {

            display: none;

        }

    }
    </style>

</head>


<body>


    <div class="display-wrapper">


        {{-- =====================================================
         DISPLAY PANEL
    ====================================================== --}}

        <div class="display-panel">


            {{-- =================================================
             HEADER
        ================================================== --}}

            <div class="display-header">


                {{-- LEFT --}}

                <div class="header-title-wrapper">

                    <div class="header-line"></div>

                    <div>

                        <div class="header-title">
                            SEMUA PROJECT
                        </div>

                        <div class="header-subtitle">
                            MONITORING PROJECT
                        </div>

                    </div>

                </div>


                {{-- RIGHT --}}

                <div class="header-right">


                    {{-- CLOCK --}}

                    <div class="clock-box">

                        <div id="clock" class="clock">
                            00:00:00
                        </div>

                        <div class="clock-label">
                            WAKTU SEKARANG
                        </div>

                    </div>


                    {{-- PROJECT COUNT --}}

                    <div class="project-count">

                        <span class="project-count-number">
                            {{ $projects->count() }}
                        </span>

                        <span class="project-count-label">
                            PROJECT AKTIF
                        </span>

                    </div>


                </div>


            </div>


            {{-- =================================================
             PROJECT AREA
        ================================================== --}}

            <div class="project-area">


                @if($projects->count() > 0)


                @php

                $totalProjects =
                $projects->count();

                $half =
                ceil($totalProjects / 2);

                $leftProjects =
                $projects->slice(
                0,
                $half
                );

                $rightProjects =
                $projects->slice(
                $half
                );

                @endphp


                <div class="project-grid">


                    {{-- =================================================
                         LEFT COLUMN
                    ================================================== --}}

                    <div class="project-column">


                        @foreach(
                        $leftProjects
                        as $index => $project
                        )


                        @php

                        $progress = min(
                        max(
                        (int) (
                        $project->progress
                        ?? 0
                        ),
                        0
                        ),
                        100
                        );

                        $timNames =
                        $project
                        ->timProjects
                        ->map(
                        function ($tim) {

                        return
                        $tim
                        ->pegawai
                        ->nama
                        ?? null;

                        }
                        )
                        ->filter()
                        ->implode(', ');

                        @endphp


                        <div class="project-card">


                            {{-- PROJECT IMAGE --}}

                            <div class="project-image">

                                @if(
                                $project->slides
                                &&
                                $project->slides->count() > 0
                                )

                                <img src="{{ asset(
                                                'storage/' .
                                                $project
                                                    ->slides
                                                    ->first()
                                                    ->gambar
                                            ) }}" alt="{{ $project->nama_project }}">

                                @else

                                <div class="no-image">
                                    NO IMAGE
                                </div>

                                @endif

                            </div>


                            {{-- PROJECT DETAIL --}}

                            <div class="project-detail">


                                {{-- NAME --}}

                                <div class="project-header-row">


                                    <div class="project-number">
                                        {{ $index + 1 }}
                                    </div>


                                    <div class="project-name" title="{{ $project->nama_project }}">
                                        {{ $project->nama_project }}
                                    </div>


                                    <div class="project-percent">
                                        {{ $progress }}%
                                    </div>


                                </div>


                                {{-- PROGRESS --}}

                                <div class="project-progress">

                                    <div class="progress">

                                        <div class="progress-bar" role="progressbar" style="
                                                    width:
                                                    {{ $progress }}%;
                                                "></div>

                                    </div>

                                </div>


                                {{-- INFO --}}

                                <div class="project-info">


                                    <div class="info-group">

                                        <span class="info-label">
                                            KOORDINATOR
                                        </span>

                                        <span class="info-value">
                                            {{
                                                    $project
                                                        ->createdBy
                                                        ->name
                                                    ?? '-'
                                                }}
                                        </span>

                                    </div>


                                    <div class="info-group">

                                        <span class="info-label">
                                            TIM
                                        </span>

                                        <span class="info-value" title="{{ $timNames }}">
                                            {{ $timNames ?: '-' }}
                                        </span>

                                    </div>


                                </div>


                            </div>


                        </div>


                        @endforeach


                    </div>


                    {{-- =================================================
                         RIGHT COLUMN
                    ================================================== --}}

                    <div class="project-column">


                        @foreach(
                        $rightProjects
                        as $index => $project
                        )


                        @php

                        $progress = min(
                        max(
                        (int) (
                        $project->progress
                        ?? 0
                        ),
                        0
                        ),
                        100
                        );

                        $number =
                        $half
                        + $index
                        + 1;

                        $timNames =
                        $project
                        ->timProjects
                        ->map(
                        function ($tim) {

                        return
                        $tim
                        ->pegawai
                        ->nama
                        ?? null;

                        }
                        )
                        ->filter()
                        ->implode(', ');

                        @endphp


                        <div class="project-card">


                            {{-- PROJECT IMAGE --}}

                            <div class="project-image">

                                @if(
                                $project->slides
                                &&
                                $project->slides->count() > 0
                                )

                                <img src="{{ asset(
                                                'storage/' .
                                                $project
                                                    ->slides
                                                    ->first()
                                                    ->gambar
                                            ) }}" alt="{{ $project->nama_project }}">

                                @else

                                <div class="no-image">
                                    NO IMAGE
                                </div>

                                @endif

                            </div>


                            {{-- PROJECT DETAIL --}}

                            <div class="project-detail">


                                {{-- NAME --}}

                                <div class="project-header-row">


                                    <div class="project-number">
                                        {{ $number }}
                                    </div>


                                    <div class="project-name" title="{{ $project->nama_project }}">
                                        {{ $project->nama_project }}
                                    </div>


                                    <div class="project-percent">
                                        {{ $progress }}%
                                    </div>


                                </div>


                                {{-- PROGRESS --}}

                                <div class="project-progress">

                                    <div class="progress">

                                        <div class="progress-bar" role="progressbar" style="
                                                    width:
                                                    {{ $progress }}%;
                                                "></div>

                                    </div>

                                </div>


                                {{-- INFO --}}

                                <div class="project-info">


                                    <div class="info-group">

                                        <span class="info-label">
                                            KOORDINATOR
                                        </span>

                                        <span class="info-value">
                                            {{
                                                    $project
                                                        ->createdBy
                                                        ->name
                                                    ?? '-'
                                                }}
                                        </span>

                                    </div>


                                    <div class="info-group">

                                        <span class="info-label">
                                            TIM
                                        </span>

                                        <span class="info-value" title="{{ $timNames }}">
                                            {{ $timNames ?: '-' }}
                                        </span>

                                    </div>


                                </div>


                            </div>


                        </div>


                        @endforeach


                    </div>


                </div>


                @else


                <div class="empty-project">

                    Belum ada project yang tersedia.

                </div>


                @endif


            </div>


        </div>


        {{-- =====================================================
         RUNNING TEXT
    ====================================================== --}}

        <div class="running-wrapper">


            <div class="running-label">
                INFO
            </div>


            <div class="running-content">


                @if($teksBerjalans->count() > 0)


                <div class="running-track">


                    @foreach(
                    $teksBerjalans
                    as $teks
                    )

                    <span class="running-text">
                        {{ $teks->teks }}
                    </span>

                    @endforeach


                </div>


                @else


                <div class="running-track">

                    <span class="running-text">
                        Pusat Informasi dan Kegiatan
                    </span>

                </div>


                @endif


            </div>


        </div>


    </div>


    {{-- =====================================================
     CLOCK SCRIPT
====================================================== --}}

    <script>
    function updateClock() {

        const now = new Date();


        const hours =
            String(
                now.getHours()
            ).padStart(
                2,
                '0'
            );


        const minutes =
            String(
                now.getMinutes()
            ).padStart(
                2,
                '0'
            );


        const seconds =
            String(
                now.getSeconds()
            ).padStart(
                2,
                '0'
            );


        const clock =
            document.getElementById(
                'clock'
            );


        if (clock) {

            clock.textContent =
                `${hours}:${minutes}:${seconds}`;

        }

    }


    updateClock();


    setInterval(
        updateClock,
        1000
    );
    </script>


</body>

</html>