<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class GameController extends Controller
{
    protected function initBoard(): array
    {
        if (!Session::has('h2h.board')) {
            // Fixed 11 spaces (indexes 0..10). Player starts at 8, Chaser at 10.
            Session::put('h2h.board', [
                'size'      => 11, // total cells
                'playerPos' => 8,
                'chaserPos' => 10,
                'homeIndex' => 0,
            ]);
            Session::forget(['h2h.state','h2h.current_q']);
        }
        // Auto-upgrade legacy boards (previous size 10) to new size 11 without forcing reset
        $board = Session::get('h2h.board');
        if (isset($board['size']) && $board['size'] === 10) {
            // Preserve relative distance: if old player at 7/8/ etc, shift by +1 when expanding upper bound
            $player = $board['playerPos'];
            $chaser = $board['chaserPos'];
            // Only shift if original chaser was at last cell (9)
            if ($chaser === 9) { $chaser = 10; }
            if ($player >= 7) { $player = min($player + 1, 10); }
            $board['size'] = 11;
            $board['playerPos'] = $player;
            $board['chaserPos'] = $chaser;
            Session::put('h2h.board', $board);
        }
        if (!Session::has('h2h.current_q')) {
            Session::put('h2h.current_q', $this->randomQuestion());
        }
        return Session::get('h2h.board');
    }

    protected function randomQuestion()
    {
        try {
            if (!DB::getSchemaBuilder()->hasTable('multiple_choice_questions')) {
                return (object) [
                    'id' => 0,
                    'question' => 'Add a multiple_choice_questions table to use dynamic questions.',
                    'option_a' => 'A','option_b' => 'B','option_c' => 'C','correct' => 'a',
                ];
            }
            // Fetch a random unused MCQ; mark it used immediately (atomic via transaction)
            return DB::transaction(function () {
                $row = DB::table('multiple_choice_questions')
                    ->where('used', 0)
                    ->inRandomOrder()
                    ->lockForUpdate()
                    ->first();
                if ($row) {
                    DB::table('multiple_choice_questions')->where('id', $row->id)->update(['used' => 1]);
                    $row->used = 1;
                    return $row;
                }
                // None unused: surface a placeholder message
                $total = DB::table('multiple_choice_questions')->count();
                return (object) [
                    'id' => 0,
                    'question' => $total ? 'All multiple choice questions have been used. Reset them in the MCQ bank.' : 'No multiple choice questions found.',
                    'option_a' => 'A','option_b' => 'B','option_c' => 'C','correct' => 'a',
                    'used' => 1,
                ];
            });
        } catch (\Throwable $e) {
            return (object) [
                'id' => 0,
                'question' => 'DB error: ' . $e->getMessage(),
                'option_a' => 'A','option_b' => 'B','option_c' => 'C','correct' => 'a',
            ];
        }
    }

    protected function packState(): array
    {
        $board = $this->initBoard();
        return [
            'board' => $board,
            'state' => Session::get('h2h.state'),
            'question' => Session::get('h2h.current_q'),
        ];
    }

    public function show()
    {
        $this->initBoard();
        return view('head_to_head');
    }

    public function state(): JsonResponse
    {
        return response()->json($this->packState());
    }

    public function answerJson(Request $request): JsonResponse
    {
        // Manual dual-input answers: player & chaser each submit a choice.
        $request->validate([
            'player_answer' => 'required|in:a,b,c',
            'chaser_answer' => 'required|in:a,b,c',
        ]);
        $board = $this->initBoard();
        $q = Session::get('h2h.current_q');
        if (!$q) {
            Session::put('h2h.current_q', $this->randomQuestion());
            return response()->json($this->packState());
        }

        $playerPos = $board['playerPos'];
        $chaserPos = $board['chaserPos'];

        $playerAnswer = $request->input('player_answer');
        $chaserAnswer = $request->input('chaser_answer');
        $playerCorrect = $playerAnswer === $q->correct;
        $chaserCorrect = $chaserAnswer === $q->correct;

        if ($playerCorrect) {
            $playerPos = max(0, $playerPos - 1); // player advances toward home
        }
        if ($chaserCorrect) {
            $chaserPos = max(0, $chaserPos - 1); // chaser advances toward player
        }

        $state = null;
        if ($playerPos <= 0) {
            $state = 'win';
        } elseif ($chaserPos <= $playerPos) {
            $state = 'lose';
        }

        $board['playerPos'] = $playerPos;
        $board['chaserPos'] = $chaserPos;
        Session::put('h2h.board', $board);
        Session::put('h2h.state', $state);

        // Do NOT auto-fetch next question; client will call nextQuestion endpoint after display delay.
        return response()->json([
            'board' => $board,
            'state' => $state,
            'answered' => true,
            'last' => [
                'playerAnswer' => $playerAnswer,
                'playerCorrect' => $playerCorrect,
                'chaserAnswer' => $chaserAnswer,
                'chaserCorrect' => $chaserCorrect,
                'correctOption' => $q->correct,
                'questionId' => $q->id,
            ],
            'question' => $q, // keep current so UI can still show it during review
        ]);
    }

    // chaserAnswer() removed – answers now entered manually by host

    public function resetJson(): JsonResponse
    {
        Session::forget(['h2h.board','h2h.current_q','h2h.state']);
        $this->initBoard();
        return response()->json($this->packState());
    }

    public function nextQuestion(Request $request): JsonResponse
    {
        // Only advance if game not ended
        if (Session::get('h2h.state')) {
            return response()->json($this->packState());
        }
        Session::put('h2h.current_q', $this->randomQuestion());
        return response()->json($this->packState());
    }

    public function setPositions(Request $request): JsonResponse
    {
        $data = $request->validate([
            'playerPos' => 'required|integer|min:0|max:10',
            'chaserPos' => 'required|integer|min:0|max:10',
        ]);
        $board = $this->initBoard();
        $board['playerPos'] = $data['playerPos'];
        $board['chaserPos'] = $data['chaserPos'];
        Session::put('h2h.board', $board);

        // Recompute state if needed
        $state = null;
        if ($board['playerPos'] <= 0) {
            $state = 'win';
        } elseif ($board['chaserPos'] <= $board['playerPos']) {
            $state = 'lose';
        }
        Session::put('h2h.state', $state);
        return response()->json($this->packState());
    }
}
