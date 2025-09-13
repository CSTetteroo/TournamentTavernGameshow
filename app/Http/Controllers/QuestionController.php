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
        $question = Question::inRandomOrder()->first();
        return view('welcome', compact('question'));
    }
}
