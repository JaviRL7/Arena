<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\AdminController;
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
Route::get('/players/show/{id}', [PlayersController::class, 'show'])->name('player.show');

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


Route::get('/rankings', [PlayersController::class, 'rankings'])->name('players.rankings');
Route::get('/show/{id}', [PlayersController::class, 'show'])->name('players.show');
Route::get('/player', [PlayersController::class, 'player'])->name('players.player');



/************* Admin *************/
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');


    /************* Players *************/
    Route::get('/players', [PlayersController::class, 'index'])->name('admin.players.index');
    Route::get('/players/create', [PlayersController::class, 'create'])->name('admin.players.create');
    Route::post('/players/create', [PlayersController::class, 'store'])->name('admin.players.store');
    Route::get('/players/{player}/edit', [PlayersController::class, 'edit'])->name('admin.players.edit');
    Route::put('/players/{player}/edit', [PlayersController::class, 'update'])->name('admin.players.update');
    Route::delete('/players/{player}/delete', [PlayersController::class, 'destroy'])->name('admin.players.destroy');

    /************* Games *************/
    Route::get('/games', [GamesController::class, 'indexadmin'])->name('admin.games.index');
    Route::get('/games/{game}/show', [GamesController::class, 'show'])->name('admin.games.show');
    //hacer con modal
    Route::get('/games/{game}/edit_result', [GamesController::class, 'edit_result'])->name('admin.games.edit_result');
    Route::get('/games/create', [GamesController::class, 'create'])->name('admin.games.create');

    Route::get('/games/{game}/edit', [GamesController::class, 'edit'])->name('admin.games.edit');
    Route::put('/games/{game}/edit', [GamesController::class, 'update'])->name('admin.games.update');

    Route::get('/games/create', [GamesController::class, 'create'])->name('admin.games.create');
    Route::post('/games/create', [GamesController::class, 'store'])->name('admin.games.store');
    //Cambiar el otro store que deberia ser vote
 // Ruta para obtener los jugadores basado en los equipos seleccionados






    Route::post('/games/create/getPlayers', [GamesController::class, 'getPlayers'])->name('admin.games.getPlayers');
    /************* Teams *************/
    Route::get('/teams', [TeamsController::class, 'index'])->name('admin.teams.index');
    Route::get('/teams/create', [TeamsController::class, 'create'])->name('admin.teams.create');
    Route::post('/teams/create', [TeamsController::class, 'store'])->name('admin.teams.store');
    Route::get('/teams/{team}/edit', [TeamsController::class, 'edit'])->name('admin.teams.edit');
    Route::get('/teams/{team}/substitute', [TeamsController::class, 'substitute'])->name('admin.teams.substitute');
    Route::put('/admin/players/{player}/update-substitute', [TeamsController::class, 'updateSubstitute'])->name('admin.players.updateSubstitute');
    Route::get('/teams/{team}/add', [TeamsController::class, 'add'])->name('admin.teams.add');
    Route::post('/teams/{team}/add_player', [TeamsController::class, 'add_player'])->name('admin.teams.add_player');
    Route::put('/teams/{team}/edit', [TeamsController::class, 'update'])->name('admin.teams.update');
    Route::delete('/teams/{player}/delete', [TeamsController::class, 'destroy'])->name('admin.teams.destroy');
});




require __DIR__.'/auth.php';
