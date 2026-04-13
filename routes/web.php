<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\TeamController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.index');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.index');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware('auth')->group(function () {
  Route::get('/profil', [AuthController::class, 'showProfile'])->name('profile');
    Route::post('/profil/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/tournois', [TournamentController::class, 'index'])->name('tournois');
Route::get('/tournois/create', [TournamentController::class, 'create'])->name('tournois.create');
Route::post('/tournoi/store', [TournamentController::class, 'store'])->name('tournament.store');

Route::get('/equipes', [TeamController::class, 'index'])->name('equipes.index');
Route::get('/equipes/create', [TeamController::class, 'create'])->name('equipes.create');
Route::post('/equipes', [TeamController::class, 'store'])->name('equipes.store');