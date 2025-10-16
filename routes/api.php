<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\NewsController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::delete('/logout', [AuthController::class, 'destroy']);
});

// Resource routes
Route::apiResource('news', NewsController::class);
Route::apiResource('galleries', GalleryController::class);
Route::apiResource('achievements', AchievementController::class);
Route::apiResource('teachers', TeacherController::class);
Route::apiResource('majors', MajorController::class);
Route::apiResource('roles', RoleController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('users', AuthController::class);
