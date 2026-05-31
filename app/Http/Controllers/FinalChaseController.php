<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class FinalChaseController extends Controller
{
    private function initState(): void
    {
        if (!session()->has('final_chase')) {
            session(['final_chase' => [
                'contestant_score' => 0,
                'chaser_score' => 0,
                'current_question_id' => null,
                'used' => [],
            ]]);
        }
    }

    private function difficultiesForPhase(?string $phase): array
    {
        if ($phase === 'easy') {
            return [1];
        }
        if ($phase === 'medium') {
            return [2];
        }
        if ($phase === 'hard') {
            return [3];
        }
        return [1, 2, 3];
    }

    private function pullQuestion(array $difficulties = []): ?Question
    {
        $state = session('final_chase');
        $query = Question::where('used', 0);
        if (!empty($difficulties)) {
            $query->whereIn('difficulty', $difficulties);
        }
        $q = $query->inRandomOrder()->first();
        if ($q) {
            // Mark used exactly like round2 logic
            $q->used = 1;
            $q->save();
            $state['current_question_id'] = $q->id;
            session(['final_chase' => $state]);
        }
        return $q;
    }

    public function show(Request $request)
    {
        $this->initState();
        $state = session('final_chase');
        $question = null;
        if ($state['current_question_id']) {
            $question = Question::find($state['current_question_id']);
        } else {
            $question = $this->pullQuestion([1]);
        }
        $remaining = Question::where('used', 0)->count();
        return view('final_chase', [
            'question' => $question,
            'contestant' => $state['contestant_score'],
            'chaser' => $state['chaser_score'],
            'remaining' => $remaining,
        ]);
    }

    public function next(Request $request)
    {
        $this->initState();
        $phase = $request->query('phase');
        $difficulties = $this->difficultiesForPhase($phase);
        $q = $this->pullQuestion($difficulties);
        $remaining = Question::where('used', 0)->count();
        return response()->json([
            'question' => $q?->question,
            'answer' => $q?->answer,
            'id' => $q?->id,
            'remaining' => $remaining,
        ]);
    }

    public function score(Request $request)
    {
        $this->initState();
        $data = $request->validate([
            'side' => 'required|in:contestant,chaser',
            'delta' => 'required|integer',
        ]);
        $state = session('final_chase');
        if ($data['side'] === 'contestant') {
            $state['contestant_score'] = max(0, $state['contestant_score'] + $data['delta']);
        } else {
            $state['chaser_score'] = max(0, $state['chaser_score'] + $data['delta']);
        }
        session(['final_chase' => $state]);
        return response()->json([
            'contestant' => $state['contestant_score'],
            'chaser' => $state['chaser_score']
        ]);
    }

    public function reset(Request $request)
    {
        session()->forget('final_chase');
        $this->initState();
        return redirect()->route('final.chase.show');
    }
}
