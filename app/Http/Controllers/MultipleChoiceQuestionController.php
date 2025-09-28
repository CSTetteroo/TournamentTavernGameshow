<?php

namespace App\Http\Controllers;

use App\Models\MultipleChoiceQuestion;
use Illuminate\Http\Request;

class MultipleChoiceQuestionController extends Controller
{
    public function index()
    {
        $questions = MultipleChoiceQuestion::orderBy('id')->get();
        return view('mc_questions', compact('questions'));
    }

    public function resetUsed(Request $request)
    {
        MultipleChoiceQuestion::query()->update(['used' => 0]);
        return redirect()->route('mcq.index')->with('status', 'Multiple choice questions reset.');
    }
}
