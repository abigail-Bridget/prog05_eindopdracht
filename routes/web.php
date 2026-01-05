<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Public routes for everyone
Route::get('/', [HomeController::class, 'index']);
Route::get('/catalog', [AlbumController::class, 'catalog'])->name('music.catalog');
Route::get('/about', function () {
    return view('about');
})->name('about');

// Toggle status (moet POST zijn, blijft zo staan)
Route::post('/albums/{id}/toggle-status', [AlbumController::class, 'toggleStatus'])
    ->name('albums.toggleStatus');

// Routes for registered users for CRUD
Route::middleware(['auth'])->group(function () {

    // Albums aanmaken/bewerken/verwijderen
    Route::get('/music/create', [AlbumController::class, 'create'])->name('music.create');
    Route::post('/music', [AlbumController::class, 'store'])->name('music.store');
    Route::get('/music/{album}/edit', [AlbumController::class, 'edit'])->name('music.edit');
    Route::put('/music/{album}', [AlbumController::class, 'update'])->name('music.update');
    Route::delete('/music/{album}', [AlbumController::class, 'destroy'])->name('music.destroy');

    // My albums pagina
    Route::get('/my-albums', [AlbumController::class, 'myAlbums'])->name('music.my_albums');

    // Algemene dashboard (alleen ingelogde users)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    // Admin routes
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
});

// Let op: deze SHOW route moet ONDER alle specifieke /music/... routes staan
Route::get('/music/{album}', [AlbumController::class, 'show'])->name('music.show');

// Auth routes
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Registered users can edit profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include the auth routes (login, register, etc.)
require __DIR__ . '/auth.php';
