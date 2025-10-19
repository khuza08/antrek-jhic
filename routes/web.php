<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('guest');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');


/*
|--------------------------------------------------------------------------
| Protected Routes (Hanya bisa diakses jika sudah login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/profile/picture', [AuthController::class, 'deleteProfilePicture'])->name('profile.picture.delete');

    // Settings Routes
    Route::get('/user', function () {
        return view('settings.user');
    })->name('user-table');

    Route::get('/role', function () {
        return view('settings.role');
    })->name('role-table');

    // Manage Routes
    Route::get('/guru', function () {
        return view('manage.guru');
    })->name('guru-table');

    Route::get('/jurusan', function () {
        return view('manage.jurusan');
    })->name('jurusan-table');

    Route::get('/berita', function () {
        return view('manage.berita');
    })->name('berita-table');

    Route::get('/prestasi', function () {
        return view('manage.prestasi');
    })->name('prestasi-table');

    Route::get('/galeri', function () {
        return view('manage.galeri');
    })->name('Galeri-table');

    Route::get('/kategori', function () {
        return view('manage.kategori');
    })->name('kategori-table');
});

// Route::get('/storage/{path}', function ($path) {
//     $path = storage_path('app/public/' . $path);
//     if (!file_exists($path)) {

//         abort(404, 'File not found.');
//     }
//     return response()->file($path);
// })->where('path', '.*');