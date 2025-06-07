<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\FaqCOntroller;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengumumanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/faq', [FaqCOntroller::class, 'index'])->name('faq');

    Route::get('/submenu1', [MenuController::class, 'submenu1'])->name('submenu1');
    Route::get('/submenu1_1', [MenuController::class, 'submenu1_1'])->name('submenu1_1');
    // Route::get('/faq', [FaqController::class, 'index']);
    Route::get('/main', [FaqCOntroller::class, 'main'])->name('main');

    Route::resource('pengumuman', PengumumanController::class);
});

// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::resource('/users', UserController::class);
// });


require __DIR__ . '/auth.php';
