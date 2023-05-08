<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KoorController;
use App\Http\Controllers\PermohonanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterDosenController;
use App\Http\Middleware\Mahasiswa;

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

Route::get('/info-magang', [AdminController::class, 'infomagangdepan'])->name('info-magang');


Auth::routes(['verify' => true]);

Route::get('/register-dosen', [RegisterDosenController::class, 'index'])->name('register-dosen');
Route::post('/register-dosen', [RegisterDosenController::class, 'store'])->name('register-dosen-store');


Route::get('/home', [HomeController::class, 'index'])->name('home');


// admin
Route::group(['middleware' => 'admin','verified'], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/admin/info-magang', [AdminController::class, 'infomagangcreate'])->name('admin.info-magang');
    Route::post('/admin/info-magang/store', [AdminController::class, 'addinfomagang'])->name('addinfomagang');
    Route::post('/admin/info-magang/destroy/{id}', [AdminController::class, 'destroy'])->name('infomagang.destroy');
    Route::post('/admin/info-magang/update/{id}', [AdminController::class, 'update'])->name('infomagang.update');
    Route::get('/admin/bobot', [DosenController::class, 'bobotdosen'])->name('bobot');
    Route::get('/admin/permohonan', [AdminController::class, 'permohonan'])->name('admin.permohonan');
    Route::post('/admin/bobot/update/{id}', [DosenController::class, 'kuotabimbingan'])->name('kuota');
    Route::get('/bobot-list', function () {
        return view('admin.bobot-list');
    })->name('bobot-list');
    Route::get('/admin/list-mahasiswa', [AdminController::class, 'allmhs'])->name('admin.list-mahasiswa');
    Route::post('/admin/list-mahasiswa/search', [AdminController::class, 'search'])->name('admin.search');
    Route::post('/admin/list-mahasiswa/destroy/{id}', [AdminController::class, 'mhsdestroy'])->name('admin.mhsdestroy');
    Route::get('/admin/berkas-nilai', [AdminController::class, 'berkas'])->name('admin.berkas-nilai');
    Route::get('/admin/pengaturan', function () {
        return view('admin.pengaturan');
    })->name('admin.pengaturan');
    Route::post('/admin/pengaturan', [AdminController::class, 'setting'])->name('admin.setting');
    Route::get('/admin/berkas-nilai/berkas-akhir/{id}', [AdminController::class, 'berkasakhir'])->name('admin.berkas-akhir');
    // Route::get('/admin/berkas-nilai/berkas-akhir', [AdminController::class, 'berkasakhir'])->name('admin.berkas-akhir');
});

// dosen
Route::group(['middleware' => 'dosen'], function () {
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen')->middleware('dosen');
    Route::get('/dosen/list-mahasiswa', [DosenController::class, 'allmhs'])->name('dosen.list-mahasiswa');
    Route::post('/dosen/list-mahasiswa/search', [DosenController::class, 'search'])->name('dosen.search');
    Route::post('/dosen/list-mahasiswa/destroy/{id}', [DosenController::class, 'mahasiswadestroy'])->name('listmahasiswa.destroy');
    Route::get('/dosen/pendaftaran', [DosenController::class, 'halamanpendaftaran'])->name('dosen.pendaftaran');
    Route::get('/dosen/bimbingan', [DosenController::class, 'bimbingan'])->name('dosen.bimbingan');
    Route::get('/dosen/jadwal', [DosenController::class, 'jadwalseminar'])->name('dosen.jadwal');
    Route::get('/dosen/pengaturan', function () {
        return view('dosen.pengaturan');
    })->name('dosen.pengaturan');
    Route::post('/dosen/pengaturan', [DosenController::class, 'setting'])->name('dosen.setting');
    Route::post('/dosen/setujuilaporan/{id}', [DosenController::class, 'setujuilaporan'])->name('dosen.setujuilaporan');
});

// mahasiswa
Route::group(['middleware' => ['mahasiswa','verified']], function () {
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');
    Route::get('/mahasiswa/pendaftaran', [MahasiswaController::class, 'pendaftaran'])->name('pendaftaran');
    Route::post('/mahasiswa/pendaftaran/store', [MahasiswaController::class, 'pendaftaranstore'])->name('pendaftaran.store');
    Route::get('/mahasiswa/permohonan', [PermohonanController::class, 'index'])->name('permohonan');
    Route::post('/mahasiswa/permohonan', [PermohonanController::class, 'sendPermohonan'])->name('permohonan.sendPermohonan');
    Route::get('mahasiswa/export-pdf', [MahasiswaController::class, 'exportPdf'])->name('export-pdf');
    Route::get('mahasiswa/permohonan-fakultas', [MahasiswaController::class, 'permohonanFakultas'])->name('permohonan-fakultas');
    Route::get('/mahasiswa/pengumpulan', [MahasiswaController::class, 'pengumpulan'])->name('pengumpulan');
    Route::post('/mahasiswa/pengumpulan/store', [MahasiswaController::class, 'bimbinganstore'])->name('bimbingan.store');
    Route::get('/mahasiswa/finalisasi', [MahasiswaController::class, 'finalisasi'])->name('finalisasi');
    Route::post('/mahasiswa/finalisasi/store', [MahasiswaController::class, 'finalisasistore'])->name('finalisasi.store');
    Route::get('/mahasiswa/pengaturan', function () {
        return view('mahasiswa.pengaturan');
    })->name('mahasiswa.pengaturan');
    Route::post('/mahasiswa/pengaturan', [MahasiswaController::class, 'setting'])->name('mahasiswa.setting');
    Route::post('/mahasiswa/pengaturan/store', [MahasiswaController::class, 'avatar'])->name('mahasiswa.avatar');
    // Route::resource('products', 'App\Http\Controllers\MahasiswaController');
});

// koordinator
Route::group(['middleware' => 'koor'], function () {
    Route::get('/koordinator', [KoorController::class, 'index'])->name('koordinator');
    Route::get('/koordinator/permohonan', [KoorController::class, 'permohonan'])->name('koordinator.permohonan');
    Route::post('/koordinator/permohonan/approved/{id}', [KoorController::class, 'approved'])->name('koordinator.approved');
    // Route::get('/koordinator/sudah-dinilai', [KoorController::class, 'sudah_dinilai'])->name('koordinator.sudah-dinilai');
    Route::get('/koordinator/penilaian', [KoorController::class, 'penilaian'])->name('koordinator.penilaian');
    Route::post('/koordinator/penilaian/approved/{id}', [KoorController::class, 'penilaianapproved'])->name('koordinator.penilaianapproved');
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
