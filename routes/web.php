<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Public routes for everyone
Route::get('/', [HomeController::class, 'index']);
Route::get('/catalog', [AlbumController::class, 'catalog'])->name('music.catalog');
Route::get('/about', function () {return view('about');})->name('about');
Route::get('/music/{albums}', [AlbumController::class, 'show'])->name('music.show');
Route::post('/albums/{id}/toggle-status', [AlbumController::class, 'toggleStatus'])->name('albums.toggleStatus');



// Routes for registered users for CRUD
Route::middleware(['auth'])->group(function () {
    Route::get('/music/create', [AlbumController::class, 'create'])->name('music.create');
    Route::post('/music', [AlbumController::class, 'store'])->name('music.store');
    Route::get('/music/{album}/edit', [AlbumController::class, 'edit'])->name('music.edit');
    Route::put('/music/{album}', [AlbumController::class, 'update'])->name('music.update'); // Use PUT here
    Route::delete('/music/{album}', [AlbumController::class, 'destroy'])->name('music.destroy');

    Route::get('/my-albums', [AlbumController::class, 'myAlbums'])->name('music.my_albums');

    // Route for the general dashboard (only for logged-in users)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');


// Admin routes
    Route::middleware(['auth'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard'); // Admin dashboard
        Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index'); // List users
        Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit'); // Edit user
        Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update'); // Update user
        Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy'); // Delete user
    });
});

// Auth routes
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Registered users can edit profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Use PUT here
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Include the auth routes
require __DIR__.'/auth.php';
