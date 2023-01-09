<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// ini routes ke home admin
Route::get('/admin', function () {
    return view('admin.home');
});

// dosen
Route::get('/dosen', function () {
    return view('dosen.home');
});

// mahasiswa
Route::get('/mahasiswa', function () {
    return view('mahasiswa.home');
});

// koordinator
Route::get('/koordinator', function () {
    return view('koordinator.home');
});

//login
Route::get('/login', function () {
    return view('login.index');
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
