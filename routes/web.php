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

