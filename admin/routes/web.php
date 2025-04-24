<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BossController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\A2FController;



/**
 * Route d'entrée de l'application
 * Ouverture de la page de connexion
 */
Route::get('/', function () {return view('login');});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/listUser', [UserController::class, 'getAllUsers'])->name('listUser');

Route::get('/userError', [UserController::class, 'getUserError'])->name('userError');

Route::get('/logout', [AccountController::class, 'logout'])->name('logout');

Route::get('/contactAdmin', [ContactController::class, 'contactAdmin'])->name('contactAdmin');

Route::get('/a2f', [A2FController::class, 'A2F'])->name('a2f');

Route::get('/a2fActivation', [A2FController::class, 'generateQR'])->name('a2fActivation');

/**
 * POST
*/
Route::post('/verifyA2F', [A2FController::class, 'verifyA2F'])->name('verifyA2F');
Route::post('/login', [BossController::class, 'login'])->name('loginApi');
Route::post('/mailer' , [ContactController::class, 'sendMail'])->name('mailer');
