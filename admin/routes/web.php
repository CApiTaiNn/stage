<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BossController;
use App\Http\Controllers\UserController;



/**
 * Route d'entrée de l'application
 * Ouverture de la page de connexion
 */
Route::get('/', function () {
    return view('login');
});

Route::get('home', function () {
    return view('home');
})->name('home');

Route::get('/listUser', [UserController::class, 'getAllUsers'])->name('listUser');


/**
 * POST
*/
Route::post('/login', [BossController::class, 'login'])->name('loginApi');