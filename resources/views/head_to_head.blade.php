<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Head to Head</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600;800&family=Montserrat:wght@500;700&display=swap"
        rel="stylesheet">
    <style>
        /* Adopt round2 palette variables (harmonized) */
        :root {
            --bg: #050914;
            --panel: #0f1630;
            --panel2: #162042;
            --line: rgba(255, 255, 255, .15);
            --accent: #00e6ff;
            --accent2: #ff00f3;
            --gold: #ffd166;
            --danger: #ff3d55;
            --ok: #24e699;
            --text: #eaf4ff;
            --muted: #94a4c4;
        }

        * {
            box-sizing: border-box;

        }

        body {
            margin: 0;
            font-family: Montserrat, system-ui, sans-serif;
            background: radial-gradient(circle at 22% 18%, #18254d 0%, #050914 70%);
            color: var(--text);
            min-height: 100dvh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        h1 {
            font-family: Orbitron, sans-serif;
            letter-spacing: .05em;
            text-transform: uppercase;
            margin: 0 0 8px;
        }

        .wrap {
            width: 1400px;
            margin: 0 auto;
            padding: 34px 32px 70px;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 34px;
        }

        /* Remove panel box for board; create integrated strip */
        .board-area {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .board-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }

        .board-header .legend {
            margin-left: 4px;
        }

        .board-track {
            position: relative;
            display: flex;
            align-items: stretch;
            padding: 24px 30px 28px;
            border-radius: 28px;
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.06), rgba(255, 255, 255, 0.015));
            backdrop-filter: blur(7px);
            -webkit-backdrop-filter: blur(7px);
            border: 1px solid rgba(255, 255, 255, 0.14);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, .65), inset 0 0 0 1px rgba(255, 255, 255, 0.05);
            overflow: visible;
        }

        .board-track::before {
            content: "";
            position: absolute;
            inset: -1px;
            border-radius: 22px;
            background: linear-gradient(90deg, var(--accent) 0%, var(--accent2) 40%, var(--gold) 80%);
            opacity: .12;
            mix-blend-mode: screen;
            pointer-events: none;
        }

        .board-wrapper {
            flex: 1;
            overflow-x: auto;
            padding-bottom: 4px;
        }

        .position-admin {
            margin-left: auto;
            display: flex;
            flex-wrap: nowrap;
            gap: 16px;
            align-items: flex-end;
        }

        .position-admin label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: var(--muted);
            display: flex;
            flex-direction: column;
            gap: 6px;
            min-width: 82px;
        }

        .position-admin input {
            background: linear-gradient(145deg, #1b2b54, #142041);
            border: 1px solid var(--line);
            color: var(--text);
            padding: 8px 10px;
            border-radius: 10px;
            font: 600 13px Montserrat, sans-serif;
            width: 78px;
            text-align: center;
            line-height: 1.2;
            box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.05);
        }

        .position-admin button {
            background: linear-gradient(90deg, var(--accent), var(--accent2));
            border: none;
            height: 46px;
            padding: 0 26px;
            border-radius: 14px;
            font: 800 12px/1 Montserrat, sans-serif;
            letter-spacing: .14em;
            cursor: pointer;
            color: #06141c;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 20px -6px rgba(0, 0, 0, .5);
        }

        .position-admin button:hover {
            filter: brightness(1.08);
        }

        .board {
            display: flex;
            gap: 5px;
            transition: .4s;
            justify-content: stretch;
            flex-wrap: nowrap;
            min-height: 110px;
            overflow: visible;
            width: 100%;
        }

        /* Cells now auto-resize to fit full width so all spaces are visible without scrolling */
        .board .cell {
            flex: 1 1 0;
            min-width: 0; /* allow shrink */
        }

        .cell {
            position: relative;
            margin-right: 2px;
            margin-top: 2px;
            background: linear-gradient(145deg, #18254d, #121b36);
            border: 1px solid var(--line);
            border-radius: 18px;
            min-height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 12px;
            color: var(--muted);
            overflow: visible;
            isolation: isolate;
            opacity: 0;
            transform: translateY(12px) scale(.94);
            animation: pop .5s forwards;
            padding: 4px 6px;
        }

        .cell.home {
            background: linear-gradient(120deg, #0a302f, #0f615e);
            color: #b9fff1;
            font-weight: 800;
        }

        .cell.player {
            outline: 2px solid var(--accent);
            box-shadow: 0 0 0 3px rgba(87, 241, 255, .25), 0 0 22px -4px var(--accent);
        }

        .cell.chaser {
            outline: 2px solid var(--danger);
            box-shadow: 0 0 0 3px rgba(255, 61, 85, .35), 0 0 22px -4px var(--danger);
        }

        .cell.caught {
            background: linear-gradient(120deg, #4d0a1d, #8b1633);
            color: #fff;
        }

        .cell.behind-chaser {
            background: linear-gradient(145deg, #3a1019, #29060d);
            color: #ffb5c1;
        }

        .cell .label {
            position: absolute;
            bottom: 4px;
            font-size: 11px;
            opacity: .55;
            letter-spacing: .08em;
        }

        /* movement animation removed for cleaner static board */
        .legend {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            font-size: 13px;
        }

        .legend span {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .badge {
            width: 14px;
            height: 14px;
            border-radius: 4px;
            display: inline-block;
            background: var(--muted);
            border: 1px solid var(--line);
        }

        .badge.player {
            background: var(--accent);
        }

        .badge.chaser {
            background: var(--danger);
        }

        .badge.home {
            background: linear-gradient(120deg, #0a302f, #0f615e);
        }

        .panel {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.08), rgba(255, 255, 255, 0.04));
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 22px 24px;
            box-shadow: 0 10px 28px -6px rgba(0, 0, 0, .55);
        }

        .qtext {
            font-size: clamp(18px, 2vw, 24px);
            font-weight: 700;
            line-height: 1.3;
            margin: 0 0 8px;
            min-height: 24px;
            display: flex;
            align-items: flex-start;
        }

        .options {
            display: grid;
            gap: 14px;
            margin: 0 0 6px;
        }

        .options button {
            background: linear-gradient(145deg, #1b2b54, #142041);
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 14px 18px;
            text-align: left;
            font: 600 15px/1.2 Montserrat, sans-serif;
            color: var(--text);
            cursor: pointer;
            position: relative;
            transition: .25s;
            overflow: hidden;
        }

        .options button::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(100deg, rgba(87, 241, 255, .18), rgba(255, 100, 242, .18));
            opacity: 0;
            transition: .35s;
        }

        .options button:hover:not(.locked) {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px -4px rgba(0, 0, 0, .55);
        }

        .options button:hover::before {
            opacity: 1;
        }

        .options button.correct {
            background: linear-gradient(145deg, #0e442e, #0c3328);
            border-color: #1f8c5c;
        }

        .options button.wrong {
            background: linear-gradient(145deg, #3a1019, #29060d);
            border-color: #b0303f;
        }

        .options button.locked {
            pointer-events: none;
            opacity: .6;
        }

        .status {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: .05em;
            text-transform: uppercase;
            margin: 0 0 10px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .status.win {
            color: var(--ok);
        }

        .status.lose {
            color: var(--danger);
        }

        .actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .btn {
            background: linear-gradient(90deg, var(--accent), var(--accent2));
            border: none;
            padding: 12px 22px;
            border-radius: 14px;
            font: 800 14px/1 Montserrat, sans-serif;
            letter-spacing: .06em;
            text-transform: uppercase;
            cursor: pointer;
            color: #07161a;
            position: relative;
            overflow: hidden;
            transition: .25s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn.alt {
            background: linear-gradient(145deg, #1e2f5b, #162547);
            color: var(--text);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px -6px rgba(0, 0, 0, .6);
        }

        .notice {
            font-size: 13px;
            color: var(--muted);
            margin-top: 8px;
        }

        .fade-in {
            animation: fade .45s;
        }

        @keyframes fade {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pop {
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @media (max-width:720px) {
            .cell {
                min-height: 70px;
                font-size: 13px;
            }

            .options button {
                font-size: 14px;
            }
        }

        /* Removed old chaser reveal strip (replaced by answer review delay + animations) */
        /* Dual answer input bar */
        .answer-entry {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 14px 0 4px;
            align-items: center;
        }

        .answer-entry label {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .answer-entry select {
            /* Force custom theming (some browsers keep default white) */
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: linear-gradient(145deg, #1e2f5b, #162547) !important; /* align with .btn.alt gradient */
            background-color: #1e2f5b !important; /* fallback */
            border: 1px solid rgba(255,255,255,0.18) !important;
            color: var(--text) !important;
            padding: 10px 12px;
            border-radius: 10px;
            font: 600 14px Montserrat, sans-serif;
            min-width: 90px;
            cursor: pointer;
            transition: border-color .25s, box-shadow .25s, background .35s;
            line-height: 1.15;
            box-shadow: 0 2px 6px -2px rgba(0,0,0,.55) inset, 0 0 0 1px rgba(255,255,255,0.05);
            position: relative;
        }
        /* Custom dropdown arrow */
        .answer-entry select:after { content:""; }
        .answer-entry select::-ms-expand { display: none; }
        .answer-entry select option { background:#162547; color: var(--text); }
        .answer-entry select:hover:not(:disabled) {
            background: linear-gradient(145deg, #233662, #1a294d);
        }
        .answer-entry select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 1px var(--accent), 0 4px 14px -4px rgba(0,230,255,0.45);
        }

        .answer-entry button.submit-answers {
            background: linear-gradient(90deg, var(--accent), var(--accent2));
            color: #06141c;
            font: 800 13px/1 Montserrat, sans-serif;
            padding: 12px 18px;
            border: none;
            border-radius: 12px;
            letter-spacing: .08em;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .answer-entry button.submit-answers:disabled {
            opacity: .5;
            cursor: not-allowed;
        }

        .answer-entry button.trigger-timer {
            background: linear-gradient(145deg, #1e2f5b, #162547); /* match Reset Round (.btn.alt) */
            color: var(--text);
            font: 800 12px/1 Montserrat, sans-serif;
            padding: 12px 18px;
            border: 1px solid rgba(255,255,255,0.14);
            border-radius: 14px;
            letter-spacing: .08em;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            position: relative;
            overflow: hidden;
            transition: .25s;
            box-shadow: 0 6px 16px -6px rgba(0,0,0,.55);
        }
        .answer-entry button.trigger-timer:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px -6px rgba(0,0,0,.6);
            filter: brightness(1.05);
        }
        .answer-entry button.trigger-timer:disabled { opacity:.5; cursor:not-allowed; }
        .answer-entry .countdown { font-size:18px; font-weight:800; font-family:Orbitron,Montserrat,sans-serif; letter-spacing:.06em; min-width:44px; text-align:center; color:var(--danger); }
        .answer-entry .countdown.warning { animation: pulse 1s infinite; }
        @keyframes pulse { 0%,100% { transform:scale(1); filter:brightness(1); } 50% { transform:scale(1.15); filter:brightness(1.4); } }

        .answer-entry small {
            font-size: 11px;
            color: var(--muted);
        }

        .divider-line {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--line), transparent);
            margin: 10px 0;
        }
                .tip { display: flex; color: #b3c5ff; opacity: .9; font-size: 14px; align-items: center; }


        /* Prize ladder (mirrors round2 minimal subset) now separate side box */
    .question-layout { display:flex; align-items:stretch; gap:12px; }
    .question-layout .panel { flex:1; display:flex; flex-direction:column; }
    .question-layout .panel #questionArea { flex:1; display:flex; flex-direction:column; }
    .question-layout .panel #questionArea .options { flex:0 0 auto; }
    .question-layout .panel #questionArea .actions { margin-top:auto; }
    .prize-ladder { flex:0 0 260px; display:flex; flex-direction:column; font-family: Orbitron, Montserrat, sans-serif; background: linear-gradient(180deg, rgba(255,255,255,0.08), rgba(255,255,255,0.03)); border:1px solid var(--line); border-radius:16px; padding:16px 18px 12px; box-shadow:0 6px 18px -6px rgba(0,0,0,.55), inset 0 0 0 1px rgba(255,255,255,0.04); }
    .prize-ladder .tier-row:last-child { margin-bottom:auto; }
        .prize-ladder h3 { margin:0 0 12px; font-size:14px; letter-spacing:.18em; text-transform:uppercase; opacity:.85; }
        .tier-row { display:flex; align-items:center; justify-content:space-between; gap:10px; padding:6px 10px; border-radius:10px; margin-bottom:6px; font-size:12px; background: rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08); }
        .tier-row.active { background: linear-gradient(90deg, rgba(94,177,255,.25), rgba(94,231,255,.25)); box-shadow: inset 0 0 0 1px rgba(94,231,255,.45); }
        .tier-row .prize { font-weight:700; color: var(--gold); letter-spacing:.04em; }
        .tier-row:last-child { margin-bottom:0; }
        @media (max-width: 1000px){
            .question-layout { flex-direction:column; }
            .prize-ladder { width:100%; }
        }

        /* Mini roster (shared style with round2) */
        .mini-roster { position: fixed; top: 50%; left: 10px; transform: translateY(-50%); width: 238px; max-height: 80vh; overflow: visible; background: rgba(10,18,35,0.55); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.14); border-radius: 18px; padding: 10px 12px 12px; z-index: 60; display: flex; flex-direction: column; gap: 8px; box-shadow: 0 8px 28px -6px rgba(0,0,0,0.55), 0 0 0 1px rgba(255,255,255,0.05) inset; font-family: 'Montserrat', system-ui, sans-serif; }
        .mini-roster.collapsed { width: 72px; padding: 8px 10px 10px; }
        .mini-roster-header { display:flex; align-items:center; justify-content:space-between; gap:6px; }
        .mini-roster-title { font-size:11px; letter-spacing:.14em; font-weight:700; color:#9cd9ff; opacity:.9; }
        .mini-roster-toggle { cursor:pointer; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.2); color:#9cd9ff; border-radius:8px; font-size:11px; font-weight:600; padding:4px 8px; letter-spacing:.08em; }
        .mini-roster-toggle:hover { background:rgba(255,255,255,0.14); }
        .mini-roster-list { display:flex; flex-direction:column; gap:6px; }
        .player-row { display:flex; align-items:center; gap:6px; }
        .player-row input.player-name { flex:1 1 auto; min-width:0; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.18); border-radius:8px; padding:4px 8px 5px; font-size:12px; font-weight:600; color:#e6f2ff; outline:none; letter-spacing:.03em; transition:border-color .2s, box-shadow .2s, background .25s; }
        .player-row input.player-name:focus { border-color:#57f1ff; box-shadow:0 0 0 1px #57f1ff, 0 4px 14px -4px rgba(87,241,255,0.5); background:rgba(255,255,255,0.12); }
        .points { flex:0 0 auto; width:32px; max-width:32px; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.18); border-radius:8px; padding:4px 3px 5px; font-size:11px; font-weight:700; color:#ffd166; text-align:center; outline:none; transition:border-color .2s, box-shadow .2s, background .25s; box-sizing:border-box; }
        .points:focus { border-color:#ffd166; box-shadow:0 0 0 1px #ffd166, 0 4px 14px -4px rgba(255,209,102,0.45); background:rgba(255,255,255,0.12); }
        .collapsed .mini-roster-list { display:none; }
        .collapsed .mini-roster-title { writing-mode: vertical-rl; transform: rotate(180deg); letter-spacing:.2em; font-size:10px; }
        .collapsed .mini-roster-toggle { padding:4px 6px; font-size:10px; }
        @media (max-width: 1100px){ .mini-roster { display:none; } }
    </style>
</head>

<body>
    <div class="wrap">
        <h1>Head to Head</h1>
        <div class="board-area">
            <div class="board-header">
                <div class="legend">
                    <span><i class="badge home"></i> Home</span>
                    <span><i class="badge player"></i> Player</span>
                    <span><i class="badge chaser"></i> Chaser</span>
                </div>
                <div class="position-admin" id="positionAdmin">
                    <label>Player<input type="number" min="0" max="10" id="playerPosInput" /></label>
                    <label>Chaser<input type="number" min="0" max="11" id="chaserPosInput" /></label>
                    <button type="button" id="updatePositionsBtn">UPDATE</button>
                </div>
            </div>
            <div class="board-track">
                <div class="board-wrapper">
                    <div id="board" class="board" aria-live="polite"></div>
                </div>
            </div>
        </div>
        <div class="question-layout">
            <div id="panel" class="panel fade-in">
                <div id="statusWrap"></div>
                <div id="questionArea">
                    <div id="questionText" class="qtext"></div>
                    <div class="divider-line"></div>
                    <div class="options" id="options"></div>
                    <div class="answer-entry" id="manualInputs" style="display:flex;">
                        <label for="playerSelect">Player</label>
                        <select id="playerSelect" aria-label="Player answer">
                            <option value="" selected disabled>--</option>
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="dna">DNA</option>
                        </select>
                        <label for="chaserSelect">Chaser</label>
                        <select id="chaserSelect" aria-label="Chaser answer">
                            <option value="" selected disabled>--</option>
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="dna">DNA</option>
                        </select>
                        <button class="trigger-timer" id="startCountdown" type="button" title="Start 10s response window">Somebody Answered</button>
                        <span class="countdown" id="countdownDisplay" aria-live="polite" style="display:none;">10</span>
                        <button class="submit-answers" id="submitBoth" disabled type="button">Lock Answers</button>
                        <small>(Select both answers & lock)</small>
                    </div>
                    <div class="divider-line"></div>
                    <div class="actions">
                        <button class="btn" id="nextQuestionBtn" type="button" style="display:none;">Next Question</button>
                        <button class="btn alt" id="resetBtn" type="button">Reset Round</button>
                        <div class="tip">Check the stage VC chat for an explanation for the current round!</div>

                    </div>
                </div>
                <div id="endActions" class="actions" style="display:none;">
                    <button class="btn" id="playAgain" type="button">Play Again</button>
                </div>
            </div>
            <aside class="prize-ladder fade-in" aria-label="Prize ladder">
                <h3>Prize Ladder</h3>
                <div class="tier-row"><span>01</span><span class="prize">5 Moonseyes</span></div>
                <div class="tier-row"><span>02</span><span class="prize">15 Idols, 5 Moonseyes</span></div>
                <div class="tier-row"><span>03</span><span class="prize">Whistling Periapt</span></div>
                <div class="tier-row"><span>04</span><span class="prize">Obt Relic of Choice</span></div>
                <div class="tier-row"><span>05</span><span class="prize">Obt Item of Choice</span></div>
                <div class="tier-row"><span>06</span><span class="prize">Name</span></div>
                <div class="tier-row"><span>07</span><span class="prize">Name + Mantle</span></div>
                <div class="tier-row"><span>08</span><span class="prize">Name + Title</span></div>
                <div class="tier-row"><span>09</span><span class="prize">Name + Title + Mantle</span></div>
                <div class="tier-row"><span>10</span><span class="prize">Name + Title + Obt item</span></div>
            </aside>
        </div>
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
        const csrf = document.querySelector('meta[name="csrf-token"]').content;
        const boardEl = document.getElementById('board');
        const playerPosInput = document.getElementById('playerPosInput');
        const chaserPosInput = document.getElementById('chaserPosInput');
        const updatePositionsBtn = document.getElementById('updatePositionsBtn');
        const qText = document.getElementById('questionText');
        const optionsEl = document.getElementById('options');
        const statusWrap = document.getElementById('statusWrap');
        const questionArea = document.getElementById('questionArea');
        const endActions = document.getElementById('endActions');
        const playAgainBtn = document.getElementById('playAgain');
        const resetBtn = document.getElementById('resetBtn');
        const nextBtn = document.getElementById('nextQuestionBtn');

        let locked = false;
        let lastRenderBoard = null;
    let countdownTimer = null;
    let countdownRemaining = 10;
    const startCountdownBtn = document.getElementById('startCountdown');
    const countdownDisplay = document.getElementById('countdownDisplay');

        function buildBoard(board, animate = true) {
            const {
                playerPos,
                chaserPos,
                size
            } = board;
            boardEl.innerHTML = '';
            for (let i = 0; i < size; i++) {
                let cls = 'cell';
                if (i === 0) cls += ' home';
                // Square 11 (chaser square) is chaser-only; prevent collision display
                if (i === playerPos && i === chaserPos && i !== size - 1) {
                    cls += ' caught';
                } else {
                    if (i === playerPos) cls += ' player';
                    if (i === chaserPos) cls += ' chaser';
                }
                // Any index greater than chaser position is "behind" the chaser
                if (i > chaserPos) cls += ' behind-chaser';
                const div = document.createElement('div');
                // animation removed
                div.className = cls;
                const label = document.createElement('span');
                label.className = 'label';
                if (i === 0) label.textContent = 'HOME';
                else if (i === size - 1) label.textContent = 'CHASE';
                else label.textContent = `S${i}`;
                div.appendChild(label);
                const main = document.createElement('div');
                if (i === playerPos && i === chaserPos && i !== size - 1) {
                    main.textContent = 'CAUGHT';
                } else if (i === playerPos) {
                    main.textContent = 'PLAYER';
                } else if (i === chaserPos) {
                    main.textContent = 'CHASER';
                } else {
                    main.textContent = '';
                }
                boardEl.appendChild(div);
                if (main.textContent) div.insertBefore(main, label);
            }
            lastRenderBoard = {
                playerPos,
                chaserPos
            };
            if (playerPosInput && chaserPosInput) {
                playerPosInput.value = playerPos;
                chaserPosInput.value = chaserPos;
            }
        }

        function setQuestion(q) {
            if (!q) {
                qText.textContent = 'No question.';
                optionsEl.innerHTML = '';
                return;
            }
            qText.textContent = q.question;
            optionsEl.innerHTML = '';
            ['a', 'b', 'c'].forEach(letter => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.dataset.choice = letter;
                btn.innerHTML = `<strong>${letter.toUpperCase()}.</strong> ${q['option_'+letter]}`;
                // Buttons now just highlight selection for quick reference; no submission on click.
                btn.addEventListener('click', () => {
                    // Toggle highlight for convenience
                    optionsEl.querySelectorAll('button').forEach(b => b.classList.remove('selected'));
                    btn.classList.add('selected');
                });
                optionsEl.appendChild(btn);
            });
        }

        async function fetchState() {
            const r = await fetch('{{ route('h2h.state') }}');
            const data = await r.json();
            render(data);
        }

        async function submitBothAnswers(playerChoice, chaserChoice) {
            if (locked) return;
            locked = true;
            optionsEl.querySelectorAll('button').forEach(b => b.classList.add('locked'));
            try {
                const r = await fetch('{{ route('h2h.answer.json') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        player_answer: playerChoice,
                        chaser_answer: chaserChoice
                    })
                });
                const data = await r.json();
                markAnswer(playerChoice, data.last.correctOption, data.last);
                // Show Next button after short review window
                nextBtn.style.display = data.state ? 'none' : 'inline-flex';
                if (data.state) {
                    setTimeout(() => render(data), 900);
                } else {
                    // Keep same question & board displayed for review; do not fetch new yet
                    render(data, true); // answered mode
                }
            } catch (e) {
                console.error(e);
                locked = false;
            }
        }

        function markAnswer(playerChosen, correct, last) {
            optionsEl.querySelectorAll('button').forEach(b => {
                const c = b.dataset.choice;
                if (c === correct) b.classList.add('correct');
                if (c === playerChosen && c !== correct && playerChosen !== 'dna') b.classList.add('wrong');
                if (c === last.chaserAnswer && c !== correct && last.chaserAnswer !== 'dna') b.classList.add('wrong');
            });
        }

        // Removed showMeta; visual feedback is on buttons only now

        function render(data, answeredMode = false) {
            locked = answeredMode; // while reviewing answers keep locked until Next pressed
            buildBoard(data.board, !
            answeredMode); // animations on fresh question, not during locked review state? Actually animate on movement already.
            statusWrap.innerHTML = '';
            if (data.state) {
                questionArea.style.display = 'none';
                endActions.style.display = 'flex';
                const div = document.createElement('div');
                div.className = 'status ' + (data.state === 'win' ? 'win' : 'lose');
                div.textContent = data.state === 'win' ? 'Escaped!' : 'Caught!';
                statusWrap.appendChild(div);
            } else {
                questionArea.style.display = 'block';
                endActions.style.display = 'none';
                if (!answeredMode) {
                    // fresh question
                    setQuestion(data.question);
                    // reset selects
                    playerSelect.value = '';
                    chaserSelect.value = '';
                    resetCountdown();
                    updateSubmitState();
                    nextBtn.style.display = 'none';
                    optionsEl.querySelectorAll('button').forEach(b => {
                        b.classList.remove('correct', 'wrong', 'selected', 'locked');
                    });
                }
            }
        }

        playAgainBtn.addEventListener('click', resetRound);
        resetBtn.addEventListener('click', resetRound);

        // Manual dual-select submission handling
        const playerSelect = document.getElementById('playerSelect');
        const chaserSelect = document.getElementById('chaserSelect');
        const submitBoth = document.getElementById('submitBoth');

        function updateSubmitState() {
            submitBoth.disabled = !(playerSelect.value && chaserSelect.value) || locked;
        }
        playerSelect.addEventListener('change', updateSubmitState);
        chaserSelect.addEventListener('change', updateSubmitState);
        submitBoth.addEventListener('click', () => {
            if (playerSelect.value && chaserSelect.value) {
                submitBothAnswers(playerSelect.value, chaserSelect.value);
            }
            stopCountdown();
            updateSubmitState();
        });

        nextBtn.addEventListener('click', async () => {
            if (locked) {
                try {
                    const r = await fetch('{{ route('h2h.next') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                            'Accept': 'application/json'
                        }
                    });
                    const data = await r.json();
                    render(data, false);
                    stopCountdown();
                } catch (e) {
                    console.error(e);
                }
            }
        });

        async function resetRound() {
            locked = true;
            try {
                const r = await fetch('{{ route('h2h.reset.json') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json'
                    }
                });
                const data = await r.json();
                render(data);
            } catch (e) {
                console.error(e);
            } finally {
                locked = false;
                stopCountdown();
            }
        }

        fetchState();
        updateSubmitState();

        updatePositionsBtn.addEventListener('click', async () => {
            const p = parseInt(playerPosInput.value, 10);
            const c = parseInt(chaserPosInput.value, 10);
            if (Number.isNaN(p) || Number.isNaN(c) || p < 0 || p > 10 || c < 0 || c > 11) {
                alert('Player must be 0-10 and Chaser 0-11');
                return;
            }
            try {
                updatePositionsBtn.disabled = true;
                const r = await fetch('{{ route('h2h.set.positions') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        playerPos: p,
                        chaserPos: c
                    })
                });
                const data = await r.json();
                render(data, false);
                stopCountdown();
            } catch (e) {
                console.error(e);
            } finally {
                updatePositionsBtn.disabled = false;
            }
        });

        // Countdown logic
        function startCountdown(){
            if(countdownTimer) return; // already running
            countdownRemaining = 10;
            countdownDisplay.textContent = countdownRemaining;
            countdownDisplay.style.display = 'inline-block';
            countdownDisplay.classList.remove('warning');
            startCountdownBtn.disabled = true;
            countdownTimer = setInterval(()=>{
                countdownRemaining--;
                if(countdownRemaining <= 3){ countdownDisplay.classList.add('warning'); }
                if(countdownRemaining <= 0){
                    countdownDisplay.textContent = '0';
                    stopCountdown();
                    // Host can manually set DNA for missing answer; no auto action per spec.
                    return;
                }
                countdownDisplay.textContent = countdownRemaining;
            },1000);
        }
        function stopCountdown(){
            if(countdownTimer){ clearInterval(countdownTimer); countdownTimer = null; }
            startCountdownBtn.disabled = false;
            countdownDisplay.style.display = 'none';
            countdownDisplay.classList.remove('warning');
        }
        function resetCountdown(){ stopCountdown(); }
        startCountdownBtn.addEventListener('click', startCountdown);

        /* Mini roster persistence (unified with round2) */
        const SHARED_NAME = i => `roster_player_${i}_name`;
        const SHARED_PTS  = i => `roster_player_${i}_pts`;
        const LEGACY_KEY_SETS = [
            { name: i => `h2h_player_${i}_name`, pts: i => `h2h_player_${i}_pts` },
            { name: i => `r2_player_${i}_name`, pts: i => `r2_player_${i}_pts` }
        ];
        function migrateLegacy(){
            for(let i=1;i<=5;i++){
                const sn = SHARED_NAME(i); const sp = SHARED_PTS(i);
                if(!localStorage.getItem(sn)){
                    for(const set of LEGACY_KEY_SETS){
                        const v = localStorage.getItem(set.name(i)); if(v){ localStorage.setItem(sn, v); break; }
                    }
                }
                if(!localStorage.getItem(sp)){
                    for(const set of LEGACY_KEY_SETS){
                        const v = localStorage.getItem(set.pts(i)); if(v){ localStorage.setItem(sp, v); break; }
                    }
                }
            }
        }
        function loadMiniRoster(){
            for(let i=1;i<=5;i++){
                const nameInput = document.querySelector(`input[data-h2h-name="${i}"]`);
                const ptsInput = document.querySelector(`input[data-h2h-pts="${i}"]`);
                if(nameInput){ nameInput.value = localStorage.getItem(SHARED_NAME(i)) || ''; }
                if(ptsInput){ ptsInput.value = localStorage.getItem(SHARED_PTS(i)) || ''; }
            }
        }
        function saveMiniRoster(ev){
            const t = ev.target;
            if(t.matches('input[data-h2h-name]')){
                const slot = t.dataset.h2hName; localStorage.setItem(SHARED_NAME(slot), t.value.trim());
            } else if(t.matches('input[data-h2h-pts]')){
                const slot = t.dataset.h2hPts; localStorage.setItem(SHARED_PTS(slot), t.value.trim());
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
    <aside id="miniRoster" class="mini-roster collapsed" aria-label="Head to Head roster" aria-expanded="false">
        <div class="mini-roster-header">
            <div class="mini-roster-title">PLAYERS</div>
            <button id="miniRosterToggle" type="button" class="mini-roster-toggle" aria-pressed="false" aria-label="Toggle players panel">⇔</button>
        </div>
        <div class="mini-roster-list" role="list">
            @for($i=1;$i<=5;$i++)
            <div class="player-row" role="listitem">
                <input type="text" class="player-name" data-h2h-name="{{ $i }}" maxlength="28" placeholder="Player {{ $i }}" aria-label="Player {{ $i }} name" />
                <input type="text" data-h2h-pts="{{ $i }}" maxlength="6" class="points" placeholder="0" aria-label="Player {{ $i }} points" />
            </div>
            @endfor
        </div>
    </aside>
</body>

</html>
