<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\GameController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [QuestionController::class, 'welcome'])->name('round1');

// All questions table (styled bank)
Route::get('/questions', [QuestionController::class, 'index'])->name('questions.all');

// Backward-compatible alias
Route::get('/question', [QuestionController::class, 'index']);

// Reset all questions to unused
Route::post('/questions/reset-used', [QuestionController::class, 'resetUsed'])->name('questions.reset');

// Round 2 routes
Route::get('/round2', [QuestionController::class, 'round2'])->name('round2');
Route::post('/round2/correct', [QuestionController::class, 'round2Correct'])->name('round2.correct');
Route::post('/round2/wrong', [QuestionController::class, 'round2Wrong'])->name('round2.wrong');
Route::post('/round2/skip', [QuestionController::class, 'round2Skip'])->name('round2.skip');

// Head to Head dynamic (no full page reload)
Route::get('/head-to-head', [GameController::class, 'show'])->name('h2h.show');
Route::get('/head-to-head/state', [GameController::class, 'state'])->name('h2h.state');
Route::post('/head-to-head/answer-json', [GameController::class, 'answerJson'])->name('h2h.answer.json');
Route::post('/head-to-head/reset-json', [GameController::class, 'resetJson'])->name('h2h.reset.json');
Route::post('/head-to-head/next-question', [GameController::class, 'nextQuestion'])->name('h2h.next');
Route::post('/head-to-head/set-positions', [GameController::class, 'setPositions'])->name('h2h.set.positions');

