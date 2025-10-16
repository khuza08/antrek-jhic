<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ✅ Default: arahkan ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// ✅ Halaman login (GET)
Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('guest');

// ✅ Proses login (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// ✅ Logout (POST)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Routes (Hanya bisa diakses jika sudah login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

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
        return view('manage.guru.guru');
    })->name('guru-table');

    Route::get('/jurusan', function () {
        return view('manage.jurusan.jurusan');
    })->name('jurusan-table');

    Route::get('/berita', function () {
        return view('manage.berita.berita');
    })->name('berita-table');

    Route::get('/prestasi', function () {
        return view('manage.prestasi.prestasi');
    })->name('prestasi-table');

    Route::get('/galeri', function () {
        return view('manage.galeri.galeri');
    })->name('Galeri-table');

    Route::get('/kategori', function () {
        return view('manage.kategori.kategori');
    })->name('kategori-table');

    Route::get('/create-kategori', function () {
        return view('manage.kategori.create');
    })->name('form-create-kategori');
});
