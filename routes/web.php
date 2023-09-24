<?php

use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('suggestion', SuggestionController::class);
Route::get('suggestion/{suggestion}/vote/up', [VoteController::class, 'voteUp'])->name('suggestion.vote.up');
Route::get('suggestion/{suggestion}/vote/down', [VoteController::class, 'voteDown'])->name('suggestion.vote.down');
