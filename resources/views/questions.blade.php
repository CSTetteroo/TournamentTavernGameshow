<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Question Bank</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0b0f1a; --panel: #0f1630; --panel-2:#121a3a; --text:#eaf4ff; --muted:#a8b8d9;
            --accent:#57f1ff; --accent-2:#ff64f2; --line: rgba(255,255,255,0.12);
        }
        *{ box-sizing:border-box; }
        html, body { height: 100%; }
        body {
            margin: 0; color: var(--text);
            font-family: Montserrat, system-ui, Segoe UI, Roboto, Ubuntu, Arial, sans-serif;
            background: radial-gradient(1000px 480px at 110% -10%, rgba(255, 100, 242, .15), transparent 60%),
                        radial-gradient(900px 420px at -10% 110%, rgba(87, 241, 255, .15), transparent 60%),
                        linear-gradient(135deg, var(--bg), #0a0f1c);
        }
        .wrap{ max-width: 1200px; margin: 0 auto; padding: clamp(16px,3vw,36px); }
        header{ display:flex; align-items:center; justify-content:space-between; gap:16px; margin-bottom:18px; flex-wrap:wrap; }
        .title{ font-family:'Orbitron', system-ui, sans-serif; font-weight:900; font-size:clamp(22px,2.4vw,34px); letter-spacing:.04em; text-transform:uppercase; }
        .actions{ display:flex; gap:10px; align-items:center; flex-wrap:wrap; }
        .field{ display:flex; align-items:center; gap:10px; background: var(--panel-2); border:1px solid var(--line); border-radius:12px; padding:8px 12px; }
        .field input{ background:transparent; border:none; outline:none; color:var(--text); width:220px; }
        .switch{ display:inline-flex; align-items:center; gap:8px; cursor:pointer; user-select:none; }
        .switch input{ appearance:none; width:44px; height:26px; background:#24305e; border-radius:999px; position:relative; outline:none; border:1px solid var(--line); transition:background .2s ease; }
        .switch input::after{ content:""; position:absolute; width:18px; height:18px; top:3px; left:3px; border-radius:50%; background:#eaf4ff; transition: transform .2s ease; }
        .switch input:checked{ background: linear-gradient(90deg, var(--accent), var(--accent-2)); }
        .switch input:checked::after{ transform: translateX(18px); }
        .switch span{ color:var(--muted); font-size:14px; }

        .panel{ background: linear-gradient(180deg, rgba(255,255,255,0.08), rgba(255,255,255,0.04)); border:1px solid var(--line); border-radius:16px; overflow:hidden; box-shadow: 0 8px 24px rgba(0,0,0,.35); }
        table{ width:100%; border-collapse: collapse; }
        thead th{ font-weight:800; text-align:left; font-size:12px; letter-spacing:.12em; text-transform:uppercase; color:var(--muted); background: var(--panel); border-bottom:1px solid var(--line); padding:14px; }
        tbody td{ padding:14px; border-bottom:1px solid var(--line); vertical-align:top; }
        tbody tr:nth-child(odd) td{ background: rgba(255,255,255,0.02); }
        tbody tr:hover td{ background: rgba(87, 241, 255, 0.06); }
        td .q{ font-weight:800; }
        td[data-col="answer"]{ max-width: 640px; word-wrap: anywhere; }
        .answers-hidden td[data-col="answer"]{ filter: blur(7px); }
        .muted{ color:var(--muted); }
        .empty{ text-align:center; padding: 24px; color: var(--muted); }
        .pill{ display:inline-block; min-width: 36px; text-align:center; padding:4px 8px; border-radius:8px; font-weight:800; font-size:12px; background: rgba(255,255,255,.08); border:1px solid var(--line); }

        @media (max-width: 720px) {
            thead th:nth-child(1), tbody td:nth-child(1) { width: 70px; }
        }
    </style>
</head>
<body>
<div class="wrap">
    <header>
        <div class="title">Question Bank</div>
        <div class="actions">
            <label class="field" title="Search questions or answers">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#a8b8d9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.3-4.3"></path></svg>
                <input id="search" type="text" placeholder="Search..." />
            </label>
            <label class="switch" title="Hide or show answers">
                <input id="toggleAnswers" type="checkbox" />
                <span>Hide answers</span>
            </label>
            <span class="muted">Total: {{ isset($questions) ? $questions->count() : 0 }}</span>
            <form method="POST" action="{{ route('questions.reset') }}" onsubmit="return confirm('Reset all questions to unused?');">
                @csrf
                <button type="submit" style="padding:8px 12px; border-radius:10px; border:1px solid var(--line); background:linear-gradient(90deg, var(--accent), var(--accent-2)); color:#001018; font-weight:800; cursor:pointer;">Reset Used</button>
            </form>
        </div>
    </header>

    @if (session('status'))
        <div style="margin-bottom: 12px; padding:10px 12px; border:1px solid var(--line); border-radius:10px; background: rgba(87,241,255,.08); color: var(--text);">
            {{ session('status') }}
        </div>
    @endif

    <div class="panel">
        <table id="qTable">
            <thead>
                <tr>
                    <th style="width:90px;">ID</th>
                    <th>Question</th>
                    <th style="width:50%;">Answer</th>
                    <th style="width:40px;">Used</th>
                </tr>
            </thead>
            <tbody>
            @forelse($questions ?? [] as $q)
                <tr>
                    <td><span class="pill">#{{ $q->id }}</span></td>
                    <td>
                        <div class="q">{{ $q->question }}</div>
                    </td>
                    <td data-col="answer">{{ $q->answer }}</td>
                    <td>{{ $q->used ? '✅' : '' }}</td>
                </tr>
            @empty
                <tr><td class="empty" colspan="3">No questions yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    const search = document.getElementById('search');
    const table = document.getElementById('qTable');
    const toggle = document.getElementById('toggleAnswers');
    const tbody = table?.querySelector('tbody');

    function norm(s){ return (s || '').toLowerCase().trim(); }

    search?.addEventListener('input', () => {
        const q = norm(search.value);
        if (!tbody) return;
        for (const row of tbody.rows) {
            const id = norm(row.cells[0]?.innerText);
            const question = norm(row.cells[1]?.innerText);
            const answer = norm(row.cells[2]?.innerText);
            const match = !q || id.includes(q) || question.includes(q) || answer.includes(q);
            row.style.display = match ? '' : 'none';
        }
    });

    toggle?.addEventListener('change', () => {
        table.classList.toggle('answers-hidden', toggle.checked);
    });
</script>
</body>
</html>

