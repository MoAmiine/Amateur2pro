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

Route::get('/tournois', [TournamentController::class, 'index'])->name('tournois');
Route::get('/tournois/{tournament}', [TournamentController::class, 'show'])->name('tournois.show');
Route::get('/equipes', [TeamController::class, 'index'])->name('teams.index');
Route::get('/equipes/{team}', [TeamController::class, 'show'])->name('teams.show');
Route::middleware('auth')->group(function () {

    Route::get('/profil', [AuthController::class, 'showProfile'])->name('profile');
    Route::post('/profile/update', [AuthController::class, 'update'])->name('profile.update');
    Route::post('/profile/games', [AuthController::class, 'updateGames'])->name('profile.games');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', function () {
        return view('dashboard');
        })->name('dashboard');
        
        Route::get('/tournois/create', [TournamentController::class, 'create'])->name('tournois.create');
        Route::post('/tournoi/store', [TournamentController::class, 'store'])->name('tournament.store');
        Route::get('/tournois/{tournament}/edit', [TournamentController::class, 'edit'])->name('tournois.edit');
Route::put('/tournois/{tournament}', [TournamentController::class, 'update'])->name('tournois.update');
Route::post('/tournois/{tournament}/register', [TournamentController::class, 'register'])->name('tournaments.register');
Route::delete('/tournois/{tournament}/leave', [TournamentController::class, 'leave'])->name('tournaments.leave');


Route::get('/equipes/create', [TeamController::class, 'create'])->name('teams.create');
Route::post('/equipes', [TeamController::class, 'store'])->name('teams.store');
Route::post('/equipes/{team}/invite', [TeamController::class, 'invite'])->name('teams.invite');
Route::post('/equipes/{team}/invite', [TeamController::class, 'invite'])->name('teams.invite');
Route::get('/invite/{token}', [TeamController::class, 'accept'])->name('teams.accept');
Route::delete('/equipes/{team}/members/{user}', [TeamController::class, 'removeMember'])->name('teams.members.remove');
Route::post('/equipes/{team}/join', [TeamController::class, 'join'])->name('teams.join');
Route::patch('/equipes/{team}/members/{user}/accept', [TeamController::class, 'acceptMember'])->name('teams.members.accept');
Route::delete('/equipes/{team}/leave', [TeamController::class, 'leave'])->name('teams.leave');
Route::get('/equipes/{team}/edit', [TeamController::class, 'edit'])->name('teams.edit');
Route::put('/equipes/{team}', [TeamController::class, 'update'])->name('teams.update');
Route::delete('/equipes/{team}', [TeamController::class, 'destroy'])->name('teams.destroy');

});