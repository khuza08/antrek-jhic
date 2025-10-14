<?php

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/user', function () {
    return view('settings.user');
})->name('user-table');

Route::get('/role', function () {
    return view('settings.role');
})->name('role-table');

Route::get('/guru', function () {
    return view('manage.guru');
})->name('guru-table');

Route::get('/majors', function () {
    return view('manage.majors');
})->name('majors-table');

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
