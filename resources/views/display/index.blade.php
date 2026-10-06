<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    :root {
        --bg: #07111c;
        --panel: #101d2c;
        --panel-2: #14263a;
        --card: #142333;
        --line: #203449;
        --text: #edf3f8;
        --muted: #71869a;
        --accent: #35d7a0;
        --amber: #f0b52f;
    }

    body {
        background:
            radial-gradient(circle at 20% 10%, rgba(43, 211, 160, .07), transparent 30%),
            radial-gradient(circle at 90% 90%, rgba(65, 105, 225, .08), transparent 35%),
            var(--bg);
        color: var(--text);
        font-family: Arial, Helvetica, sans-serif;
        min-height: 100vh;
    }

    /* ---------- Header ---------- */
    .display-header {
        background: linear-gradient(90deg, var(--panel-2), #112133);
        border-bottom: 1px solid var(--line);
    }

    .header-line {
        width: 6px;
        height: 2.4rem;
        background: linear-gradient(180deg, #43e6b0, #24c894);
        box-shadow: 0 0 16px rgba(50, 217, 160, .35);
    }

    .header-title {
        font-size: clamp(1.1rem, 1rem + 1vw, 1.7rem);
        letter-spacing: .05em;
    }

    .header-subtitle {
        color: var(--muted);
        font-size: .65rem;
        letter-spacing: .12em;
    }

    .clock {
        color: #48e3b1;
        font-size: clamp(1.1rem, 1rem + 1vw, 1.7rem);
        letter-spacing: .06em;
        font-variant-numeric: tabular-nums;
        line-height: 1;
    }

    .clock-label,
    .count-label {
        color: var(--muted);
        font-size: .6rem;
        letter-spacing: .1em;
    }

    .project-count {
        background: #1a2c40;
        border: 1px solid #294057;
        min-width: 5.5rem;
    }

    /* ---------- Grid ---------- */
    .project-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: .6rem;
    }

    .project-card {
        position: relative;
        background: linear-gradient(135deg, rgba(20, 35, 51, .95), rgba(14, 27, 41, .95));
        border: 1px solid var(--line);
        overflow: hidden;
        min-width: 0;
    }

    .project-card::before {
        content: "";
        position: absolute;
        inset: 0 auto 0 0;
        width: 3px;
        background: var(--accent);
        opacity: .75;
    }

    .project-image {
        width: clamp(2.8rem, 2rem + 3vw, 4.2rem);
        aspect-ratio: 1;
        background: linear-gradient(145deg, #0d1a29, #122337);
        border: 1px solid #2a4055;
    }

    .project-image img {
        width: 100%;
        height: 100%;
        padding: 5px;
        object-fit: contain;
    }

    .no-image {
        color: #52687c;
        font-size: .5rem;
        letter-spacing: .05em;
        text-align: center;
    }

    .project-number {
        width: 1.6rem;
        height: 1.6rem;
        background: #1a3044;
        border: 1px solid #29465c;
        color: #7990a5;
        font-size: .7rem;
    }

    .project-name {
        font-size: clamp(.85rem, .75rem + .5vw, 1.1rem);
    }

    .project-percent {
        color: #45dfac;
        font-size: clamp(.8rem, .7rem + .4vw, 1rem);
    }

    .project-card .progress {
        height: 6px;
        background: #263746;
    }

    .project-card .progress-bar {
        background: linear-gradient(90deg, #25c993, #46e5b1);
        box-shadow: 0 0 9px rgba(50, 217, 160, .25);
    }

    .info-label {
        color: #526a7f;
        font-size: .6rem;
        letter-spacing: .05em;
    }

    .info-value {
        color: #b8c7d4;
        font-size: clamp(.7rem, .65rem + .25vw, .85rem);
        max-width: 12rem;
    }

    /* ---------- Running text ---------- */
    .running-wrapper {
        background: linear-gradient(90deg, #0b1723, #09131e);
        border-top: 1px solid #233749;
        height: clamp(2.8rem, 2rem + 2vw, 4rem);
        z-index: 10;
    }

    .running-label {
        width: clamp(5rem, 4rem + 6vw, 9rem);
        background: linear-gradient(135deg, #f7bc3d, #e9a925);
        color: #111820;
        letter-spacing: .05em;
        clip-path: polygon(0 0, 100% 0, 88% 100%, 0 100%);
    }

    .running-track {
        animation: marquee 28s linear infinite;
    }

    .running-text {
        font-size: clamp(.9rem, .8rem + .6vw, 1.2rem);
        padding-right: 4rem;
    }

    .running-text::after {
        content: "◆";
        color: var(--amber);
        font-size: .5rem;
        margin-left: 2rem;
        vertical-align: middle;
    }

    @keyframes marquee {
        from {
            transform: translateX(100%);
        }

        to {
            transform: translateX(-100%);
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .running-track {
            animation: none;
        }
    }

    /* ---------- Tablet & TV (lg ke atas): satu layar penuh, 2 kolom ---------- */
    @media (min-width: 992px) {

        html,
        body {
            height: 100%;
            overflow: hidden;
        }

        .display-root {
            height: 100vh;
        }

        .project-grid {
            grid-template-columns: 1fr 1fr;
            grid-auto-flow: column;
            grid-template-rows: repeat(var(--rows, 1), minmax(0, 1fr));
            column-gap: 1.1rem;
            height: 100%;
        }

        .project-card {
            min-height: 0;
        }
    }
    </style>
</head>

<body>

    <div class="container-fluid px-0 d-flex flex-column min-vh-100 display-root">

        <div class="px-2 px-md-3 px-xl-4 d-flex flex-column flex-grow-1" style="min-height:0">

            {{-- PANEL --}}
            <main class="d-flex flex-column flex-grow-1 rounded-bottom-4 overflow-hidden border border-top-0 shadow-lg"
                style="background:linear-gradient(135deg,#101d2c,#0d1927);border-color:var(--line)!important;min-height:0">

                {{-- HEADER --}}
                <header
                    class="display-header d-flex flex-wrap align-items-center justify-content-between gap-2 px-3 px-lg-4 py-2 flex-shrink-0">

                    <div class="d-flex align-items-center gap-3">
                        <div class="header-line rounded-pill"></div>
                        <div>
                            <div class="header-title fw-bolder text-white">SEMUA PROJECT</div>
                            <div class="header-subtitle fw-semibold d-none d-sm-block">MONITORING PROJECT</div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 gap-lg-4">
                        <div class="text-end">
                            <div id="clock" class="clock fw-bolder">00:00:00</div>
                            <div class="clock-label fw-bold mt-1 d-none d-sm-block">WAKTU SEKARANG</div>
                        </div>

                        <div class="project-count rounded-3 px-3 py-2 text-center">
                            <span class="d-block fw-bolder text-white fs-6 lh-1">{{ $projects->count() }}</span>
                            <span class="count-label d-block fw-bold mt-1">PROJECT AKTIF</span>
                        </div>
                    </div>
                </header>

                {{-- PROJECT AREA --}}
                <section class="flex-grow-1 p-2 p-lg-3 overflow-auto overflow-lg-hidden" style="min-height:0">

                    @if ($projects->count() > 0)
                    @php $half = (int) ceil($projects->count() / 2); @endphp

                    <div class="project-grid" style="--rows: {{ $half }}">

                        @foreach ($projects as $project)
                        @php
                        $progress = min(max((int) ($project->progress ?? 0), 0), 100);

                        $timNames = $project->timProjects
                        ->map(fn($tim) => $tim->pegawai->nama ?? null)
                        ->filter()
                        ->implode(', ');
                        @endphp

                        <article
                            class="project-card d-flex align-items-center gap-2 gap-md-3 rounded-3 px-2 px-md-3 py-2">

                            {{-- LOGO --}}
                            <div
                                class="project-image d-flex align-items-center justify-content-center flex-shrink-0 rounded-3 overflow-hidden">
                                @if ($project->slides && $project->slides->count() > 0)
                                <img src="{{ asset('storage/' . $project->slides->first()->gambar) }}"
                                    alt="{{ $project->nama_project }}">
                                @else
                                <div class="no-image fw-bold">NO IMAGE</div>
                                @endif
                            </div>

                            {{-- DETAIL --}}
                            <div class="flex-grow-1 min-w-0" style="min-width:0">

                                <div class="d-flex align-items-center gap-2">
                                    <div
                                        class="project-number d-flex align-items-center justify-content-center flex-shrink-0 rounded-2 fw-bold">
                                        {{ $loop->iteration }}
                                    </div>
                                    <div class="project-name flex-grow-1 fw-bolder text-white text-truncate"
                                        title="{{ $project->nama_project }}">
                                        {{ $project->nama_project }}
                                    </div>
                                    <div class="project-percent fw-bolder flex-shrink-0 text-end">
                                        {{ $progress }}%
                                    </div>
                                </div>

                                <div class="progress rounded-pill mt-2" role="progressbar"
                                    aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar rounded-pill" style="width: {{ $progress }}%"></div>
                                </div>

                                <div class="d-flex flex-wrap column-gap-3 row-gap-1 mt-2">
                                    <div class="d-flex align-items-center gap-1 min-w-0" style="min-width:0">
                                        <span class="info-label fw-bold">KOORDINATOR</span>
                                        <span class="info-value fw-bold text-truncate">
                                            {{ $project->createdBy->name ?? '-' }}
                                        </span>
                                    </div>

                                    <div class="d-flex align-items-center gap-1 min-w-0" style="min-width:0">
                                        <span class="info-label fw-bold">TIM</span>
                                        <span class="info-value fw-bold text-truncate" title="{{ $timNames }}">
                                            {{ $timNames ?: '-' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>
                    @else
                    <div
                        class="h-100 d-flex align-items-center justify-content-center text-center text-secondary fs-5 py-5">
                        Belum ada project yang tersedia.
                    </div>
                    @endif

                </section>
            </main>
        </div>

        {{-- RUNNING TEXT --}}
        <footer class="running-wrapper d-flex align-items-center flex-shrink-0 mt-2 sticky-bottom">
            <div class="running-label d-flex align-items-center justify-content-center fw-bolder flex-shrink-0 h-100">
                INFO
            </div>

            <div class="flex-grow-1 h-100 overflow-hidden d-flex align-items-center" style="min-width:0">
                <div class="running-track d-inline-flex align-items-center text-nowrap">
                    @forelse ($teksBerjalans as $teks)
                    <span class="running-text fw-bold">{{ $teks->teks }}</span>
                    @empty
                    <span class="running-text fw-bold">Pusat Informasi dan Kegiatan</span>
                    @endforelse
                </div>
            </div>
        </footer>

    </div>

    <script>
    function updateClock() {
        const el = document.getElementById('clock');
        if (el) {
            el.textContent = new Date().toLocaleTimeString('id-ID', {
                    hour12: false
                })
                .replace(/\./g, ':');
        }
    }
    updateClock();
    setInterval(updateClock, 1000);
    </script>

</body>

</html>