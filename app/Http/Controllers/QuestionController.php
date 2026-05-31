<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    public function index()
    {
        // Fetch all questions for the question bank view
        $questions = Question::orderBy('id')->get();
        return view('questions', compact('questions'));
    }

    public function welcome()
    {
        // Fetch a single random question for the welcome (game show) view
        $question = Question::where('used', 0)->inRandomOrder()->first();
        // Mark the fetched question as used
        if ($question) {
            $question->used = 1;
            $question->save();
        }
        return view('round1', compact('question'));
    }

    public function resetUsed(Request $request)
    {
        // Set all questions to unused
        Question::query()->update(['used' => 0]);
        return redirect()->route('questions.all')->with('status', 'All questions have been reset to unused.');
    }

    // Round 2: render view with a fresh unused question and current tiers from session
    public function round2(Request $request)
    {
        $tiers = Session::get('round2_tiers', 0); // number of correct answers (0-10)
            $question = null;
            $attempts = 0;
            while ($attempts < 5 && !$question) {
                $candidate = Question::where('used', 0)
                    ->whereIn('difficulty', [1, 2])
                    ->inRandomOrder()
                    ->first();
                if (!$candidate) {
                    break;
                }
                $question = $candidate;
                $attempts++;
            }
        if ($question) {
            // mark used on fetch (can be reverted if skipped)
            $question->used = 1;
            $question->save();
        }
        $remaining = Question::where('used', 0)
            ->whereIn('difficulty', [1, 2])
            ->count();
        return view('round2', compact('question', 'tiers', 'remaining'));
    }

    // Mark current question as correctly answered: increment tier count up to 10 and show next
    public function round2Correct(Request $request)
    {
        $tiers = min(10, Session::get('round2_tiers', 0) + 1);
        Session::put('round2_tiers', $tiers);
        return redirect()->route('round2');
    }

    // Mark wrong: do NOT decrement tiers, simply proceed to next question
    public function round2Wrong(Request $request)
    {
        $tiers = Session::get('round2_tiers', 0); // unchanged
        Session::put('round2_tiers', $tiers);
        return redirect()->route('round2');
    }

    // Skip: mark last fetched as unused again, do not change tiers, show next
    public function round2Skip(Request $request)
    {
        // Best-effort: find a recently used question and revert. If front-end includes id, use that.
        $id = $request->input('id');
        if ($id) {
            $q = Question::find($id);
            if ($q) { $q->used = 0; $q->save(); }
        }
        return redirect()->route('round2');
    }

    // Reset Round 2 progress (tiers) back to 0
    public function round2Reset(Request $request)
    {
        Session::put('round2_tiers', 0);
        return redirect()->route('round2');
    }
}
