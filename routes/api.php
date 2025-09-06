<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\NewsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('news', NewsController::class);
Route::apiResource('galleries', GalleryController::class);
Route::apiResource('/achievements', AchievementController::class);
Route::apiResource('/teachers', TeacherController::class);
Route::apiResource('/majors', MajorController::class);
Route::apiResource('/categories', CategoryController::class);
Route::apiResource('/roles', RoleController::class);
// manage login resgiter and logout
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::delete('/logout', [AuthController::class, 'destroy']);
});