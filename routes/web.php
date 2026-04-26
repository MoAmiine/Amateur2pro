<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TournamentMatchController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.index');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.index');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::get('/tournois', [TournamentController::class, 'index'])->name('tournois');
Route::get('/equipes', [TeamController::class, 'index'])->name('teams.index');
Route::get('/equipes/create', [TeamController::class, 'create'])->middleware('auth')->name('teams.create')->middleware('auth');
Route::get('/tournois/create', [TournamentController::class, 'create'])->name('tournois.create')->middleware('auth');
Route::get('/equipes/{team}', [TeamController::class, 'show'])->name('teams.show');
Route::get('/tournois/{tournament}', [TournamentController::class, 'show'])->name('tournois.show');
Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
Route::get('/invite/{token}', [TeamController::class, 'showInvitation'])->name('teams.invite.show');

Route::middleware('auth')->group(function () {
    Route::get('/profil', [AuthController::class, 'showProfile'])->name('profile');
    Route::post('/profile/update', [AuthController::class, 'update'])->name('profile.update');
    Route::post('/profile/games', [AuthController::class, 'updateGames'])->name('profile.games');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('tournaments')->group(function () {
        Route::post('/tournoi/store', [TournamentController::class, 'store'])->name('tournament.store');
        Route::get('/tournois/{tournament}/edit', [TournamentController::class, 'edit'])->name('tournois.edit');
        Route::put('/tournois/{tournament}', [TournamentController::class, 'update'])->name('tournois.update');
        Route::post('/tournois/{tournament}/register', [TournamentController::class, 'register'])->name('tournois.register');
        Route::delete('/tournois/{tournament}/leave', [TournamentController::class, 'leave'])->name('tournois.leave');
        Route::post('/tournaments/{tournament}/start', [TournamentMatchController::class, 'start'])->name('tournois.start');
        Route::get('/tournaments/{tournament}/brackets', [TournamentMatchController::class, 'brackets'])->name('tournaments.brackets');
        Route::post('/tournament/{match}/score', [TournamentMatchController::class, 'score'])->name('matches.score');
    });

    Route::prefix('teams')->group(function () {
        Route::post('/equipes', [TeamController::class, 'store'])->name('teams.store');
        Route::post('/equipes/{team}/invite', [TeamController::class, 'invite'])->name('teams.invite');
        Route::get('/invite/{token}/accept', [TeamController::class, 'accept'])->name('teams.accept');
        Route::delete('/equipes/{team}/members/{user}', [TeamController::class, 'removeMember'])->name('teams.members.remove');
        Route::post('/equipes/{team}/join', [TeamController::class, 'join'])->name('teams.join');
        Route::patch('/equipes/{team}/members/{user}/accept', [TeamController::class, 'acceptMember'])->name('teams.members.accept');
        Route::delete('/equipes/{team}/leave', [TeamController::class, 'leave'])->name('teams.leave');
        Route::get('/equipes/{team}/edit', [TeamController::class, 'edit'])->name('teams.edit');
        Route::put('/equipes/{team}', [TeamController::class, 'update'])->name('teams.update');
        Route::delete('/equipes/{team}', [TeamController::class, 'destroy'])->name('teams.destroy');
    });
    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('/',          [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/users',     [AdminController::class, 'users'])->name('admin.users');
        Route::get('/tournois',  [AdminController::class, 'tournois'])->name('admin.tournois');
        Route::get('/equipes',   [AdminController::class, 'equipes'])->name('admin.equipes');
        Route::patch('/users/{user}/suspend',    [AdminController::class, 'suspendUser'])->name('admin.users.suspend');
        Route::delete('/users/{user}',           [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
        Route::delete('/tournois/{tournament}',  [AdminController::class, 'destroyTournoi'])->name('admin.tournois.destroy');
        Route::delete('/equipes/{team}',         [AdminController::class, 'destroyEquipe'])->name('admin.equipes.destroy');
    });
});
