<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

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
}
