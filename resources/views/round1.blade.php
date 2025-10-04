<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tournament Tavern — Game Show</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&family=Bungee+Shade&family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg1: #0b0f1a;
            --bg2: #0f1630;
            --accent: #00e6ff;
            --accent-2: #ff00f3;
            --gold: #ffd166;
            --text: #eaf4ff;
            --glass: rgba(255,255,255,0.08);
            --glass-strong: rgba(255,255,255,0.14);
        }
        * { box-sizing: border-box; }
        html, body { height: 100%; }
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
            position: fixed; inset: 0; pointer-events: none; opacity: .35;
            background-image:
                radial-gradient(2px 2px at 20% 30%, rgba(255,255,255,.6), transparent 60%),
                radial-gradient(2px 2px at 80% 40%, rgba(255,255,255,.4), transparent 60%),
                radial-gradient(2px 2px at 50% 70%, rgba(255,255,255,.7), transparent 60%);
            animation: twinkle 6s ease-in-out infinite;
            filter: blur(.3px);
        }
        @keyframes twinkle { 0%,100%{opacity:.2; transform: translateY(0);} 50%{opacity:.5; transform: translateY(-6px);} }

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
            background: linear-gradient(180deg, rgba(255,255,255,0.14), rgba(255,255,255,0.06));
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.15);
            box-shadow:
                0 10px 30px rgba(0,0,0,0.4),
                inset 0 0 0 1px rgba(255,255,255,0.06);
            position: relative;
            overflow: hidden;
        }
        .stage::after {
            content: "";
            position: absolute; inset: -2px;
            background: conic-gradient(from 0deg,
                var(--accent), var(--accent-2), var(--gold), var(--accent), var(--accent-2));
            filter: blur(22px);
            opacity: .15;
            z-index: 0;
            animation: hue 12s linear infinite;
            pointer-events: none;
        }
        @keyframes hue { to { filter: blur(22px) hue-rotate(360deg); } }

        header {
            position: relative; z-index: 1;
            display: flex; align-items: center; justify-content: space-between;
            gap: 16px; margin-bottom: clamp(16px, 2vw, 24px);
        }
        .brand {
            display: flex; align-items: center; gap: 14px;
            letter-spacing: 1px;
        }
        .logo {
            width: 100px; height: 100px; border-radius: 28px;
            background: radial-gradient(circle at 30% 30%, var(--gold), #e24bff 60%, #5ee7ff 100%);
            box-shadow: 0 0 25px rgba(0, 153, 255, 0.45), 0 0 18px rgba(0, 230, 255, .35) inset;
            background-image: url('{{ asset('img/tt.png') }}');
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
        }
        .title {
            font-family: 'Orbitron', system-ui, sans-serif;
            font-weight: 900; font-size: clamp(20px, 2.6vw, 48px);
            line-height: 1.05;
            text-transform: uppercase;
            text-shadow: 0 0 12px rgba(0, 230, 255, .45), 0 0 24px rgba(255, 0, 243, .25);
        }
        .badge {
            font-family: 'Orbitron', system-ui, sans-serif;
            padding: 10px 14px; border-radius: 999px; font-weight: 700; letter-spacing: .08em;
            font-size: 12px; color: #0a0d16;
            background: linear-gradient(90deg, #5eb1ff, #5ee7ff);
            box-shadow: 0 6px 18px rgba(82, 128, 180, 0.35);
        }
        .question-wrap {
            position: relative; z-index: 1;
            padding: clamp(16px, 2vw, 28px);
            border-radius: 22px;
            background: var(--glass);
            border: 1px solid rgba(255,255,255,0.14);
            box-shadow: inset 0 0 30px rgba(255,255,255,0.04);
            cursor: pointer;
        }
        .question-wrap:hover { box-shadow: inset 0 0 30px rgba(255,255,255,0.06), 0 8px 22px rgba(0,0,0,.25); }
        .question-wrap:focus-visible { outline: 2px solid rgba(87,241,255,.8); outline-offset: 4px; }
        .question-cover { display: grid; place-items: center; gap: 12px; text-align: center; padding: 12px 4px; }
        .question-wrap .question { display: none; }
        .question-wrap.q-revealed .question-cover { display: none; }
        .question-wrap.q-revealed .question { display: block; animation: pop .35s ease; }
        .question-label {
            font-family: 'Orbitron', system-ui, sans-serif;
            font-size: 14px; letter-spacing: .2em; opacity: .9;
            color: #a6c8ff;
        }
        .question {
            margin: 6px 0 0;
            font-weight: 900;
            font-size: clamp(28px, 4.8vw, 46px);
            line-height: 1.05;
            text-shadow: 0 6px 22px rgba(0,0,0,.45), 0 0 22px rgba(0, 230, 255, .25);
        }
        .answer-wrap {
            position: relative; z-index: 1;
            margin-top: clamp(14px, 2.6vw, 28px);
        }
        .answer-card {
            position: relative;
            border-radius: 20px;
            padding: clamp(18px, 3.2vw, 32px);
            background: linear-gradient(180deg, rgba(10, 14, 30, 0.7), rgba(14, 18, 40, 0.9));
            border: 1px solid rgba(255,255,255,0.16);
            box-shadow: 0 8px 24px rgba(0,0,0,0.35), inset 0 0 0 1px rgba(255,255,255,0.06);
            cursor: pointer;
            user-select: none;
            transition: transform .25s ease, box-shadow .25s ease;
            outline: none;
            overflow: hidden; /* ensure shimmer stays within the card */
        }
        .answer-card:hover { transform: translateY(-2px); box-shadow: 0 14px 30px rgba(0,0,0,0.45), inset 0 0 0 1px rgba(255,255,255,0.08); }
        .answer-card:active { transform: translateY(0); }
        .answer-card::before {
            /* shimmer */
            content: ""; position: absolute; inset: 0; border-radius: 20px; pointer-events: none;
            background: linear-gradient(120deg, transparent 0%, rgba(255,255,255,.18) 15%, transparent 30%);
            transform: translateX(-120%);
            animation: shimmer 4.8s ease-in-out infinite;
        }
        @keyframes shimmer { 0%{ transform: translateX(-120%);} 35%{ transform: translateX(120%);} 100%{ transform: translateX(120%);} }

        .cta {
            display: inline-flex; align-items: center; gap: 10px;
            font-weight: 800; letter-spacing: .06em; color: #9cd9ff;
            font-size: clamp(16px, 1.6vw, 20px);
            opacity: .95;
        }
        .keycap {
            display: inline-block; min-width: 28px; text-align: center; padding: 6px 10px; border-radius: 8px;
            background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.22);
            box-shadow: inset 0 -1px 0 rgba(255,255,255,.25);
            font-family: 'Orbitron', system-ui, sans-serif; font-weight: 700; color: #e7f3ff;
        }
        .answer {
            display: none;
            font-size: clamp(22px, 3.2vw, 48px);
            font-weight: 800;
            line-height: 1.15;
            color: #ffffff;
            text-shadow: 0 0 22px rgba(255, 0, 243, .35), 0 0 14px rgba(0, 230, 255, .28);
        }
        .answer.revealed { display: block; animation: pop .35s ease; }
        @keyframes pop { 0%{ transform: scale(.9); opacity:.5;} 100%{ transform: scale(1); opacity:1;} }
        .reveal-cover { display: grid; place-items: center; gap: 12px; text-align: center; padding: 12px 4px; }
        .reveal-title { font-family: 'Orbitron', system-ui, sans-serif; font-weight: 900; font-size: clamp(18px, 2.2vw, 28px); letter-spacing: .1em; color: #bde7ff; text-transform: uppercase; }
        .reveal-sub { opacity: .85; color: #a4b5ff; font-size: clamp(12px, 1.2vw, 14px); }
        .reveal-icon { width: 40px; height: 40px; color: #bde7ff; filter: drop-shadow(0 0 8px rgba(0, 230, 255, .4)); }
        .answer-card.revealed .reveal-cover { display: none; }
        .answer-card.revealed { box-shadow: 0 16px 38px rgba(0,0,0,0.55), 0 0 0 3px rgba(0, 230, 255, .25) inset; }

        footer { position: relative; z-index: 1; margin-top: clamp(16px, 2vw, 28px); display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
        .tip { color: #b3c5ff; opacity: .9; font-size: 14px; }
        .controls { display: flex; gap: 10px; flex-wrap: wrap; }
        .btn {
            font-family: 'Orbitron', system-ui, sans-serif;
            border: solid; border-radius: 12px; padding: 10px 14px; font-weight: 800; letter-spacing: .06em; cursor: pointer; border-color: #294e70;
            color: #061122; background: linear-gradient(90deg, #5eb1ff, #5ee7ff); box-shadow: 0 8px 22px rgba(87, 241, 255, .35);
        }
        .btn.secondary { color: #dfe9ff; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.18); box-shadow: none; }

        /* Confetti canvas */
        canvas#confetti { position: fixed; inset: 0; pointer-events: none; z-index: 30; }

        @media (max-width: 520px) {
            header { flex-direction: column; align-items: flex-start; }
            .controls { width: 100%; }
            .btn { flex: 1; }
        }

        /* Roster panel (Red / Blue Teams) */
        .roster-panel {
            position: fixed; top: 50%; right: 10px; transform: translateY(-50%);
            width: 210px; max-height: 80vh; overflow: hidden;
            background: rgba(10,18,35,0.55); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.14); border-radius: 18px;
            padding: 10px 12px 12px; z-index: 40;
            display: flex; flex-direction: column; gap: 6px;
            box-shadow: 0 8px 28px -6px rgba(0,0,0,0.55), 0 0 0 1px rgba(255,255,255,0.05) inset;
            font-family: 'Montserrat', system-ui, sans-serif;
        }
        .roster-panel.collapsed { width: 70px; padding: 8px 10px 10px; }
        .roster-header { display: flex; align-items: center; justify-content: space-between; gap: 6px; }
        .roster-title { font-size: 11px; letter-spacing: .14em; font-weight: 700; color: #9cd9ff; opacity: .9; }
        .roster-toggle { cursor: pointer; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); color: #9cd9ff; border-radius: 8px; font-size: 11px; font-weight: 600; padding: 4px 8px; letter-spacing: .08em; }
        .roster-toggle:hover { background: rgba(255,255,255,0.14); }
        .roster-groups { display: flex; flex-direction: column; gap: 10px; margin-top: 4px; }
        .team-block { display: flex; flex-direction: column; gap: 4px; padding: 6px 6px 8px; border-radius: 12px; position: relative; }
        .team-block.red { background: linear-gradient(140deg, rgba(255,40,40,0.20), rgba(120,0,0,0.18)); border: 1px solid rgba(255,80,80,0.35); }
        .team-block.blue { background: linear-gradient(140deg, rgba(40,120,255,0.20), rgba(0,40,120,0.18)); border: 1px solid rgba(80,140,255,0.35); }
        .team-label { font-size: 10px; font-weight: 800; letter-spacing: .18em; opacity: .85; text-transform: uppercase; display: flex; align-items: center; gap:4px; }
        .team-label .dot { width:10px; height:10px; border-radius:50%; background: currentColor; box-shadow:0 0 8px currentColor; }
        .team-block.red .team-label { color: #ff6363; }
        .team-block.blue .team-label { color: #63b6ff; }
        .roster-list { display: flex; flex-direction: column; gap: 4px; margin-top: 2px; }
        .roster-list label { font-size: 0; }
        .roster-list input {
            width: 100%; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.18);
            border-radius: 8px; padding: 4px 8px 5px; font-size: 12px; font-weight: 600; color: #e6f2ff;
            outline: none; letter-spacing: .03em; transition: border-color .2s, box-shadow .2s, background .25s;
        }
        .roster-list input:focus { border-color: #57f1ff; box-shadow: 0 0 0 1px #57f1ff, 0 4px 14px -4px rgba(87,241,255,0.5); background: rgba(255,255,255,0.12); }
        .collapsed .roster-list { display: none; }
        .collapsed .roster-groups { display: none; }
        .collapsed .roster-title { writing-mode: vertical-rl; transform: rotate(180deg); letter-spacing: .2em; font-size: 10px; }
        .collapsed .roster-toggle { padding: 4px 6px; font-size: 10px; }
        @media (max-width: 900px) { .roster-panel { display: none; } }
    /* Timer (imported from Round 2) */
    .timer { display:flex; flex-direction:column; gap:8px; align-items:flex-start; }
    .timer-row { display:flex; align-items:center; gap:10px; flex-wrap:wrap; }
    .timer input { width:110px; padding:8px 10px; border-radius:10px; border:1px solid rgba(255,255,255,0.18); background:rgba(255,255,255,0.06); color:var(--text); }
    .time-display { font-family:'Orbitron',system-ui,sans-serif; font-weight:900; letter-spacing:.08em; padding:8px 12px; border-radius:10px; border:1px solid rgba(255,255,255,0.18); background:rgba(255,255,255,0.06); }
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
                        <span class="time-display" id="r1_time">00:00</span>
                        <input id="r1_timeInput" type="text" placeholder="mm:ss" aria-label="Set timer (mm:ss)" />
                        <button class="btn secondary icon-btn" id="r1_setTimerBtn" type="button" aria-label="Set timer" title="Set">
                            Set
                        </button>
                    </div>
                    <div class="timer-row">
                        <button class="btn secondary icon-btn" id="r1_pauseBtn" type="button" aria-label="Pause" title="Pause">⏸</button>
                        <button class="btn icon-btn" id="r1_startBtn" type="button" aria-label="Start" title="Start">▶</button>
                        <button class="btn secondary icon-btn" id="r1_resetBtn" type="button" aria-label="Reset" title="Reset">↺</button>
                        <div class="badge" title="Round">Round <span id="round">1/2</span></div>
                    </div>
                </div>
            </header>

            <div class="question-wrap" id="questionWrap" role="button" tabindex="0" aria-expanded="false" aria-label="Reveal question">
                <div class="question-cover">
                    <svg class="reveal-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="3" y="11" width="18" height="10" rx="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <div class="reveal-title">Reveal Question</div>
                </div>
                <h1 id="question" class="question">
                    <div class="question-label">Question</div>
                    {{ isset($question) && $question ? $question->question : ($question ?? 'Which creature can hold its breath the longest?') }}
                </h1>
            </div>

            <div class="answer-wrap">
                <div
                    id="answerCard"
                    class="answer-card"
                    role="button"
                    tabindex="0"
                    aria-expanded="false"
                    aria-controls="answerText"
                    data-answer="{{ isset($question) && $question ? $question->answer : ($answer ?? 'Cuvier’s beaked whale — over 3 hours!') }}"
                >
                    <div class="reveal-cover">
                        <svg class="reveal-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="3" y="11" width="18" height="10" rx="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <div class="reveal-title">Reveal Answer</div>
                    </div>
                    <div id="answerText" class="answer" aria-hidden="true"></div>
                </div>
            </div>

            <footer>
                <div class="tip">YOU CAN JOIN! Check the stage VC chat for an explanation for the current round!</div>
                <div class="controls">
                    <a class="btn" id="nextBtn" href="{{ route('round1') }}" aria-label="Next question">Next</a>
                </div>
            </footer>
        </section>
    </div>

    <script>
        const answerCard = document.getElementById('answerCard');
        const answerText = document.getElementById('answerText');
        const nextBtn = document.getElementById('nextBtn');
        const roundEl = document.getElementById('round');
        const questionWrap = document.getElementById('questionWrap');

        let revealed = false; // answer revealed
        let qRevealed = false; // question revealed
        let round = 1;

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
            }
        }

        function revealQuestion() { setQuestionVisible(true); }
        function hideQuestion() { setQuestionVisible(false); }
        function reveal() { setAnswerVisible(true); }
        function hide() { setAnswerVisible(false); }

        // Question reveal controls
        questionWrap.addEventListener('click', revealQuestion);
        questionWrap.addEventListener('keydown', (e) => {
            if (e.key === ' ' || e.key === 'Enter') { e.preventDefault(); revealQuestion(); }
        });

        // Answer reveal controls (keep card interactive)
        answerCard.addEventListener('click', () => reveal());
        answerCard.addEventListener('keydown', (e) => {
            if (e.key === ' ' || e.key === 'Enter') { e.preventDefault(); reveal(); }
        });

        // Next button navigates to a fresh random question (handled server-side)
        // No JS needed since it's a link, but keep for possible future enhancements
        nextBtn?.addEventListener('click', () => { /* navigation via href */ });

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
            ctx.fillRect(-w/2, -h/2, w, h);
            ctx.restore();
        }

        /* Roster persistence */
        const rosterKeyPrefix = 'tt_roster_slot_';
        function loadRoster(){
            for(let i=1;i<=10;i++){
                const input = document.querySelector(`input[data-roster-slot="${i}"]`);
                if(!input) continue;
                const saved = localStorage.getItem(rosterKeyPrefix + i) || '';
                input.value = saved;
            }
        }
        function saveRoster(slot, value){
            try { localStorage.setItem(rosterKeyPrefix + slot, value); } catch(e) {}
        }
        function initRoster(){
            const rosterPanel = document.getElementById('rosterPanel');
            const rosterToggle = document.getElementById('rosterToggle');
            if(!rosterPanel || !rosterToggle) return;
            loadRoster();
            rosterToggle.addEventListener('click', ()=>{
                const nowCollapsed = rosterPanel.classList.toggle('collapsed');
                rosterPanel.setAttribute('aria-expanded', String(!nowCollapsed));
                rosterToggle.setAttribute('aria-pressed', String(!nowCollapsed));
            });
        }
        document.addEventListener('input', (e)=>{
            if(e.target.matches('input[data-roster-slot]')){
                saveRoster(e.target.dataset.rosterSlot, e.target.value.trim());
            }
        });
        document.addEventListener('DOMContentLoaded', initRoster);

        /* Round1 Timer (mirrors Round2 logic with distinct storage keys) */
        const r1_timeEl = document.getElementById('r1_time');
        const r1_timeInput = document.getElementById('r1_timeInput');
        const r1_setBtn = document.getElementById('r1_setTimerBtn');
        const r1_startBtn = document.getElementById('r1_startBtn');
        const r1_pauseBtn = document.getElementById('r1_pauseBtn');
        const r1_resetBtn = document.getElementById('r1_resetBtn');
        let r1_totalSeconds = 0; // paused/remaining
        let r1_timerId = null;
        let r1_endTime = null; // epoch ms
        const R1_LS_END = 'round1TimerEnd';
        const R1_LS_REM = 'round1TimerRemain';

        function r1_formatTime(s){
            const m = Math.floor(s/60).toString().padStart(2,'0');
            const ss = Math.floor(s%60).toString().padStart(2,'0');
            return `${m}:${ss}`;
        }
        function r1_render(){ r1_timeEl.textContent = r1_formatTime(r1_totalSeconds); }
        function r1_parse(val){
            if(!val) return null; const parts = val.split(':'); if(parts.length!==2) return null;
            const m = parseInt(parts[0],10), s = parseInt(parts[1],10);
            if(Number.isNaN(m)||Number.isNaN(s)||m<0||s<0||s>=60) return null; return m*60+s;
        }
        function r1_computeRemaining(){ if(!r1_endTime) return r1_totalSeconds; const diff=Math.ceil((r1_endTime-Date.now())/1000); return diff>0?diff:0; }
        let r1_lastDisplayed = null;
        function r1_updateFromEnd(){
            const remain = r1_computeRemaining();
            if(remain!==r1_lastDisplayed){ r1_totalSeconds=remain; r1_render(); r1_lastDisplayed=remain; } else { r1_totalSeconds=remain; }
            if(r1_endTime && remain===0){ r1_stop(); r1_clearPersist(); }
        }
        function r1_tick(){ r1_updateFromEnd(); }
        function r1_start(){ if(r1_timerId || r1_totalSeconds<=0) return; r1_timerId=setInterval(r1_tick,250); r1_tick(); }
        function r1_stop(){ if(r1_timerId){ clearInterval(r1_timerId); r1_timerId=null; } }
        function r1_clearPersist(){ localStorage.removeItem(R1_LS_END); localStorage.removeItem(R1_LS_REM); r1_endTime=null; }
        function r1_reset(){ r1_stop(); r1_clearPersist(); r1_totalSeconds=0; r1_render(); }
        function r1_setNew(seconds){ r1_stop(); r1_clearPersist(); if(seconds<=0){ r1_reset(); return;} r1_totalSeconds=seconds; r1_render(); localStorage.setItem(R1_LS_REM, String(r1_totalSeconds)); }

        r1_setBtn?.addEventListener('click', ()=>{ const v=r1_parse(r1_timeInput.value); if(v==null){ alert('Enter mm:ss (e.g., 01:30)'); return;} r1_setNew(v); });
        r1_startBtn?.addEventListener('click', ()=>{
            if(!r1_endTime && r1_totalSeconds===0 && r1_timeInput.value){ const v=r1_parse(r1_timeInput.value); if(v!=null) r1_setNew(v); }
            if(r1_totalSeconds>0 && !r1_endTime){ r1_endTime=Date.now()+r1_totalSeconds*1000; localStorage.setItem(R1_LS_END, String(r1_endTime)); localStorage.removeItem(R1_LS_REM); r1_updateFromEnd(); r1_start(); }
        });
        r1_pauseBtn?.addEventListener('click', ()=>{ if(r1_endTime){ r1_updateFromEnd(); r1_stop(); localStorage.setItem(R1_LS_REM, String(r1_totalSeconds)); localStorage.removeItem(R1_LS_END); r1_endTime=null; } });
        r1_resetBtn?.addEventListener('click', r1_reset);

        (function r1_restore(){
            const runningTs = localStorage.getItem(R1_LS_END);
            const pausedRemain = localStorage.getItem(R1_LS_REM);
            if(runningTs){ const ts=parseInt(runningTs,10); if(!Number.isNaN(ts) && ts>Date.now()){ r1_endTime=ts; r1_updateFromEnd(); r1_start(); return; } else { r1_clearPersist(); } }
            if(pausedRemain){ const rem=parseInt(pausedRemain,10); if(!Number.isNaN(rem) && rem>0){ r1_totalSeconds=rem; } }
            r1_render();
        })();
    </script>
    <!-- Roster Panel (10 slots) -->
    <aside id="rosterPanel" class="roster-panel collapsed" aria-label="Roster name slots" aria-expanded="false">
        <div class="roster-header">
            <div class="roster-title">ROSTER</div>
            <button id="rosterToggle" type="button" class="roster-toggle" aria-pressed="false" aria-label="Toggle roster panel">⇔</button>
        </div>
        <div class="roster-groups">
            <div class="team-block red" aria-labelledby="red-team-label">
                <div id="red-team-label" class="team-label"><span class="dot" aria-hidden="true"></span> RED TEAM</div>
                <div class="roster-list" role="list">
                    @for($i=1;$i<=5;$i++)
                        <input data-roster-slot="{{ $i }}" maxlength="28" placeholder="Red {{ $i }}" aria-label="Red Team slot {{ $i }}" />
                    @endfor
                </div>
            </div>
            <div class="team-block blue" aria-labelledby="blue-team-label">
                <div id="blue-team-label" class="team-label"><span class="dot" aria-hidden="true"></span> BLUE TEAM</div>
                <div class="roster-list" role="list">
                    @for($i=6;$i<=10;$i++)
                        <input data-roster-slot="{{ $i }}" maxlength="28" placeholder="Blue {{ $i-5 }}" aria-label="Blue Team slot {{ $i-5 }}" />
                    @endfor
                </div>
            </div>
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
</body>
</html>
