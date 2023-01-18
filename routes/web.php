<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
// Route::get('/admin', function () {
//     return view('admin.home');
// });

// dosen
// Route::get('/dosen', function () {
//     return view('dosen.home');
// });

// mahasiswa
// Route::get('/mahasiswa', function () {
//     return view('mahasiswa.home');
// });

// koordinator
// Route::get('/koordinator', function () {
//     return view('koordinator.home');
// });




// Auth::routes();

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// admin
Route::get('/admin', function () {
    return view('admin.home');
})->name('admin');
Route::get('/bobot', function () {
    return view('admin.bobot');
})->name('bobot');
Route::get('/bobot-list', function () {
    return view('admin.bobot-list');
})->name('bobot-list');

// dosen
Route::get('/admin/bobot', function () {
    return view('dosen.home');
})->name('dosen');


// Route::get('/dosen/list-mahasiswa', function () {
//     return view('dosen.list-mahasiswa');
// })->name('dosen.list-mahasiswa');
Route::get('/dosen/list-mahasiswa', [App\Http\Controllers\MahasiswaController::class, 'allmhs'])->name('dosen.list-mahasiswa');

// mahasiswa
Route::get('/mahasiswa', function () {
    return view('mahasiswa.home');
})->name('mahasiswa');

// koordinator
Route::get('/koordinator', function () {
    return view('koordinator.home');
})->name('koordinator');



// Route::get('/bobot', [App\Http\Controllers\DosenController::class, 'index'])->name('bobot');


// Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

// Route::get('/admin',[LoginController::class,'showAdminLoginForm'])->name('admin.login-view');
// Route::post('/admin',[LoginController::class,'adminLogin'])->name('admin.login');

// Route::get('/admin/register',[RegisterController::class,'showAdminRegisterForm'])->name('admin.register-view');
// Route::post('/admin/register',[RegisterController::class,'createAdmin'])->name('admin.register');

// Route::get('/admin/dashboard',function(){
//     return view('admin.home');
// })->middleware('auth:admin');
