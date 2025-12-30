<?php

use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\Auth\HomeController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/welcome', fn () => view('welcome'));
Route::get('/about', [HomeController::class, 'about']);

Route::get('/albums', [AlbumsController::class, 'index'])->name('albums.index');
Route::get('/albums/create', [AlbumsController::class, 'create'])->name('albums.create');
Route::post('/music', [AlbumsController::class, 'store'])->name('albums.store');
Route::post('/pets/{pet}/toggle-active', [AlbumsController::class, 'toggleActive'])->name('albums.toggleActive');
Route::get('/pets/{pet}', [AlbumsController::class, 'show'])->name('albums.show');
Route::get('/pets/{pet}/like', [AlbumsController::class, 'like'])->name('albums.like');
Route::get('/pets/{pet}/unlike', [AlbumsController::class, 'unlike'])->name('albums.unlike');

Route::middleware(['auth'])->group(function () {
    Route::get('/my-albums', [AlbumsController::class, 'myAlbums'])->name('albums.myAlbums');
    Route::get('/albums/{album}/edit', [AlbumsController::class, 'edit'])->name('albums.edit'); // Edit form
    Route::put('/albums/{album}', [AlbumsController::class, 'update'])->name('albums.update'); // Update request
    Route::delete('/albums/{album}', [AlbumsController::class, 'destroy'])->name('albums.destroy'); // Delete request

    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
});

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AlbumsController::class, 'adminAlbumsOverview'])->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

