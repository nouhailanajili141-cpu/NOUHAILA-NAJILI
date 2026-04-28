<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\DiplomeController;
use App\Http\Controllers\SuiviDiplomeController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\UtilisateurController;

// ------------------------------------------------
// Route principale
// ------------------------------------------------
Route::get('/', function () {
    return redirect()->route('login');
});

// ------------------------------------------------
// Routes Auth
// ------------------------------------------------
Route::middleware('guest')->group(function () {
    // Administration + Administrateur
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Etudiant
    Route::get('/login-etudiant',  [AuthController::class, 'showLoginEtudiant'])->name('login.etudiant');
    Route::post('/login-etudiant', [AuthController::class, 'loginEtudiant']);
});

Route::post('/logout', [AuthController::class, 'logout'])
     ->name('logout')
     ->middleware('auth');

// ------------------------------------------------
// Routes Etudiant
// ------------------------------------------------
Route::middleware(['auth', 'role:etudiant'])
     ->prefix('etudiant')
     ->name('etudiant.')
     ->group(function () {

    Route::get('/dashboard', function () {
        return view('etudiant.dashboard');
    })->name('dashboard');

    Route::get('/suivi',      [SuiviDiplomeController::class, 'consulter'])->name('suivi');
    Route::get('/historique', [HistoriqueController::class,   'consulter'])->name('historique');
});

// ------------------------------------------------
// Routes Administration
// ------------------------------------------------
Route::middleware(['auth', 'role:administration'])
     ->prefix('administration')
     ->name('administration.')
     ->group(function () {

    Route::get('/dashboard', function () {
        return view('administration.dashboard');
    })->name('dashboard');

    // Etudiants
    Route::get('/etudiants',             [EtudiantController::class, 'index'])->name('etudiants.index');
    Route::get('/etudiants/create',      [EtudiantController::class, 'create'])->name('etudiants.create');
    Route::post('/etudiants',            [EtudiantController::class, 'store'])->name('etudiants.store');
    Route::get('/etudiants/{id}/edit',   [EtudiantController::class, 'edit'])->name('etudiants.edit');
    Route::put('/etudiants/{id}',        [EtudiantController::class, 'update'])->name('etudiants.update');
    Route::delete('/etudiants/{id}',     [EtudiantController::class, 'destroy'])->name('etudiants.destroy');

    // Diplomes
    Route::get('/diplomes',             [DiplomeController::class, 'index'])->name('diplomes.index');
    Route::get('/diplomes/create',      [DiplomeController::class, 'create'])->name('diplomes.create');
    Route::post('/diplomes',            [DiplomeController::class, 'store'])->name('diplomes.store');
    Route::get('/diplomes/{id}/edit',   [DiplomeController::class, 'edit'])->name('diplomes.edit');
    Route::put('/diplomes/{id}',        [DiplomeController::class, 'update'])->name('diplomes.update');
    Route::delete('/diplomes/{id}',     [DiplomeController::class, 'destroy'])->name('diplomes.destroy');

    // Suivi + Validation
    Route::get('/suivi',               [SuiviDiplomeController::class, 'index'])->name('suivi.index');
    Route::get('/suivi/create',        [SuiviDiplomeController::class, 'create'])->name('suivi.create');
    Route::post('/suivi',              [SuiviDiplomeController::class, 'store'])->name('suivi.store');
    Route::post('/suivi/{id}/livrer',  [SuiviDiplomeController::class, 'livrer'])->name('suivi.livrer');

    // Historique
    Route::get('/historique',          [HistoriqueController::class, 'index'])->name('historique.index');
});

// ------------------------------------------------
// Routes Administrateur
// ------------------------------------------------
Route::middleware(['auth', 'role:administrateur'])
     ->prefix('administrateur')
     ->name('administrateur.')
     ->group(function () {

    Route::get('/dashboard', function () {
        return view('administrateur.dashboard');
    })->name('dashboard');

    Route::get('/utilisateurs',             [UtilisateurController::class, 'index'])->name('utilisateurs.index');
    Route::get('/utilisateurs/create',      [UtilisateurController::class, 'create'])->name('utilisateurs.create');
    Route::post('/utilisateurs',            [UtilisateurController::class, 'store'])->name('utilisateurs.store');
    Route::get('/utilisateurs/{id}/edit',   [UtilisateurController::class, 'edit'])->name('utilisateurs.edit');
    Route::put('/utilisateurs/{id}',        [UtilisateurController::class, 'update'])->name('utilisateurs.update');
    Route::delete('/utilisateurs/{id}',     [UtilisateurController::class, 'destroy'])->name('utilisateurs.destroy');
});