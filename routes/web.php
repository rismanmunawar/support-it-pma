<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\FaqCOntroller;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ZndsuMonitoringController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Middleware\TandaiPengumumanDilihat;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengumuman;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // FAQ & Menu
    Route::get('/faq', [FaqCOntroller::class, 'index'])->name('faq');
    Route::get('/main', [FaqCOntroller::class, 'main'])->name('main');
    Route::get('/submenu1', [MenuController::class, 'submenu1'])->name('submenu1');
    Route::get('/submenu1_1', [MenuController::class, 'submenu1_1'])->name('submenu1_1');

    // Home (beranda setelah login)
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })
    Route::get('/dashboard', [ZndsuMonitoringController::class, 'index'])
        ->middleware(['auth', 'verified'])
        ->name('dashboard');
    Route::get('/monitoring', [ZndsuMonitoringController::class, 'index'])->name('dashboard');
    Route::post('/monitoring/upload', [ZndsuMonitoringController::class, 'upload'])->name('monitoring.upload');

    // Pengumuman
    Route::middleware([TandaiPengumumanDilihat::class])->group(function () {
        Route::resource('pengumuman', PengumumanController::class);
    });

    // Notifikasi unread count
    Route::get('/notif/unread-count', function () {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['count' => 0]);
        }

        $count = Pengumuman::whereDoesntHave('dibacaOleh', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->count();

        return response()->json(['count' => $count]);
    });

    // Route::get('/monitoring', [ZndsuMonitoringController::class, 'index'])->name('monitoring.index');
});

require __DIR__ . '/auth.php';
