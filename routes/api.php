<?php

use App\Http\Controllers\Api\ApplicationApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardApiController;
use App\Http\Controllers\Api\JobApiController;
use App\Http\Controllers\Api\JobUserApiController;
use App\Http\Controllers\Api\ProfileApiController;
use App\Http\Controllers\Api\PublicJobApiController;
use Illuminate\Support\Facades\Route;

/**
 * @OA\Info(
 *     title="Job Portal API",
 *     version="1.0.0",
 *     description="API untuk aplikasi Job Portal - Pertemuan 6 PPW2",
 *     @OA\Contact(
 *         email="akmalmanggala2810@gmail.com",
 *         name="Akmal Manggala Putra"
 *     )
 * )
 *
 * @OA\Server(
 *     url="http://127.0.0.1:8000",
 *     description="Local Development Server"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="sanctum",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="Enter your bearer token in the format: Bearer {token}"
 * )
 */

// Public routes - Authentication
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public Jobs - Read-only tanpa authentication (Latihan 4)
Route::get('/public/jobs', [PublicJobApiController::class, 'index']);
Route::get('/public/jobs/{id}', [PublicJobApiController::class, 'show']);

// Public routes - Jobs (read only)
Route::get('/jobs', [JobApiController::class, 'index']);
Route::get('/jobs/{id}', [JobApiController::class, 'show']);

// User Jobs - with advanced search and filters
Route::get('/user/jobs', [JobUserApiController::class, 'index']);
Route::get('/user/jobs/{id}', [JobUserApiController::class, 'show']);

// Protected routes - require authentication
Route::middleware('auth:sanctum')->group(function () {

    // Authentication
    Route::post('/logout', [AuthController::class, 'logout']);

    // Profile Management
    Route::get('/profile', [ProfileApiController::class, 'show']);
    Route::put('/profile', [ProfileApiController::class, 'update']);

    // Dashboard
    Route::get('/dashboard/user', [DashboardApiController::class, 'userDashboard']);

    // Applications - User can apply
    Route::post('/applications', [ApplicationApiController::class, 'store']);

    // Admin only routes
    Route::middleware('isAdmin')->group(function () {

        // Dashboard Admin
        Route::get('/dashboard/admin', [DashboardApiController::class, 'adminDashboard']);

        // Job Management (Admin)
        Route::post('/jobs', [JobApiController::class, 'store']);
        Route::put('/jobs/{id}', [JobApiController::class, 'update']);
        Route::delete('/jobs/{id}', [JobApiController::class, 'destroy']);

        // Application Management (Admin)
        Route::get('/applications', [ApplicationApiController::class, 'index']);
        Route::patch('/applications/{id}/status', [ApplicationApiController::class, 'updateStatus']);
    });
});
