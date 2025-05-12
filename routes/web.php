<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\UserController;

// Homepage
Route::get('/', function () {
    return view('index');
});

// Page de connexion
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

// Page d'inscription
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Déconnexion
Route::post('logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/profile', function () {
    return view('profile');
})->middleware('auth')->name('page-protegee');

// Afficher le profil de l'utilisateur
Route::get('/user', [UserController::class, 'show'])->middleware('auth');

// Mettre à jour le profil de l'utilisateur
Route::put('/user', [UserController::class, 'update'])->middleware('auth');

// Supprimer le compte de l'utilisateur
Route::delete('/user', [UserController::class, 'destroy'])->middleware('auth');
