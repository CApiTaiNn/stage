<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BossController;

/**
*    Route::get('/', function () {
*        return view('welcome');
*    });
*/


/**
 * Route d'entrée de l'application
 * Ouverture de la page de connexion
 */
Route::get('/', function () {
    return view('login');
});

Route::get('/home', function () {
    return view('home');
})->name('home');


/**
 * POST
*/
Route::post('/login', [BossController::class, 'login'])->name('loginApi');