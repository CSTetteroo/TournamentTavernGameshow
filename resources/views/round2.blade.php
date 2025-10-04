<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tournament Tavern — Game Show</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&family=Bungee+Shade&family=Montserrat:wght@400;700;900&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --bg1: #0b0f1a;
            --bg2: #0f1630;
            --accent: #00e6ff;
            --accent-2: #ff00f3;
            --gold: #ffd166;
            --text: #eaf4ff;
            --glass: rgba(255, 255, 255, 0.08);
            --glass-strong: rgba(255, 255, 255, 0.14);
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
            font-family: Montserrat, system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, 'Helvetica Neue', Arial, sans-serif;
            color: var(--text);
            background: radial-gradient(1200px 600px at 10% -10%, rgba(0, 230, 255, 0.15), transparent 60%),
                radial-gradient(1000px 500px at 110% 10%, rgba(255, 0, 243, 0.12), transparent 60%),
                linear-gradient(135deg, var(--bg1), var(--bg2));
            overflow-x: hidden;
        }

        /* Moving sparkle layer */
        .sparkle {
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: .35;
            background-image:
                radial-gradient(2px 2px at 20% 30%, rgba(255, 255, 255, .6), transparent 60%),
                radial-gradient(2px 2px at 80% 40%, rgba(255, 255, 255, .4), transparent 60%),
                radial-gradient(2px 2px at 50% 70%, rgba(255, 255, 255, .7), transparent 60%);
            animation: twinkle 6s ease-in-out infinite;
            filter: blur(.3px);
        }

        @keyframes twinkle {

            0%,
            100% {
                opacity: .2;
                transform: translateY(0);
            }

            50% {
                opacity: .5;
                transform: translateY(-6px);
            }
        }

        .container {
            min-height: 100dvh;
            display: grid;
            place-items: center;
            padding: clamp(16px, 3vw, 48px);
        }

        .stage {
            width: min(1200px, 100%);
            padding: clamp(20px, 3vw, 40px);
            border-radius: 28px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.14), rgba(255, 255, 255, 0.06));
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.4),
                inset 0 0 0 1px rgba(255, 255, 255, 0.06);
            position: relative;
            overflow: hidden;
        }

        .stage::after {
            content: "";
            position: absolute;
            inset: -2px;
            background: conic-gradient(from 0deg,
                    var(--accent), var(--accent-2), var(--gold), var(--accent), var(--accent-2));
            filter: blur(22px);
            opacity: .15;
            z-index: 0;
            animation: hue 12s linear infinite;
            pointer-events: none;
        }

        @keyframes hue {
            to {
                filter: blur(22px) hue-rotate(360deg);
            }
        }

        header {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: clamp(16px, 2vw, 24px);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            letter-spacing: 1px;
        }

        .logo {
            min-width: 100px;
            height: 100px;
            border-radius: 28px;
            background: radial-gradient(circle at 30% 30%, var(--gold), #e24bff 60%, #5ee7ff 100%);
            box-shadow: 0 0 25px rgba(0, 153, 255, 0.45), 0 0 18px rgba(0, 230, 255, .35) inset;
            background-image: url('{{ asset('img/tt.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .title {
            font-family: 'Orbitron', system-ui, sans-serif;
            font-weight: 900;
            font-size: clamp(20px, 2.6vw, 48px);
            line-height: 1.05;
            text-transform: uppercase;
            text-shadow: 0 0 12px rgba(0, 230, 255, .45), 0 0 24px rgba(255, 0, 243, .25);
        }

        .badge {
            font-family: 'Orbitron', system-ui, sans-serif;
            padding: 10px 14px;
            border-radius: 999px;
            font-weight: 700;
            letter-spacing: .08em;
            font-size: 12px;
            color: #0a0d16;
            background: linear-gradient(90deg, #5eb1ff, #5ee7ff);
            box-shadow: 0 6px 18px rgba(82, 128, 180, 0.35);
        }

        .question-wrap {
            position: relative;
            z-index: 1;
            padding: clamp(16px, 2vw, 28px);
            border-radius: 22px;
            background: var(--glass);
            border: 1px solid rgba(255, 255, 255, 0.14);
            box-shadow: inset 0 0 30px rgba(255, 255, 255, 0.04);
            cursor: pointer;
        }

        .question-wrap:hover {
            box-shadow: inset 0 0 30px rgba(255, 255, 255, 0.06), 0 8px 22px rgba(0, 0, 0, .25);
        }

        .question-wrap:focus-visible {
            outline: 2px solid rgba(87, 241, 255, .8);
            outline-offset: 4px;
        }

        .question-cover {
            display: grid;
            place-items: center;
            gap: 12px;
            text-align: center;
            padding: 12px 4px;
        }

        .question-wrap .question {
            display: none;
        }

        .question-wrap.q-revealed .question-cover {
            display: none;
        }

        .question-wrap.q-revealed .question {
            display: block;
            animation: pop .35s ease;
        }

        .question-label {
            font-family: 'Orbitron', system-ui, sans-serif;
            font-size: 14px;
            letter-spacing: .2em;
            opacity: .9;
            color: #a6c8ff;
        }

        .question {
            margin: 6px 0 0;
            font-weight: 900;
            font-size: clamp(16px, 4.8vw, 46px);
            line-height: 1.05;
            text-shadow: 0 6px 22px rgba(0, 0, 0, .45), 0 0 22px rgba(0, 230, 255, .25);
        }

        .answer-wrap {
            position: relative;
            z-index: 1;
            margin-top: clamp(14px, 2.6vw, 28px);
        }

        .answer-card {
            position: relative;
            border-radius: 20px;
            padding: clamp(18px, 3.2vw, 32px);
            background: linear-gradient(180deg, rgba(10, 14, 30, 0.7), rgba(14, 18, 40, 0.9));
            border: 1px solid rgba(255, 255, 255, 0.16);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35), inset 0 0 0 1px rgba(255, 255, 255, 0.06);
            cursor: pointer;
            user-select: none;
            transition: transform .25s ease, box-shadow .25s ease;
            outline: none;
            overflow: hidden;
            /* ensure shimmer stays within the card */
        }

        .answer-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(0, 0, 0, 0.45), inset 0 0 0 1px rgba(255, 255, 255, 0.08);
        }

        .answer-card:active {
            transform: translateY(0);
        }

        .answer-card::before {
            /* shimmer */
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 20px;
            pointer-events: none;
            background: linear-gradient(120deg, transparent 0%, rgba(255, 255, 255, .18) 15%, transparent 30%);
            transform: translateX(-120%);
            animation: shimmer 4.8s ease-in-out infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-120%);
            }

            35% {
                transform: translateX(120%);
            }

            100% {
                transform: translateX(120%);
            }
        }

        .cta {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-weight: 800;
            letter-spacing: .06em;
            color: #9cd9ff;
            font-size: clamp(16px, 1.6vw, 20px);
            opacity: .95;
        }

        .keycap {
            display: inline-block;
            min-width: 28px;
            text-align: center;
            padding: 6px 10px;
            border-radius: 8px;
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .22);
            box-shadow: inset 0 -1px 0 rgba(255, 255, 255, .25);
            font-family: 'Orbitron', system-ui, sans-serif;
            font-weight: 700;
            color: #e7f3ff;
        }

        .answer {
            display: none;
            font-size: clamp(22px, 3.2vw, 48px);
            font-weight: 800;
            line-height: 1.15;
            color: #ffffff;
            text-shadow: 0 0 22px rgba(255, 0, 243, .35), 0 0 14px rgba(0, 230, 255, .28);
        }

        .answer.revealed {
            display: block;
            animation: pop .35s ease;
        }

        @keyframes pop {
            0% {
                transform: scale(.9);
                opacity: .5;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .reveal-cover {
            display: grid;
            place-items: center;
            gap: 12px;
            text-align: center;
            padding: 12px 4px;
        }

        .reveal-title {
            font-family: 'Orbitron', system-ui, sans-serif;
            font-weight: 900;
            font-size: clamp(18px, 2.2vw, 28px);
            letter-spacing: .1em;
            color: #bde7ff;
            text-transform: uppercase;
        }

        .reveal-sub {
            opacity: .85;
            color: #a4b5ff;
            font-size: clamp(12px, 1.2vw, 14px);
        }

        .reveal-icon {
            width: 40px;
            height: 40px;
            color: #bde7ff;
            filter: drop-shadow(0 0 8px rgba(0, 230, 255, .4));
        }

        .answer-card.revealed .reveal-cover {
            display: none;
        }

        .answer-card.revealed {
            box-shadow: 0 16px 38px rgba(0, 0, 0, 0.55), 0 0 0 3px rgba(0, 230, 255, .25) inset;
        }

        /* Layout with right sidebar */
        .content {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 18px;
            align-items: start;
        }

        @media (max-width: 900px) {
            .content {
                grid-template-columns: 1fr;
            }
        }

        .sidebar {
            position: relative;
            z-index: 1;
            padding: 16px;
            border-radius: 16px;
            background: var(--glass);
            border: 1px solid rgba(255, 255, 255, 0.14);
        }

        .tier {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            padding: 8px 10px;
            border-radius: 10px;
            margin-bottom: 8px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.05);
        }

        .tier.active {
            background: linear-gradient(90deg, rgba(94, 177, 255, .25), rgba(94, 231, 255, .25));
            box-shadow: inset 0 0 0 1px rgba(94, 231, 255, .45);
        }

        .prize {
            font-weight: 800;
            color: #ffd166;
        }

        footer {
            position: relative;
            z-index: 1;
            margin-top: clamp(16px, 2vw, 28px);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .tip {
            color: #b3c5ff;
            opacity: .9;
            font-size: 14px;
        }

        .controls {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            font-family: 'Orbitron', system-ui, sans-serif;
            border: solid;
            border-radius: 12px;
            padding: 10px 14px;
            font-weight: 800;
            letter-spacing: .06em;
            cursor: pointer;
            border-color: #294e70;
            color: #061122;
            background: linear-gradient(90deg, #5eb1ff, #5ee7ff);
            box-shadow: 0 8px 22px rgba(87, 241, 255, .35);
        }

        .btn.secondary {
            color: #dfe9ff;
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .18);
            box-shadow: none;
        }

        .btn.danger {
            background: linear-gradient(90deg, #ff7b7b, #ff5252);
            border-color: #5e2940;
            color: #260a0a;
        }

        .btn.neutral {
            background: rgba(255, 255, 255, .1);
            color: #eaf4ff;
            border-color: #3a4a66;
        }

        .icon-btn {
            padding: 8px 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 0;
        }

        /* Timer */
        .timer {
            display: flex;
            flex-direction: column;
            gap: 8px;
            align-items: flex-start;
        }

        .timer-row {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .timer input {
            width: 110px;
            padding: 8px 10px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            background: rgba(255, 255, 255, 0.06);
            color: var(--text);
        }

        .time-display {
            font-family: 'Orbitron', system-ui, sans-serif;
            font-weight: 900;
            letter-spacing: .08em;
            padding: 8px 12px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            background: rgba(255, 255, 255, 0.06);
        }

        /* Confetti canvas */
        canvas#confetti {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 30;
        }

        @media (max-width: 520px) {
            header {
                flex-direction: column;
                align-items: flex-start;
            }

            .controls {
                width: 100%;
            }

            .btn {
                flex: 1;
            }
        }

        /* Round 2 mini roster (5 players with points) */
        .mini-roster {
            position: fixed; top: 50%; left: 10px; transform: translateY(-50%);
            width: 238px; max-height: 80vh; /* keep height constraint but allow internal focus rings */
            overflow: visible; /* was hidden: caused points field / focus ring clipping */
            background: rgba(10,18,35,0.55); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.14); border-radius: 18px;
            padding: 10px 12px 12px; z-index: 40;
            display: flex; flex-direction: column; gap: 8px;
            box-shadow: 0 8px 28px -6px rgba(0,0,0,0.55), 0 0 0 1px rgba(255,255,255,0.05) inset;
            font-family: 'Montserrat', system-ui, sans-serif;
        }
        .mini-roster.collapsed { width: 72px; padding: 8px 10px 10px; }
        .mini-roster-header { display:flex; align-items:center; justify-content:space-between; gap:6px; }
        .mini-roster-title { font-size:11px; letter-spacing:.14em; font-weight:700; color:#9cd9ff; opacity:.9; }
        .mini-roster-toggle { cursor:pointer; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.2); color:#9cd9ff; border-radius:8px; font-size:11px; font-weight:600; padding:4px 8px; letter-spacing:.08em; }
        .mini-roster-toggle:hover { background:rgba(255,255,255,0.14); }
        .mini-roster-list { display:flex; flex-direction:column; gap:6px; }
    .player-row { display:flex; align-items:center; gap:6px; }
    .player-row input.player-name { flex:1 1 auto; min-width:0; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.18); border-radius:8px; padding:4px 8px 5px; font-size:12px; font-weight:600; color:#e6f2ff; outline:none; letter-spacing:.03em; transition:border-color .2s, box-shadow .2s, background .25s; }
        .player-row input[type="text"]:focus { border-color:#57f1ff; box-shadow:0 0 0 1px #57f1ff, 0 4px 14px -4px rgba(87,241,255,0.5); background:rgba(255,255,255,0.12); }
    .points { flex:0 0 auto; width:32px; max-width:32px; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.18); border-radius:8px; padding:4px 3px 5px; font-size:11px; font-weight:700; color:#ffd166; text-align:center; outline:none; transition:border-color .2s, box-shadow .2s, background .25s; box-sizing:border-box; }
        .points:focus { border-color:#ffd166; box-shadow:0 0 0 1px #ffd166, 0 4px 14px -4px rgba(255,209,102,0.45); background:rgba(255,255,255,0.12); }
        .collapsed .mini-roster-list { display:none; }
        .collapsed .mini-roster-title { writing-mode: vertical-rl; transform: rotate(180deg); letter-spacing:.2em; font-size:10px; }
        .collapsed .mini-roster-toggle { padding:4px 6px; font-size:10px; }
        @media (max-width: 1000px) { .mini-roster { display:none; } }
    </style>
</head>

<body>
    <div class="sparkle"></div>
    <canvas id="confetti"></canvas>

    <div class="container">
        <section class="stage" aria-live="polite">
            <header>
                <div class="brand">
                    <div class="logo" aria-hidden="true"></div>
                    <div>
                        <div class="title">Tournament Tavern</div>
                        <div class="badge" aria-label="Game Show Mode">Official Deepwoken Gameshow</div>
                    </div>
                </div>
                <div class="timer" aria-label="Countdown timer">
                    <div class="timer-row">
                        <span class="time-display" id="time">00:00</span>
                        <input id="timeInput" type="text" placeholder="mm:ss" aria-label="Set timer (mm:ss)" />
                        <button class="btn neutral" id="setTimerBtn" type="button">Set</button>
                    </div>
                    <div class="timer-row">
                        <button class="btn secondary icon-btn" id="pauseBtn" type="button" aria-label="Pause"
                            title="Pause">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="6" y="5" width="4" height="14" rx="1" />
                                <rect x="14" y="5" width="4" height="14" rx="1" />
                            </svg>
                        </button>
                        <button class="btn icon-btn" id="startBtn" type="button" aria-label="Start" title="Start">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="7 5 19 12 7 19 7 5" />
                            </svg>
                        </button>
                        <div class="badge" title="Round">Round <span id="round">2/2</span></div>

                    </div>
                </div>
            </header>
            <div class="content">
                <div>
                    <div class="question-wrap" id="questionWrap" role="button" tabindex="0" aria-expanded="false"
                        aria-label="Reveal question">
                        <div class="question-cover">
                            <svg class="reveal-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="3" y="11" width="18" height="10" rx="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                            <div class="reveal-title">Reveal Question</div>
                        </div>
                        <h1 id="question" class="question">
                            <div class="question-label">Question</div>
                            {{ isset($question) && $question ? $question->question : $question ?? 'Which creature can hold its breath the longest?' }}
                        </h1>
                    </div>

                    <div class="answer-wrap">
                        <div id="answerCard" class="answer-card" role="button" tabindex="0"
                            aria-expanded="false" aria-controls="answerText"
                            data-answer="{{ isset($question) && $question ? $question->answer : $answer ?? 'Cuvier’s beaked whale — over 3 hours!' }}">
                            <div class="reveal-cover">
                                <svg class="reveal-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                    aria-hidden="true">
                                    <rect x="3" y="11" width="18" height="10" rx="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                                <div class="reveal-title">Reveal Answer</div>
                            </div>
                            <div id="answerText" class="answer" aria-hidden="true"></div>
                        </div>
                    </div>
                    <div id="nextControls" style="display:none;margin-top:18px;display:flex;gap:10px;flex-wrap:wrap;">
                        <form method="POST" action="{{ route('round2.correct') }}" style="margin:0;">
                            @csrf
                            <button class="btn" type="submit">Correct</button>
                        </form>
                        <form method="POST" action="{{ route('round2.wrong') }}" style="margin:0;">
                            @csrf
                            <button class="btn danger" type="submit">Wrong</button>
                        </form>
                        <form method="POST" action="{{ route('round2.skip') }}" style="margin:0;">
                            @csrf
                            @if (isset($question) && $question)
                                <input type="hidden" name="id" value="{{ $question->id }}" />
                            @endif
                            <button class="btn secondary" type="submit">Skip</button>
                        </form>
                        <form method="POST" action="{{ route('round2.reset') }}" style="margin:0;" aria-label="Reset prize ladder to zero tiers">
                            @csrf
                            <button class="btn neutral" type="submit" title="Reset ladder to 0">Reset Ladder</button>
                        </form>
                    </div>
                    <footer style="margin-top:12px;">
                        <div class="tip">Check the stage VC chat for an explanation for the current round!</div>
                    </footer>
                </div>

                <aside class="sidebar" aria-label="Prize tiers">
                    <h3 style="margin-top:0;">Prize Ladder</h3>
                    @php
                        $prizes = [
                            '5 Moonseyes',
                            '15 Idols, 5 Moonseyes',
                            'Whistling Periapt',
                            'Obt Relic of Choice',
                            'Obt Item of Choice',
                            'Custom Name',
                            'Name + Mantle',
                            'Name + Title',
                            'Name + Title + Mantle',
                            'Name + Title + Obt item',
                        ];
                        $active = isset($tiers) ? $tiers : 0;
                    @endphp
                    @for ($i = 0; $i < 10; $i++)
                        <div class="tier {{ $i < $active ? 'active' : '' }}">
                            <div>Q{{ $i + 1 }}</div>
                            <div class="prize">{{ $prizes[$i] }}</div>
                        </div>
                    @endfor
                </aside>
            </div>
        </section>
    </div>
    <div style="position:absolute;bottom:12px;left:50%;transform:translateX(-50%);z-index:5;font-family:Montserrat,system-ui,sans-serif;">
        <div style="display:flex;align-items:center;gap:10px;background:rgba(10,18,35,0.55);backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px);padding:8px 14px;border:1px solid rgba(255,255,255,0.14);border-radius:999px;font-size:11px;letter-spacing:.06em;color:#b8c6e2;max-width:92vw;">
            <span style="font-weight:700;color:#57f1ff;text-transform:uppercase;font-size:10px;opacity:.85;">Thanks</span>
            <span aria-hidden="true" style="opacity:.4;">|</span>
            <span style="white-space:nowrap;">[Questions]: Thatoneguy_o · Aswqe · Shiny · leron7 · cam2 · KOWZ · Wormcave · Sillybillycar2 · Blahamus · Equal_dark</span>
            <span aria-hidden="true" style="opacity:.4;">|</span>
            <span style="white-space:nowrap;">[Website]: · Onteal</span>
            <span aria-hidden="true" style="opacity:.4;">|</span>
            <span style="white-space:nowrap;">[Chaser Profile Picture]: · V1kov</span>
        </div>
    </div>

    <script>
        const answerCard = document.getElementById('answerCard');
        const answerText = document.getElementById('answerText');
        const questionWrap = document.getElementById('questionWrap');
        // Timer elements
        const timeEl = document.getElementById('time');
        const timeInput = document.getElementById('timeInput');
        const setTimerBtn = document.getElementById('setTimerBtn');
        const startBtn = document.getElementById('startBtn');
        const pauseBtn = document.getElementById('pauseBtn');
        const resetBtn = document.getElementById('resetBtn');

        let revealed = false; // answer revealed
        let qRevealed = false; // question revealed
        // Timer state (persistent)
        let totalSeconds = 0; // countdown remaining (when paused or before start)
        let timerId = null;
        let endTime = null; // epoch ms when countdown hits zero (only set while running)
        const LS_KEY_END = 'round2TimerEnd'; // stores endTime when running
        const LS_KEY_REM = 'round2TimerRemain'; // stores remaining seconds when paused

        function setQuestionVisible(show) {
            qRevealed = !!show;
            questionWrap.classList.toggle('q-revealed', qRevealed);
            questionWrap.setAttribute('aria-expanded', String(qRevealed));
        }

        function setAnswerVisible(show) {
            revealed = !!show;
            answerCard.classList.toggle('revealed', revealed);
            answerText.classList.toggle('revealed', revealed);
            answerCard.setAttribute('aria-expanded', String(revealed));
            answerText.setAttribute('aria-hidden', String(!revealed));
            if (revealed) {
                if (!answerText.textContent) {
                    answerText.textContent = answerCard.dataset.answer || 'Answer';
                }
                burstConfetti();
                const nc = document.getElementById('nextControls');
                if (nc) nc.style.display = 'flex';
                const ft = document.getElementById('footerTip');
                if (ft) ft.textContent = 'Mark the result or set timer.';
            }
        }

        function revealQuestion() {
            setQuestionVisible(true);
        }

        function hideQuestion() {
            setQuestionVisible(false);
        }

        function reveal() {
            setAnswerVisible(true);
        }

        function hide() {
            setAnswerVisible(false);
        }

        // Question reveal controls
        questionWrap.addEventListener('click', revealQuestion);
        questionWrap.addEventListener('keydown', (e) => {
            if (e.key === ' ' || e.key === 'Enter') {
                e.preventDefault();
                revealQuestion();
            }
        });

        // Answer reveal controls (keep card interactive)
        answerCard.addEventListener('click', () => reveal());
        answerCard.addEventListener('keydown', (e) => {
            if (e.key === ' ' || e.key === 'Enter') {
                e.preventDefault();
                reveal();
            }
        });

        // Timer helpers
        function formatTime(s) {
            const m = Math.floor(s / 60).toString().padStart(2, '0');
            const ss = Math.floor(s % 60).toString().padStart(2, '0');
            return `${m}:${ss}`;
        }

        function renderTime() {
            timeEl.textContent = formatTime(totalSeconds);
        }

        function parseInput(val) {
            if (!val) return null;
            const parts = val.split(':').map(p => p.trim());
            if (parts.length !== 2) return null;
            const m = parseInt(parts[0], 10);
            const s = parseInt(parts[1], 10);
            if (Number.isNaN(m) || Number.isNaN(s) || m < 0 || s < 0 || s >= 60) return null;
            return m * 60 + s;
        }

        function computeRemaining() {
            if (!endTime) return totalSeconds; // paused state
            const now = Date.now();
            // Use ceil so partial seconds don't visually skip (e.g., 47.8 -> 47, then 46.1 -> 46)
            const diff = Math.ceil((endTime - now) / 1000);
            return diff > 0 ? diff : 0;
        }

        let lastDisplayed = null;

        function updateFromEndTime() {
            const remain = computeRemaining();
            if (remain !== lastDisplayed) {
                totalSeconds = remain;
                renderTime();
                lastDisplayed = remain;
            } else {
                totalSeconds = remain; // keep internal sync
            }
            if (endTime && remain === 0) {
                reveal();
                clearPersisted();
                stopTimer();
            }
        }

        function tick() {
            updateFromEndTime();
        }

        function startTimer() {
            if (timerId || totalSeconds <= 0) return;
            // Faster interval reduces drift & provides smoother second transitions
            timerId = setInterval(tick, 250);
            tick(); // immediate sync
        }

        function stopTimer() {
            if (timerId) {
                clearInterval(timerId);
                timerId = null;
            }
        }

        function clearPersisted() {
            localStorage.removeItem(LS_KEY_END);
            localStorage.removeItem(LS_KEY_REM);
            endTime = null;
        }

        function resetTimer() {
            stopTimer();
            clearPersisted();
            totalSeconds = 0;
            renderTime();
        }

        function setNewTimer(seconds) {
            // Set WITHOUT starting. Store as remaining.
            stopTimer();
            clearPersisted();
            if (seconds <= 0) {
                resetTimer();
                return;
            }
            totalSeconds = seconds;
            renderTime();
            localStorage.setItem(LS_KEY_REM, String(totalSeconds));
        }

        setTimerBtn?.addEventListener('click', () => {
            const v = parseInput(timeInput.value);
            if (v == null) {
                alert('Enter mm:ss (e.g., 01:30)');
                return;
            }
            setNewTimer(v);
        });
        startBtn?.addEventListener('click', () => {
            // If no time set but an input value exists, stage it first (paused state)
            if (!endTime && totalSeconds === 0 && timeInput.value) {
                const v = parseInput(timeInput.value);
                if (v != null) setNewTimer(v);
            }
            if (totalSeconds > 0 && !endTime) {
                // Transition from paused/staged to running
                endTime = Date.now() + totalSeconds * 1000;
                localStorage.setItem(LS_KEY_END, String(endTime));
                localStorage.removeItem(LS_KEY_REM);
                updateFromEndTime();
                startTimer();
            }
        });
        pauseBtn?.addEventListener('click', () => {
            if (endTime) {
                // Currently running: freeze remaining
                updateFromEndTime(); // ensure latest remaining
                stopTimer();
                // Persist remaining seconds
                localStorage.setItem(LS_KEY_REM, String(totalSeconds));
                localStorage.removeItem(LS_KEY_END);
                endTime = null;
            } // if already paused do nothing
        });
        resetBtn?.addEventListener('click', resetTimer);

        // On load: restore persisted endTime if exists
        (function restoreTimer() {
            const runningTs = localStorage.getItem(LS_KEY_END);
            const pausedRemain = localStorage.getItem(LS_KEY_REM);
            if (runningTs) {
                const ts = parseInt(runningTs, 10);
                if (!Number.isNaN(ts) && ts > Date.now()) {
                    endTime = ts;
                    updateFromEndTime();
                    startTimer();
                    return;
                } else {
                    // expired
                    clearPersisted();
                }
            }
            if (pausedRemain) {
                const rem = parseInt(pausedRemain, 10);
                if (!Number.isNaN(rem) && rem > 0) {
                    totalSeconds = rem;
                }
            }
            renderTime();
        })();

        // Confetti (simple, lightweight)
        const canvas = document.getElementById('confetti');
        const ctx = canvas.getContext('2d');
        // Keep a persistent pool so confetti doesn't vanish on repeated clicks
        let confettiRaf = null;
        const confettiPieces = [];
        let confettiAnimating = false;

        function resizeCanvas() {
            const dpr = Math.min(window.devicePixelRatio || 1, 2);
            canvas.width = Math.floor(window.innerWidth * dpr);
            canvas.height = Math.floor(window.innerHeight * dpr);
            ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
        }
        window.addEventListener('resize', resizeCanvas);
        resizeCanvas();

        function burstConfetti() {
            const colors = ['#57f1ff', '#ff64f2', '#ffd166', '#7cf6a4', '#a4b5ff'];
            const count = Math.min(160, Math.floor(window.innerWidth / 8));
            for (let i = 0; i < count; i++) {
                confettiPieces.push({
                    x: Math.random() * window.innerWidth,
                    y: -10 - Math.random() * 40,
                    size: 6 + Math.random() * 6,
                    color: colors[Math.floor(Math.random() * colors.length)],
                    angle: Math.random() * Math.PI,
                    spin: (Math.random() - .5) * 0.2,
                    speedX: (Math.random() - .5) * 2.2,
                    speedY: 2 + Math.random() * 3.5,
                    life: 0,
                });
            }
            if (!confettiAnimating) {
                confettiAnimating = true;
                confettiRaf = requestAnimationFrame(confettiFrame);
            }
        }

        function confettiFrame() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            // Update & draw
            for (let i = 0; i < confettiPieces.length; i++) {
                const p = confettiPieces[i];
                p.x += p.speedX;
                p.y += p.speedY;
                p.speedY += 0.03; // gravity
                p.angle += p.spin;
                p.life += 1;
                drawRect(p.x, p.y, p.size, p.size * 0.6, p.angle, p.color);
            }
            // Cull off-screen/old pieces but do NOT stop when a new burst happens
            for (let i = confettiPieces.length - 1; i >= 0; i--) {
                const p = confettiPieces[i];
                if (p.y > window.innerHeight + 80 || p.life > 800) {
                    confettiPieces.splice(i, 1);
                }
            }
            if (confettiPieces.length > 0) {
                confettiRaf = requestAnimationFrame(confettiFrame);
            } else {
                confettiAnimating = false; // Leave canvas as-is (no forced clear) so it doesn't flash
            }
        }

        function drawRect(x, y, w, h, angle, color) {
            ctx.save();
            ctx.translate(x, y);
            ctx.rotate(angle);
            ctx.fillStyle = color;
            ctx.fillRect(-w / 2, -h / 2, w, h);
            ctx.restore();
        }

        /* Mini roster persistence (5 players) - unified shared keys */
        const SHARED_NAME = i => `roster_player_${i}_name`;
        const SHARED_PTS  = i => `roster_player_${i}_pts`;
        // Legacy key patterns to migrate once (round2 + potential head_to_head earlier)
        const LEGACY_KEY_SETS = [
            { name: i => `r2_player_${i}_name`, pts: i => `r2_player_${i}_pts` },
            { name: i => `h2h_player_${i}_name`, pts: i => `h2h_player_${i}_pts` }
        ];
        function migrateLegacy(){
            for(let i=1;i<=5;i++){
                const sharedNameKey = SHARED_NAME(i);
                const sharedPtsKey  = SHARED_PTS(i);
                if(!localStorage.getItem(sharedNameKey)){ // only migrate if empty
                    for(const set of LEGACY_KEY_SETS){
                        const legacyVal = localStorage.getItem(set.name(i));
                        if(legacyVal){ localStorage.setItem(sharedNameKey, legacyVal); break; }
                    }
                }
                if(!localStorage.getItem(sharedPtsKey)){
                    for(const set of LEGACY_KEY_SETS){
                        const legacyVal = localStorage.getItem(set.pts(i));
                        if(legacyVal){ localStorage.setItem(sharedPtsKey, legacyVal); break; }
                    }
                }
            }
        }
        function loadMiniRoster(){
            for(let i=1;i<=5;i++){
                const nameInput = document.querySelector(`input[data-r2-name="${i}"]`);
                const ptsInput = document.querySelector(`input[data-r2-pts="${i}"]`);
                if(nameInput){ nameInput.value = localStorage.getItem(SHARED_NAME(i)) || ''; }
                if(ptsInput){ ptsInput.value = localStorage.getItem(SHARED_PTS(i)) || ''; }
            }
        }
        function saveMiniRoster(ev){
            const t = ev.target;
            if(t.matches('input[data-r2-name]')){
                const slot = t.dataset.r2Name; localStorage.setItem(SHARED_NAME(slot), t.value.trim());
            } else if(t.matches('input[data-r2-pts]')){
                const slot = t.dataset.r2Pts; localStorage.setItem(SHARED_PTS(slot), t.value.trim());
            }
        }
        function initMiniRoster(){
            const panel = document.getElementById('miniRoster');
            const toggle = document.getElementById('miniRosterToggle');
            if(!panel || !toggle) return;
            migrateLegacy();
            loadMiniRoster();
            toggle.addEventListener('click', ()=>{
                const collapsed = panel.classList.toggle('collapsed');
                panel.setAttribute('aria-expanded', String(!collapsed));
                toggle.setAttribute('aria-pressed', String(!collapsed));
            });
            document.addEventListener('input', saveMiniRoster);
        }
        document.addEventListener('DOMContentLoaded', initMiniRoster);
    </script>
    <!-- Mini Roster (5 players with points) -->
    <aside id="miniRoster" class="mini-roster collapsed" aria-label="Round 2 roster" aria-expanded="false">
        <div class="mini-roster-header">
            <div class="mini-roster-title">PLAYERS</div>
            <button id="miniRosterToggle" type="button" class="mini-roster-toggle" aria-pressed="false" aria-label="Toggle players panel">⇔</button>
        </div>
        <div class="mini-roster-list" role="list">
            @for($i=1;$i<=5;$i++)
            <div class="player-row" role="listitem">
                <input type="text" class="player-name" data-r2-name="{{ $i }}" maxlength="28" placeholder="Player {{ $i }}" aria-label="Player {{ $i }} name" />
                <input type="text" data-r2-pts="{{ $i }}" maxlength="6" class="points" placeholder="0" aria-label="Player {{ $i }} points" />
            </div>
            @endfor
        </div>
    </aside>
</body>

</html>
