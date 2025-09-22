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
            background-image: url('https://cdn.discordapp.com/attachments/1347666110480121867/1416455424563220500/image.png?ex=68c6e869&is=68c596e9&hm=03042464f8a0acad788e9658391fadf016d7209a21960b16c058a92bad3cb27b&');
            background-size: contain;
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
            font-size: clamp(28px, 4.8vw, 72px);
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
                <div class="badge" title="Round">Round <span id="round">1</span></div>
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
                <div class="tip">Tip: Use brain</div>
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
    </script>
</body>
</html>
