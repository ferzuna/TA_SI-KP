<?php

use App\Http\Controllers\DosenController;
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
})->name('welcome')->middleware('welcome');
Route::get('/dokumen', function () {
    return view('dokumen');
})->name('dokumen');

Route::get('/info-magang', [App\Http\Controllers\AdminController::class, 'infomagangdepan'])->name('info-magang');


Auth::routes();

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// admin
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::get('/admin/info-magang', [App\Http\Controllers\AdminController::class, 'infomagangcreate'])->name('admin.info-magang');
    Route::post('/admin/info-magang/store', [App\Http\Controllers\AdminController::class, 'addinfomagang'])->name('addinfomagang');
    Route::post('/admin/info-magang/destroy/{id}', [App\Http\Controllers\AdminController::class, 'destroy'])->name('infomagang.destroy');
    Route::post('/admin/info-magang/update/{id}', [App\Http\Controllers\AdminController::class, 'update'])->name('infomagang.update');
    Route::get('/admin/bobot', [App\Http\Controllers\DosenController::class, 'bobotdosen'])->name('bobot');
    Route::get('/admin/permohonan', [App\Http\Controllers\AdminController::class, 'permohonan'])->name('admin.permohonan');
    Route::post('/admin/bobot/update/{id}', [App\Http\Controllers\DosenController::class, 'kuotabimbingan'])->name('kuota');
    Route::get('/bobot-list', function () {
        return view('admin.bobot-list');
    })->name('bobot-list');
    Route::get('/admin/list-mahasiswa', [App\Http\Controllers\AdminController::class, 'allmhs'])->name('admin.list-mahasiswa');
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
    Route::get('/dosen/list-mahasiswa', [App\Http\Controllers\DosenController::class, 'allmhs'])->name('dosen.list-mahasiswa');
    Route::post('/dosen/list-mahasiswa/destroy/{id}', [App\Http\Controllers\DosenController::class, 'mahasiswadestroy'])->name('listmahasiswa.destroy');
    Route::get('/dosen/pendaftaran', [App\Http\Controllers\DosenController::class, 'halamanpendaftaran'])->name('dosen.pendaftaran');
    Route::get('/dosen/bimbingan', [DosenController::class, 'bimbingan'])->name('dosen.bimbingan');
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
    Route::get('/mahasiswa/pendaftaran', [App\Http\Controllers\MahasiswaController::class, 'pendaftaran'])->name('pendaftaran');
    Route::post('/mahasiswa/pendaftaran/store', [App\Http\Controllers\MahasiswaController::class, 'pendaftaranstore'])->name('pendaftaran.store');
    Route::get('/mahasiswa/permohonan', [App\Http\Controllers\PermohonanController::class, 'index'])->name('permohonan');
    Route::post('/mahasiswa/permohonan', [App\Http\Controllers\PermohonanController::class, 'sendPermohonan'])->name('permohonan.sendPermohonan');
    Route::get('/mahasiswa/pengumpulan', [App\Http\Controllers\MahasiswaController::class, 'pengumpulan'])->name('pengumpulan');
    Route::post('/mahasiswa/pengumpulan/store', [App\Http\Controllers\MahasiswaController::class, 'bimbinganstore'])->name('bimbingan.store');
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
    Route::get('/koordinator/permohonan', [App\Http\Controllers\KoorController::class, 'permohonan'])->name('koordinator.permohonan');
    Route::post('/koordinator/permohonan/approved/{id}', [App\Http\Controllers\KoorController::class, 'approved'])->name('koordinator.approved');
    Route::get('/koordinator/sudah-dinilai', [App\Http\Controllers\KoorController::class, 'sudah_dinilai'])->name('koordinator.sudah-dinilai');
    Route::get('/koordinator/belum-dinilai', [App\Http\Controllers\KoorController::class, 'belum_dinilai'])->name('koordinator.belum-dinilai');
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
