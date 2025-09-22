<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;

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

