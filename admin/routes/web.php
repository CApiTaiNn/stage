<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BossController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ContactController;



/**
 * Route d'entrée de l'application
 * Ouverture de la page de connexion
 */
Route::get('/', function () {
    return view('login');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/listUser', [UserController::class, 'getAllUsers'])->name('listUser');

Route::get('/logout', [AccountController::class, 'logout'])->name('logout');
Route::get('/contactAdmin', [ContactController::class, 'contactAdmin'])->name('contactAdmin');
/**
 * POST
*/
Route::post('/login', [BossController::class, 'login'])->name('loginApi');
Route::post('/mailer' , [ContactController::class, 'sendMail'])->name('mailer');
