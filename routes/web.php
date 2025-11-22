<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use GuzzleHttp\Middleware;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobUserController;
use App\Http\Controllers\ApplicationController;
use App\Models\Application;
use Illuminate\Support\Facades\App;

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
    Route::get('/dashboard/user', [DashboardController::class, 'dashboardUser'])
    ->name('user.dashboard');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/jobs', [JobUserController::class, 'index'])->name('user.jobs');
    Route::get('/jobs/{id}', [JobUserController::class, 'show'])->name('user.jobs.show');
    Route::get('/jobs/{id}/apply', [ApplicationController::class, 'create'])->name('user.jobs.apply.form');
    Route::post('/jobs/{id}/apply', [ApplicationController::class, 'store'])->name('user.jobs.apply');
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard/admin', [DashboardController::class, 'dashboardAdmin'])
        ->name('admin.dashboard');
    Route::resource('admin/jobs', JobController::class)->names([
        'index' => 'admin.jobs',
        'create' => 'admin.jobs.create',
        'store' => 'admin.jobs.store',
        'show' => 'admin.jobs.show',
        'edit' => 'admin.jobs.edit',
        'update' => 'admin.jobs.update',
        'destroy' => 'admin.jobs.destroy',
    ]);
    Route::get('/admin/applications', [ApplicationController::class, 'index'])->name('admin.applications');
    Route::put('/admin/applications/{id}', [ApplicationController::class, 'update'])
        ->name('applications.update-status');
    Route::get('/applications/export', [ApplicationController::class, 'export'])
        ->name('applications.export');
    Route::post('/jobs/import', [JobController::class, 'import'])
        ->name('jobs.import');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class,'logout'])->name('logout');
});

