<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Head to Head</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600;800&family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
<style>
/* Adopt round2 palette variables (harmonized) */
:root { --bg:#050914;--panel:#0f1630;--panel2:#162042;--line:rgba(255,255,255,.15);--accent:#00e6ff;--accent2:#ff00f3;--gold:#ffd166;--danger:#ff3d55;--ok:#24e699;--text:#eaf4ff;--muted:#94a4c4;}
*{box-sizing:border-box;}body{margin:0;font-family:Montserrat,system-ui,sans-serif;background:radial-gradient(circle at 22% 18%,#18254d 0%,#050914 70%);color:var(--text);min-height:100dvh;display:flex;flex-direction:column;}
h1{font-family:Orbitron,sans-serif;letter-spacing:.05em;text-transform:uppercase;margin:0 0 8px;}
.wrap{max-width:1400px;margin:0 auto;padding:34px 32px 70px;flex:1;display:flex;flex-direction:column;gap:34px;}
/* Remove panel box for board; create integrated strip */
.board-area{display:flex;flex-direction:column;gap:10px;}
.board-header{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:20px;}
.board-header .legend{margin-left:4px;}
.board-track{position:relative;display:flex;align-items:stretch;padding:24px 30px 28px;border-radius:28px;background:linear-gradient(145deg,rgba(255,255,255,0.06),rgba(255,255,255,0.015));backdrop-filter:blur(7px);-webkit-backdrop-filter:blur(7px);border:1px solid rgba(255,255,255,0.14);box-shadow:0 10px 30px -10px rgba(0,0,0,.65),inset 0 0 0 1px rgba(255,255,255,0.05);overflow:visible;}
.board-track::before{content:"";position:absolute;inset:-1px;border-radius:22px;background:linear-gradient(90deg,var(--accent) 0%,var(--accent2) 40%,var(--gold) 80%);opacity:.12;mix-blend-mode:screen;pointer-events:none;}
.board-wrapper{flex:1;overflow-x:auto;padding-bottom:4px;}
.position-admin{margin-left:auto;display:flex;flex-wrap:nowrap;gap:16px;align-items:flex-end;}
.position-admin label{font-size:11px;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:var(--muted);display:flex;flex-direction:column;gap:6px;min-width:82px;}
.position-admin input{background:linear-gradient(145deg,#1b2b54,#142041);border:1px solid var(--line);color:var(--text);padding:8px 10px;border-radius:10px;font:600 13px Montserrat,sans-serif;width:78px;text-align:center;line-height:1.2;box-shadow:0 0 0 1px rgba(255,255,255,0.05);}
.position-admin button{background:linear-gradient(90deg,var(--accent),var(--accent2));border:none;height:46px;padding:0 26px;border-radius:14px;font:800 12px/1 Montserrat,sans-serif;letter-spacing:.14em;cursor:pointer;color:#06141c;display:inline-flex;align-items:center;justify-content:center;box-shadow:0 6px 20px -6px rgba(0,0,0,.5);}
.position-admin button:hover{filter:brightness(1.08);}
.board{display:flex;gap:16px;transition:.4s;justify-content:flex-start;flex-wrap:nowrap;min-height:110px;overflow:visible;}
.board .cell{flex:0 0 94px;}
.cell{position:relative;margin-right: 2px;margin-top: 2px;background:linear-gradient(145deg,#18254d,#121b36);border:1px solid var(--line);border-radius:18px;min-height:90px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:15px;color:var(--muted);overflow:visible;isolation:isolate;opacity:0;transform:translateY(12px) scale(.94);animation:pop .5s forwards;padding:4px 6px;}
.cell.home{background:linear-gradient(120deg,#0a302f,#0f615e);color:#b9fff1;font-weight:800;}
.cell.player{outline:2px solid var(--accent);box-shadow:0 0 0 3px rgba(87,241,255,.25),0 0 22px -4px var(--accent);}
.cell.chaser{outline:2px solid var(--danger);box-shadow:0 0 0 3px rgba(255,61,85,.35),0 0 22px -4px var(--danger);}
.cell.caught{background:linear-gradient(120deg,#4d0a1d,#8b1633);color:#fff;}
.cell .label{position:absolute;bottom:4px;right:8px;font-size:11px;opacity:.55;letter-spacing:.08em;}
/* movement animation removed for cleaner static board */
.legend{display:flex;gap:14px;flex-wrap:wrap;font-size:13px;}
.legend span{display:inline-flex;align-items:center;gap:6px;}
.badge{width:14px;height:14px;border-radius:4px;display:inline-block;background:var(--muted);border:1px solid var(--line);}
.badge.player{background:var(--accent);} .badge.chaser{background:var(--danger);} .badge.home{background:linear-gradient(120deg,#0a302f,#0f615e);}
.panel{background:linear-gradient(180deg,rgba(255,255,255,0.08),rgba(255,255,255,0.04));border:1px solid var(--line);border-radius:18px;padding:22px 24px;box-shadow:0 10px 28px -6px rgba(0,0,0,.55);}
.qtext{font-size:clamp(18px,2vw,24px);font-weight:700;line-height:1.3;margin:0 0 18px;min-height:56px;display:flex;align-items:flex-start;}
.options{display:grid;gap:14px;margin:0 0 6px;}
.options button{background:linear-gradient(145deg,#1b2b54,#142041);border:1px solid var(--line);border-radius:14px;padding:14px 18px;text-align:left;font:600 15px/1.2 Montserrat,sans-serif;color:var(--text);cursor:pointer;position:relative;transition:.25s;overflow:hidden;}
.options button::before{content:"";position:absolute;inset:0;background:linear-gradient(100deg,rgba(87,241,255,.18),rgba(255,100,242,.18));opacity:0;transition:.35s;}
.options button:hover:not(.locked){transform:translateY(-2px);box-shadow:0 6px 16px -4px rgba(0,0,0,.55);}
.options button:hover::before{opacity:1;}
.options button.correct{background:linear-gradient(145deg,#0e442e,#0c3328);border-color:#1f8c5c;}
.options button.wrong{background:linear-gradient(145deg,#3a1019,#29060d);border-color:#b0303f;}
.options button.locked{pointer-events:none;opacity:.6;}
.status{font-size:24px;font-weight:800;letter-spacing:.05em;text-transform:uppercase;margin:0 0 10px;display:flex;align-items:center;gap:14px;}
.status.win{color:var(--ok);} .status.lose{color:var(--danger);}
.actions{display:flex;gap:12px;flex-wrap:wrap;margin-top:10px;}
.btn{background:linear-gradient(90deg,var(--accent),var(--accent2));border:none;padding:12px 22px;border-radius:14px;font:800 14px/1 Montserrat,sans-serif;letter-spacing:.06em;text-transform:uppercase;cursor:pointer;color:#07161a;position:relative;overflow:hidden;transition:.25s;display:inline-flex;align-items:center;gap:8px;}
.btn.alt{background:linear-gradient(145deg,#1e2f5b,#162547);color:var(--text);}
.btn:hover{transform:translateY(-2px);box-shadow:0 10px 24px -6px rgba(0,0,0,.6);}
.notice{font-size:13px;color:var(--muted);margin-top:8px;}
.fade-in{animation:fade .45s;}
@keyframes fade{from{opacity:0;transform:translateY(8px);}to{opacity:1;transform:translateY(0);}}
@keyframes pop{to{opacity:1;transform:translateY(0) scale(1);}}
@media (max-width:720px){.cell{min-height:70px;font-size:13px;}.options button{font-size:14px;}}
/* Removed old chaser reveal strip (replaced by answer review delay + animations) */
/* Dual answer input bar */
.answer-entry{display:flex;flex-wrap:wrap;gap:10px;margin:14px 0 4px;align-items:center;}
.answer-entry label{font-size:12px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--muted);}
.answer-entry select{background:linear-gradient(145deg,#1b2b54,#142041);border:1px solid var(--line);color:var(--text);padding:10px 12px;border-radius:10px;font:600 14px Montserrat,sans-serif;min-width:90px;cursor:pointer;}
.answer-entry button.submit-answers{background:linear-gradient(90deg,var(--accent),var(--accent2));color:#06141c;font:800 13px/1 Montserrat,sans-serif;padding:12px 18px;border:none;border-radius:12px;letter-spacing:.08em;cursor:pointer;display:inline-flex;align-items:center;gap:6px;}
.answer-entry button.submit-answers:disabled{opacity:.5;cursor:not-allowed;}
.answer-entry small{font-size:11px;color:var(--muted);}
.divider-line{height:1px;background:linear-gradient(90deg,transparent,var(--line),transparent);margin:10px 0;}
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
        <label>Player<input type="number" min="0" max="9" id="playerPosInput" /></label>
        <label>Chaser<input type="number" min="0" max="9" id="chaserPosInput" /></label>
        <button type="button" id="updatePositionsBtn">UPDATE</button>
      </div>
    </div>
    <div class="board-track">
      <div class="board-wrapper"><div id="board" class="board" aria-live="polite"></div></div>
    </div>
  </div>
  <div id="panel" class="panel fade-in">
      <div id="statusWrap"></div>
      <div id="questionArea">
        <div id="questionText" class="qtext"></div>
        <div class="options" id="options"></div>
        <div class="answer-entry" id="manualInputs" style="display:flex;">
          <label for="playerSelect">Player</label>
          <select id="playerSelect" aria-label="Player answer">
            <option value="" selected disabled>--</option>
            <option value="a">A</option>
            <option value="b">B</option>
            <option value="c">C</option>
          </select>
          <label for="chaserSelect">Chaser</label>
          <select id="chaserSelect" aria-label="Chaser answer">
            <option value="" selected disabled>--</option>
            <option value="a">A</option>
            <option value="b">B</option>
            <option value="c">C</option>
          </select>
          <button class="submit-answers" id="submitBoth" disabled type="button">Lock Answers</button>
          <small>(Select both answers & lock)</small>
        </div>
        <div class="divider-line"></div>
        <div class="notice">Lock answers → board highlights correct option → after review click Next Question.</div>
        <div class="actions">
          <button class="btn" id="nextQuestionBtn" type="button" style="display:none;">Next Question</button>
          <button class="btn alt" id="resetBtn" type="button">Reset Round</button>
        </div>
      </div>
      <div id="endActions" class="actions" style="display:none;">
        <button class="btn" id="playAgain" type="button">Play Again</button>
      </div>
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

function buildBoard(board, animate=true){
  const { playerPos, chaserPos, size } = board;
  boardEl.innerHTML = '';
  for (let i=0;i<size;i++){
    let cls = 'cell';
    if (i===0) cls+=' home';
    if (i===playerPos && i===chaserPos) cls+=' caught'; else {
      if (i===playerPos) cls+=' player';
      if (i===chaserPos) cls+=' chaser';
    }
    const div = document.createElement('div');
    // animation removed
    div.className = cls;
    const label = document.createElement('span');
    label.className='label';
    label.textContent = i===0 ? 'HOME' : `S${i}`;
    div.appendChild(label);
    const main = document.createElement('div');
    main.textContent = (i===playerPos && i===chaserPos) ? 'CAUGHT' : (i===playerPos ? 'PLAYER' : (i===chaserPos ? 'CHASER' : ''));
    boardEl.appendChild(div);
    if (main.textContent) div.insertBefore(main, label);
  }
  lastRenderBoard = {playerPos, chaserPos};
  if (playerPosInput && chaserPosInput){
    playerPosInput.value = playerPos;
    chaserPosInput.value = chaserPos;
  }
}

function setQuestion(q){
  if(!q){ qText.textContent = 'No question.'; optionsEl.innerHTML=''; return; }
  qText.textContent = q.question;
  optionsEl.innerHTML = '';
  ['a','b','c'].forEach(letter=>{
    const btn = document.createElement('button');
    btn.type='button';
    btn.dataset.choice = letter;
    btn.innerHTML = `<strong>${letter.toUpperCase()}.</strong> ${q['option_'+letter]}`;
    // Buttons now just highlight selection for quick reference; no submission on click.
    btn.addEventListener('click',()=>{
       // Toggle highlight for convenience
       optionsEl.querySelectorAll('button').forEach(b=>b.classList.remove('selected'));
       btn.classList.add('selected');
    });
    optionsEl.appendChild(btn);
  });
}

async function fetchState(){
  const r = await fetch('{{ route('h2h.state') }}');
  const data = await r.json();
  render(data);
}

async function submitBothAnswers(playerChoice, chaserChoice){
  if (locked) return;
  locked = true;
  optionsEl.querySelectorAll('button').forEach(b=>b.classList.add('locked'));
  try {
    const r = await fetch('{{ route('h2h.answer.json') }}', {
      method:'POST',
      headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrf,'Accept':'application/json'},
      body: JSON.stringify({player_answer: playerChoice, chaser_answer: chaserChoice})
    });
    const data = await r.json();
    markAnswer(playerChoice, data.last.correctOption, data.last);
    // Show Next button after short review window
    nextBtn.style.display = data.state ? 'none' : 'inline-flex';
    if (data.state){
       setTimeout(()=>render(data), 900);
    } else {
       // Keep same question & board displayed for review; do not fetch new yet
       render(data, true); // answered mode
    }
  } catch(e){
    console.error(e);
    locked = false;
  }
}

function markAnswer(playerChosen, correct, last){
  optionsEl.querySelectorAll('button').forEach(b=>{
    const c = b.dataset.choice;
    if (c === correct) b.classList.add('correct');
    if (c === playerChosen && c !== correct) b.classList.add('wrong');
    if (c === last.chaserAnswer && c !== correct) b.classList.add('wrong');
  });
}

// Removed showMeta; visual feedback is on buttons only now

function render(data, answeredMode=false){
  locked = answeredMode; // while reviewing answers keep locked until Next pressed
  buildBoard(data.board, !answeredMode); // animations on fresh question, not during locked review state? Actually animate on movement already.
  statusWrap.innerHTML = '';
  if (data.state){
    questionArea.style.display='none';
    endActions.style.display='flex';
    const div = document.createElement('div');
    div.className = 'status ' + (data.state==='win'?'win':'lose');
    div.textContent = data.state === 'win' ? 'Escaped!' : 'Caught!';
    statusWrap.appendChild(div);
  } else {
    questionArea.style.display='block';
    endActions.style.display='none';
    if (!answeredMode) {
      // fresh question
      setQuestion(data.question);
      // reset selects
      playerSelect.value='';
      chaserSelect.value='';
      updateSubmitState();
      nextBtn.style.display='none';
      optionsEl.querySelectorAll('button').forEach(b=>{b.classList.remove('correct','wrong','selected','locked');});
    }
  }
}

playAgainBtn.addEventListener('click', resetRound);
resetBtn.addEventListener('click', resetRound);

// Manual dual-select submission handling
const playerSelect = document.getElementById('playerSelect');
const chaserSelect = document.getElementById('chaserSelect');
const submitBoth = document.getElementById('submitBoth');

function updateSubmitState(){
  submitBoth.disabled = !(playerSelect.value && chaserSelect.value) || locked;
}
playerSelect.addEventListener('change', updateSubmitState);
chaserSelect.addEventListener('change', updateSubmitState);
submitBoth.addEventListener('click', ()=>{
  if (playerSelect.value && chaserSelect.value){
     submitBothAnswers(playerSelect.value, chaserSelect.value);
  }
  updateSubmitState();
});

nextBtn.addEventListener('click', async ()=>{
  if (locked){
    try{
      const r = await fetch('{{ route('h2h.next') }}', {method:'POST', headers:{'X-CSRF-TOKEN':csrf,'Accept':'application/json'}});
      const data = await r.json();
      render(data,false);
    }catch(e){console.error(e);}
  }
});

async function resetRound(){
  locked = true;
  try{
    const r = await fetch('{{ route('h2h.reset.json') }}', {method:'POST', headers:{'X-CSRF-TOKEN':csrf,'Accept':'application/json'}});
    const data = await r.json();
    render(data);
  }catch(e){console.error(e);} finally {locked = false;}
}

fetchState();
updateSubmitState();

updatePositionsBtn.addEventListener('click', async ()=>{
  const p = parseInt(playerPosInput.value,10);
  const c = parseInt(chaserPosInput.value,10);
  if (Number.isNaN(p) || Number.isNaN(c) || p<0 || p>9 || c<0 || c>9){
    alert('Positions must be integers 0-9');
    return;
  }
  try {
    updatePositionsBtn.disabled = true;
    const r = await fetch('{{ route('h2h.set.positions') }}', {
      method:'POST',
      headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrf,'Accept':'application/json'},
      body: JSON.stringify({playerPos:p,chaserPos:c})
    });
    const data = await r.json();
    render(data,false);
  } catch(e){ console.error(e);} finally { updatePositionsBtn.disabled = false; }
});
</script>
</body>
</html>
