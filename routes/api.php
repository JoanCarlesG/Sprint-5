<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(UserController::class)->group(function () {
    Route::post('/login', 'loginUser');
})->name('login');

//GET /players: retorna el llistat de tots els jugadors/es del sistema amb el seu percentatge mitjà d’èxits 
Route::controller(UserController::class)->group(function () {
    Route::get('/players', 'getPlayers');
})->middleware('auth:api')->name('user.getPlayers');

//POST /players : crea un jugador/a.
Route::controller(UserController::class)->group(function () {
    Route::post('/players', 'registerUser');
})->name('register');

//PUT /players/{id} : modifica el nom del jugador/a.
Route::controller(UserController::class)->group(function () {
    Route::put('/players/{id}', 'updateName');
})->middleware('auth:api')->name('user.updateName');

//GET /players/{id}/games: retorna el llistat de jugades per un jugador/a.
Route::controller(UserController::class)->group(function () {
    Route::get('/players/{id}/games', 'getUserGames');
})->middleware('auth:api')->name('user.getUserGames');

//POST /players/{id}/games/ : un jugador/a específic realitza una tirada dels daus.
Route::controller(UserController::class)->group(function () {
    Route::post('/players/{id}/games/', 'createGame');
})->middleware('auth:api')->name('user.createGame');

//DELETE /players/{id}/games: elimina les tirades del jugador/a.
Route::controller(UserController::class)->group(function () {
    Route::delete('/players/{id}/games', 'deleteGames');
})->middleware('auth:api')->name('user.deleteGames'); 

//GET /players/ranking: retorna el rànquing mitjà de tots els jugadors/es del sistema. És a dir, el percentatge mitjà d’èxits.
Route::controller(UserController::class)->group(function () {
    Route::get('/players/ranking', 'getRanking');
})->middleware('auth:api')->name('user.getRanking'); 

//GET /players/ranking/loser: retorna el jugador/a amb pitjor percentatge d’èxit.
Route::controller(UserController::class)->group(function () {
    Route::get('/players/ranking/loser', 'getWorstPlayer');
})->middleware('auth:api')->name('user.getWorstPlayer');

//GET /players/ranking/winner: retorna el jugador/a amb millor percentatge d’èxit.
Route::controller(UserController::class)->group(function () {
    Route::get('/players/ranking/winner', 'getBestPlayer');
})->middleware('auth:api')->name('user.getBestPlayer');