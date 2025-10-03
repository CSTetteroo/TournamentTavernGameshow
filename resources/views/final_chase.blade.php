<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Final Chase — Tournament Tavern</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&family=Montserrat:wght@400;700;900&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --bg1: #0b0f1a;
            --bg2: #0f1630;
            --accent: #00e6ff;
            --accent-2: #ff00f3;
            --gold: #ffd166;
            --text: #eaf4ff;
            --glass: rgba(255, 255, 255, .08);
        }

        * { box-sizing: border-box; overflow: hidden; }

        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
            font-family: Montserrat, system-ui, sans-serif;
            color: var(--text);
            background: radial-gradient(1200px 600px at 10% -10%, rgba(0, 230, 255, .15), transparent 60%), radial-gradient(1000px 500px at 110% 10%, rgba(255, 0, 243, .12), transparent 60%), linear-gradient(135deg, var(--bg1), var(--bg2));
            overflow-x: hidden;
        }

        .sparkle {
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: .35;
            background-image: radial-gradient(2px 2px at 20% 30%, rgba(255, 255, 255, .6), transparent 60%), radial-gradient(2px 2px at 80% 40%, rgba(255, 255, 255, .4), transparent 60%), radial-gradient(2px 2px at 50% 70%, rgba(255, 255, 255, .7), transparent 60%);
            animation: twinkle 6s ease-in-out infinite;
            filter: blur(.3px);
        }

        @keyframes twinkle {
            0%, 100% { opacity: .35; transform: translateY(0); }
            50% { opacity: .55; transform: translateY(-6px); }
        }

        .container {
            min-height: 100dvh;
            display: grid;
            place-items: center;
            padding: clamp(16px, 3vw, 48px);
        }

        .stage {
            width: min(1250px, 100%);
            padding: clamp(20px, 2.8vw, 42px);
            border-radius: 28px;
            background: linear-gradient(180deg, rgba(255, 255, 255, .14), rgba(255, 255, 255, .06));
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, .15);
            box-shadow: 0 10px 30px rgba(0, 0, 0, .4), inset 0 0 0 1px rgba(255, 255, 255, .06);
            position: relative;
            overflow: hidden;
        }

        .stage:after {
            content: "";
            position: absolute;
            inset: -2px;
            background: conic-gradient(from 0deg, var(--accent), var(--accent-2), var(--gold), var(--accent), var(--accent-2));
            filter: blur(22px);
            opacity: .15;
            z-index: 0;
            animation: hue 12s linear infinite;
            pointer-events: none;
        }

        @keyframes hue { to { filter: blur(22px) hue-rotate(360deg); } }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .logo {
            width: 90px;
            height: 90px;
            border-radius: 26px;
            background: radial-gradient(circle at 30% 30%, var(--gold), #e24bff 60%, #5ee7ff 100%);
            box-shadow: 0 0 25px rgba(0, 153, 255, .45), 0 0 18px rgba(0, 230, 255, .35) inset;
            background-image: url('{{ asset('img/tt.png') }}');
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
        }

        .title {
            font-family: Orbitron, sans-serif;
            font-weight: 900;
            font-size: clamp(20px, 2.6vw, 48px);
            line-height: 1.05;
            text-transform: uppercase;
            text-shadow: 0 0 12px rgba(0, 230, 255, .45), 0 0 24px rgba(255, 0, 243, .25);
        }

        .badge {
            font-family: Orbitron, sans-serif;
            padding: 10px 14px;
            border-radius: 999px;
            font-weight: 700;
            letter-spacing: .08em;
            font-size: 12px;
            color: #0a0d16;
            background: linear-gradient(90deg, #5eb1ff, #5ee7ff);
            box-shadow: 0 6px 18px rgba(82, 128, 180, .35);
        }

        /* Score Bars */
        .scoreboard {
            display: flex;
            flex-direction: column;
            gap: 18px;
            margin-bottom: 18px;
        }

        .bars {
            display: flex;
            gap: 26px;
            flex-wrap: wrap;
        }

        .bar-col {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-width: 240px;
        }

        .bar-label {
            font: 700 12px/1 Orbitron, sans-serif;
            letter-spacing: .18em;
            text-transform: uppercase;
            opacity: .85;
            display: flex;
            justify-content: space-between;
        }

        .progress-outer {
            height: 26px;
            border-radius: 14px;
            position: relative;
            background: rgba(255, 255, 255, .08);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, .18);
        }

        .progress-fill {
            position: absolute;
            inset: 0;
            width: 0%;
            display: flex;
            align-items: center;
            font: 700 12px/1 Montserrat, sans-serif;
            letter-spacing: .05em;
            padding: 0 10px;
            color: #06141c;
            text-shadow: 0 0 4px rgba(0, 0, 0, .4);
        }

        .progress-fill.blue {
            background: linear-gradient(90deg, #2dbdff, #57f1ff);
        }

        .progress-fill.red {
            background: linear-gradient(90deg, #ff647a, #ff3d55);
        }

        /* Controls */
        .panel-row {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            align-items: center;
            margin: 8px 0 4px;
        }

        .btn {
            font-family: Orbitron, sans-serif;
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
            background: linear-gradient(90deg, #ff7b7b, #ff3d55);
            color: #250b11;
            border: none;
            box-shadow: 0 8px 20px -4px rgba(255, 61, 85, .4);
        }

        .btn:active {
            transform: translateY(1px);
        }

        .icon-btn {
            padding: 8px 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 0;
        }

        .mini-box {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            border: 1px solid rgba(255, 255, 255, .18);
            border-radius: 14px;
            background: rgba(255, 255, 255, .06);
        }

        .mini-box select,
        #timeInput {
            background: rgba(0, 0, 0, .35);
            color: var(--text);
            border: 1px solid rgba(255, 255, 255, .25);
            padding: 8px 10px;
            border-radius: 10px;
            font: 600 14px Montserrat, sans-serif;
        }

        #timeDisplay {
            font: 800 24px/1 Orbitron, sans-serif;
            letter-spacing: .08em;
        }

        .notice {
            font-size: 12px;
            opacity: .7;
            letter-spacing: .05em;
            margin-left: auto;
        }

        /* Q/A Blocks (Round1 exact styling with smaller text) */
        .qa {
            margin-top: 24px;
            display: grid;
            gap: 24px;
        }

        .question-wrap {
            position: relative;
            z-index: 1;
            padding: clamp(16px, 2vw, 30px);
            border-radius: 22px;
            background: var(--glass);
            border: 1px solid rgba(255, 255, 255, 0.14);
            box-shadow: inset 0 0 30px rgba(255, 255, 255, 0.04);
            cursor: pointer;
        }

        .question-wrap:hover {
            box-shadow: inset 0 0 30px rgba(255, 255, 255, 0.06), 0 8px 22px rgba(0, 0, 0, .25);
        }

        .question-wrap:focus-visible { outline: 2px solid rgba(87,241,255,.8); outline-offset:4px; }
        .question-cover { display:grid; place-items:center; gap:12px; text-align:center; padding:0px 4px; }

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
            font-family: Orbitron, sans-serif;
            font-size: 12px;
            letter-spacing: .2em;
            opacity: .9;
            color: #a6c8ff;
            text-transform: uppercase;
        }

        .question { margin:6px 0 0; font-weight:900; font-size:clamp(24px,4.2vw,36px); line-height:1.05; text-shadow:0 6px 22px rgba(0,0,0,.45),0 0 22px rgba(0,230,255,.25); }

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

        .answer-wrap {
            position: relative;
            z-index: 1;
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
        }

        .answer-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(0, 0, 0, 0.45), inset 0 0 0 1px rgba(255, 255, 255, 0.08);
        }

        .answer-card:active {
            transform: translateY(0);
        }

        .answer-card::before { content:""; position:absolute; inset:0; border-radius:20px; pointer-events:none; background:linear-gradient(120deg, transparent 0%, rgba(255,255,255,.18) 15%, transparent 30%); transform:translateX(-120%); animation:shimmer 4.8s ease-in-out infinite; }

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

        .reveal-cover {
            display: grid;
            place-items: center;
            gap: 12px;
            text-align: center;
            padding: 0px 4px;
        }

        .reveal-title {
            font-family: Orbitron, sans-serif;
            font-weight: 900;
            font-size: clamp(16px, 2vw, 26px);
            letter-spacing: .1em;
            color: #bde7ff;
            text-transform: uppercase;
        }

        .reveal-icon {
            width: 40px;
            height: 40px;
            color: #bde7ff;
            filter: drop-shadow(0 0 8px rgba(0, 230, 255, .4));
        }

        .answer { display:none; font-size:clamp(22px,3.2vw,48px); font-weight:800; line-height:1.15; color:#ffffff; text-shadow:0 0 22px rgba(255,0,243,.35),0 0 14px rgba(0,230,255,.28); }

        .answer.revealed {
            display: block;
            animation: pop .35s ease;
            font-size: clamp(22px, 3.2vw, 30px);
        }

        .answer-card.revealed .reveal-cover {
            display: none;
        }

        .answer-card.revealed {
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.55), 0 0 0 3px rgba(0, 230, 255, .25) inset;
        }

        header { position:relative; z-index:1; display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap; margin-bottom:clamp(16px,2vw,24px); }
        header .brand { display:flex; align-items:center; gap:14px; flex:1 1 auto; min-width:260px; }
        header > .badge[title="Mode"] { flex:0 0 auto; white-space:nowrap; }
        @media (max-width:720px) {
            .bars {
                flex-direction: column;
            }

            .progress-outer {
                height: 22px;
            }

            header { flex-direction:column; align-items:flex-start; }

            .brand {
                width: 100%;
            }
        }
    /* Mini Roster (exact Round 2 clone) */
    .mini-roster { position: fixed; top: 50%; left: 10px; transform: translateY(-50%); width: 238px; max-height: 80vh; overflow: visible; background: rgba(10,18,35,0.55); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.14); border-radius: 18px; padding: 10px 12px 12px; z-index: 60; display: flex; flex-direction: column; gap: 8px; box-shadow: 0 8px 28px -6px rgba(0,0,0,0.55), 0 0 0 1px rgba(255,255,255,0.05) inset; font-family: 'Montserrat', system-ui, sans-serif; }
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
    @media (max-width: 1100px){ .mini-roster { display:none; } }
    </style>
</head>

<body>
    <div class="sparkle"></div>
    <div class="container">
        <section class="stage" aria-live="polite">
            <header>
                <div class="brand">
                    <div class="logo" aria-hidden="true"></div>
                    <div>
                        <div class="title">Tournament Tavern</div>
                        <div class="badge">Final Chase</div>
                    </div>
                </div>
                <div class="badge" title="Mode">FINALE</div>
            </header>

            <div class="scoreboard">
                <div class="bars">
                    <div class="bar-col">
                        <div class="bar-label"><span>Contestants</span><span
                                id="contestantScore">{{ $contestant }}</span></div>
                        <div class="progress-outer">
                            <div class="progress-fill blue" id="contestantFill">0</div>
                        </div>
                    </div>
                    <div class="bar-col">
                        <div class="bar-label"><span>Chaser</span><span id="chaserScore">{{ $chaser }}</span>
                        </div>
                        <div class="progress-outer">
                            <div class="progress-fill red" id="chaserFill">0</div>
                        </div>
                    </div>
                </div>
                <div class="panel-row">
                    <div class="mini-box">
                        <label for="sideSelect"
                            style="font:700 11px Orbitron,sans-serif;letter-spacing:.12em;">SIDE</label>
                        <select id="sideSelect" aria-label="Active side">
                            <option value="contestant">Contestant</option>
                            <option value="chaser">Chaser</option>
                        </select>
                    </div>
                    <div class="mini-box" aria-label="Timer controls">
                        <span id="timeDisplay">01:30</span>
                        <input id="timeInput" placeholder="mm:ss" aria-label="Set time" />
                        <button class="btn secondary icon-btn" id="setTimeBtn" type="button" aria-label="Set time"
                            title="Set time">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="9" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                        </button>
                        <button class="btn secondary icon-btn" id="startBtn" type="button" aria-label="Start"
                            title="Start">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="7 5 19 12 7 19 7 5" />
                            </svg>
                        </button>
                        <button class="btn secondary icon-btn" id="pauseBtn" type="button" aria-label="Pause"
                            title="Pause">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="6" y="5" width="4" height="14" rx="1" />
                                <rect x="14" y="5" width="4" height="14" rx="1" />
                            </svg>
                        </button>

                    </div>
                    <form method="POST" action="{{ route('final.chase.reset') }}" style="display:inline;">
                        @csrf
                        <button class="btn danger" type="submit">Full Reset</button>
                    </form>
                    <span class="notice">Wrong subtracts 1 from Chaser only.</span>
                </div>
            </div>

            <div class="qa">
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
                    <h2 id="questionText" class="question">
                        <div class="question-label">Question</div>
                        {{ $question?->question ?? 'No question available' }}
                    </h2>
                </div>
                <div class="answer-wrap">
                    <div id="answerCard" class="answer-card" role="button" tabindex="0" aria-expanded="false"
                        aria-controls="answerText" data-answer="{{ $question?->answer ?? '' }}">
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
                <div style="margin-top:18px;display:flex;gap:12px;flex-wrap:wrap;">
                    <button class="btn" id="correctBtn" type="button"
                        style="flex:1;min-width:140px;">Correct</button>
                    <button class="btn danger" id="wrongBtn" type="button"
                        style="flex:1;min-width:140px;">Wrong</button>
                </div>
                <!-- Next button removed: auto-advance on scoring -->
            </div>
        </section>
    </div>
    <!-- Mini Roster (Round2 clone) -->
    <aside id="miniRoster" class="mini-roster collapsed" aria-label="Final Chase roster" aria-expanded="false">
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
        const csrf = document.querySelector('meta[name="csrf-token"]').content;
        // Scores
        const contestantScoreEl = document.getElementById('contestantScore');
        const chaserScoreEl = document.getElementById('chaserScore');
        const contestantFill = document.getElementById('contestantFill');
        const chaserFill = document.getElementById('chaserFill');
        const sideSelect = document.getElementById('sideSelect');
        const correctBtn = document.getElementById('correctBtn');
        const wrongBtn = document.getElementById('wrongBtn');
        const nextContainer = null; // removed
        const questionWrap = document.getElementById('questionWrap');
        const questionText = document.getElementById('questionText');
        const answerCard = document.getElementById('answerCard');
        const answerText = document.getElementById('answerText');
        // Timer
        const timeDisplay = document.getElementById('timeDisplay');
        const timeInput = document.getElementById('timeInput');
        const setTimeBtn = document.getElementById('setTimeBtn');
        const startBtn = document.getElementById('startBtn');
        const pauseBtn = document.getElementById('pauseBtn');
        const resetTimeBtn = document.getElementById('resetTimeBtn');

        let maxVisual = 30; // scaling reference for bar width
        function updateBars() {
            const c = parseInt(contestantScoreEl.textContent, 10) || 0;
            const h = parseInt(chaserScoreEl.textContent, 10) || 0;
            const maxScore = Math.max(1, c, h, maxVisual);
            const cPct = (c / maxScore) * 100;
            const hPct = (h / maxScore) * 100;
            contestantFill.style.width = cPct + '%';
            contestantFill.textContent = c;
            chaserFill.style.width = hPct + '%';
            chaserFill.textContent = h;
        }
        updateBars();

        async function adjustScore(side, delta) {
            const res = await fetch('{{ route('final.chase.score') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    side,
                    delta
                })
            });
            const data = await res.json();
            contestantScoreEl.textContent = data.contestant;
            chaserScoreEl.textContent = data.chaser;
            updateBars();
        }

        async function scoreAndNext(delta) {
            const side = sideSelect.value;
            if (delta < 0 && side !== 'chaser') {
                /* no change for contestant wrong */
            } else if (delta < 0 && side === 'chaser') {
                await adjustScore('chaser', -1);
            } else if (delta > 0) {
                await adjustScore(side, 1);
            }
            await nextQuestion();
        }
        correctBtn.addEventListener('click', () => scoreAndNext(1));
        wrongBtn.addEventListener('click', () => scoreAndNext(-1));

        async function nextQuestion() {
            const res = await fetch('{{ route('final.chase.next') }}');
            const data = await res.json();
            questionText.childNodes.forEach(n => {
                if (n.nodeType === 3) n.remove();
            });
            questionText.append(document.createTextNode(data.question || 'No question'));
            answerText.textContent = '';
            answerCard.dataset.answer = data.answer || '';
            questionWrap.classList.remove('q-revealed');
            answerCard.classList.remove('revealed');
            answerText.classList.remove('revealed');
            // next button removed
        }
        // Auto advance only via scoring now.
        function setQuestionVisible(show) {
            questionWrap.classList.toggle('q-revealed', !!show);
            questionWrap.setAttribute('aria-expanded', String(!!show));
        }

        function setAnswerVisible(show) {
            if (show) {
                if (!answerText.textContent) {
                    answerText.textContent = answerCard.dataset.answer || 'Answer';
                }
            }
            answerCard.classList.toggle('revealed', !!show);
            answerText.classList.toggle('revealed', !!show);
            answerCard.setAttribute('aria-expanded', String(!!show));
            answerText.setAttribute('aria-hidden', String(!show));
        }
        questionWrap.addEventListener('click', () => setQuestionVisible(true));
        questionWrap.addEventListener('keydown', e => {
            if (e.key === ' ' || e.key === 'Enter') {
                e.preventDefault();
                setQuestionVisible(true);
            }
        });
        answerCard.addEventListener('click', () => setAnswerVisible(true));
        answerCard.addEventListener('keydown', e => {
            if (e.key === ' ' || e.key === 'Enter') {
                e.preventDefault();
                setAnswerVisible(true);
            }
        });

        // Timer logic (simple, local only) ------------------
        let countdown = 90; // seconds
        let timerId = null;

        function renderTime() {
            const m = Math.floor(countdown / 60).toString().padStart(2, '0');
            const s = Math.floor(countdown % 60).toString().padStart(2, '0');
            timeDisplay.textContent = `${m}:${s}`;
        }

        function setFromInput() {
            const v = timeInput.value.trim();
            if (!v) return;
            const parts = v.split(':');
            if (parts.length !== 2) return alert('Use mm:ss');
            const m = parseInt(parts[0], 10),
                s = parseInt(parts[1], 10);
            if (Number.isNaN(m) || Number.isNaN(s) || s < 0 || s >= 60 || m < 0) return alert('Invalid time');
            countdown = m * 60 + s;
            renderTime();
        }

        function tick() {
            if (countdown > 0) {
                countdown--;
                renderTime();
            } else {
                stopTimer();
            }
        }

        function startTimer() {
            if (!timerId) {
                timerId = setInterval(tick, 1000);
            }
        }

        function stopTimer() {
            if (timerId) {
                clearInterval(timerId);
                timerId = null;
            }
        }

        function resetTimer() {
            stopTimer();
            countdown = 0;
            renderTime();
        }
    setTimeBtn.addEventListener('click', setFromInput);
    startBtn.addEventListener('click', startTimer);
    pauseBtn.addEventListener('click', stopTimer);
    if(resetTimeBtn){ resetTimeBtn.addEventListener('click', resetTimer); } // guard: element not present
        renderTime();
        /* Mini roster persistence (5 players) - exact Round2 logic */
        const SHARED_NAME = i => `roster_player_${i}_name`;
        const SHARED_PTS  = i => `roster_player_${i}_pts`;
        const LEGACY_KEY_SETS = [
            { name: i => `r2_player_${i}_name`, pts: i => `r2_player_${i}_pts` },
            { name: i => `h2h_player_${i}_name`, pts: i => `h2h_player_${i}_pts` }
        ];
        function migrateLegacy(){
            for(let i=1;i<=5;i++){
                const sharedNameKey = SHARED_NAME(i);
                const sharedPtsKey  = SHARED_PTS(i);
                if(!localStorage.getItem(sharedNameKey)){
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
                const ptsInput  = document.querySelector(`input[data-r2-pts="${i}"]`);
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
                panel.classList.toggle('opened', !collapsed); // optional explicit state class
                panel.setAttribute('aria-expanded', String(!collapsed));
                toggle.setAttribute('aria-pressed', String(!collapsed));
            });
            document.addEventListener('input', saveMiniRoster);
        }
        document.addEventListener('DOMContentLoaded', initMiniRoster);
    </script>
</body>
</html>
