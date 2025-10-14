<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

Route::group([], function () {
    Route::get('/user', function () {
        return view('settings.user');
    })->name('user-table');
    Route::get('/role', function () {
        return view('settings.role');
    })->name('role-table');
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

    // create form
    Route::get('/create-kategori', function () {
        return view('manage.kategori.create');
    })->name('form-create-kategori');
});
