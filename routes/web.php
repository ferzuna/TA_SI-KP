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
})->name('welcome');
Route::get('/permohonan', [App\Http\Controllers\PermohonanController::class, 'index'])->name('permohonan');
Route::post('/permohonan', [App\Http\Controllers\PermohonanController::class, 'sendPermohonan'])->name('permohonan.sendPermohonan');


Auth::routes();

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// admin
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::get('/admin/bobot', [App\Http\Controllers\DosenController::class, 'bobotdosen'])->name('bobot');
    Route::get('/bobot-list', function () {
        return view('admin.bobot-list');
    })->name('bobot-list');
    Route::get('/admin/list-mahasiswa', function () {
        return view('admin.list-mahasiswa');
    })->name('admin.list-mahasiswa');

    Route::get('/admin/berkas-nilai', function () {
        return view('admin.berkas-nilai');
    })->name('admin.berkas-nilai');
    Route::get('/admin/pengaturan', function () {
        return view('admin.pengaturan');
    })->name('admin.pengaturan');
});

// dosen
Route::group(['middleware' => 'dosen'], function () {
    Route::get('/dosen', [App\Http\Controllers\DosenController::class, 'index'])->name('dosen')->middleware('dosen');
    Route::get('/dosen/list-mahasiswa', [App\Http\Controllers\MahasiswaController::class, 'allmhs'])->name('dosen.list-mahasiswa');
    Route::get('/dosen/pendaftaran', function () {
        return view('dosen.pendaftaran');
    })->name('dosen.pendaftaran');
    Route::get('/dosen/bimbingan', function () {
        return view('dosen.bimbingan');
    })->name('dosen.bimbingan');
    Route::get('/dosen/jadwal', function () {
        return view('dosen.jadwal');
    })->name('dosen.jadwal');
    Route::get('/dosen/pengaturan', function () {
        return view('dosen.pengaturan');
    })->name('dosen.pengaturan');
});

// mahasiswa
Route::group(['middleware' => 'mahasiswa'], function () {
    Route::get('/mahasiswa', [App\Http\Controllers\MahasiswaController::class, 'index'])->name('mahasiswa');
    Route::get('/mahasiswa/pendaftaran', [App\Http\Controllers\DosenController::class, 'pendaftaran'])->name('pendaftaran');
    Route::post('/mahasiswa/pendaftaran', [App\Http\Controllers\PendaftaranController::class, 'store'])->name('pendaftaran.store');
    Route::get('/mahasiswa/pengumpulan', function () {
        return view('mahasiswa.pengumpulan');
    })->name('pengumpulan');
    Route::get('/mahasiswa/finalisasi', function () {
        return view('mahasiswa.finalisasi');
    })->name('finalisasi');
    Route::get('/mahasiswa/pengaturan', function () {
        return view('mahasiswa.pengaturan');
    })->name('mahasiswa.pengaturan');
    Route::post('/mahasiswa/pengaturan', [App\Http\Controllers\MahasiswaController::class, 'test'])->name('test');
});

// koordinator
Route::group(['middleware' => 'koor'], function () {
    Route::get('/koordinator', [App\Http\Controllers\KoorController::class, 'index'])->name('koordinator');
    Route::get('/koordinator/sudah-dinilai', function () {
        return view('koordinator.sudah-dinilai');
    })->name('koordinator.sudah-dinilai');
    Route::get('/koordinator/belum-dinilai', function () {
        return view('koordinator.belum-dinilai');
    })->name('koordinator.belum-dinilai');
    Route::get('/koordinator/pengaturan', function () {
        return view('koordinator.pengaturan');
    })->name('koordinator.pengaturan');
});






// dosen



// mahasiswa



// untuk balancing beban dosen pembimbing
// Route::post('/dosbing', [App\Http\Controllers\DosenController::class, 'bimbingan']);



// koordinator





// Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

// Route::get('/admin',[LoginController::class,'showAdminLoginForm'])->name('admin.login-view');
// Route::post('/admin',[LoginController::class,'adminLogin'])->name('admin.login');

// Route::get('/admin/register',[RegisterController::class,'showAdminRegisterForm'])->name('admin.register-view');
// Route::post('/admin/register',[RegisterController::class,'createAdmin'])->name('admin.register');

// Route::get('/admin/dashboard',function(){
//     return view('admin.home');
// })->middleware('auth:admin');
