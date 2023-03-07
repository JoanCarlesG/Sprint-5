<?php

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

/*
URL’s:
    GET /players: retorna el llistat de tots els jugadors/es del sistema amb el seu percentatge mitjà d’èxits 
    POST /players : crea un jugador/a.
    PUT /players/{id} : modifica el nom del jugador/a.
    
    GET /players/{id}/games: retorna el llistat de jugades per un jugador/a.
    POST /players/{id}/games/ : un jugador/a específic realitza una tirada dels daus.
    DELETE /players/{id}/games: elimina les tirades del jugador/a.
    
    GET /players/ranking: retorna el rànquing mitjà de tots els jugadors/es del sistema. És a dir, el percentatge mitjà d’èxits.
    GET /players/ranking/loser: retorna el jugador/a amb pitjor percentatge d’èxit.
    GET /players/ranking/winner: retorna el jugador/a amb millor percentatge d’èxit.

*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{all}', function () {
    return view('welcome');
})->where("all", ".*");
