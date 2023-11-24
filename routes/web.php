<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\TeamsController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//hacer un middleware para games
Route::get('/games', [GamesController::class, 'index'])->name('games.index');
Route::get('/games/result/{game}', [GamesController::class, 'result'])->name('games.result');
Route::post('/games/result/store', [GamesController::class, 'store'])->name('games.store');
Route::post('/games/{game}/comments', [CommentsController::class, 'store'])->name('comments.store')->middleware('auth');
Route::post('/comments/{comment}/like', [CommentsController::class, 'like'])->name('comments.like');

//
Route::get('/rankings', [PlayersController::class, 'rankings'])->name('players.renkings');

require __DIR__.'/auth.php';
