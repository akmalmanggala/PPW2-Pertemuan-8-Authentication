<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use GuzzleHttp\Middleware;
use App\Http\Controllers\DashboardContrller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/login', [AuthController::class,'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class,'login']);
Route::get('/register', [AuthController::class,'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class,'register']);

Route::middleware(['auth', 'isUser'])->group(function () {
    Route::get('/dashboard/user', [DashboardContrller::class, 'dashboardUser'])
    ->name('user.dashboard');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard/admin', [DashboardContrller::class, 'dashboardAdmin'])
        ->name('admin.dashboard');
    Route::get('/admin/jobs', [JobController::class, 'index'])->name('admin.jobs');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class,'logout'])->name('logout');
});
