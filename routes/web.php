<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\appController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\AnggotaController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/berita/semua', [BeritaController::class, 'showAll'])->name('berita.showAll');
Route::get('/berita/{berita}', [BeritaController::class, 'show'])->name('berita.show');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('autentikasi');



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [appController::class, 'dashboard'])->name('dashboard');
    Route::get('/daftar-admin', [appController::class, 'daftaradmin'])->name('daftaradmin');
    Route::post('/logout', [appController::class, 'logout'])->name('logout'); 

     Route::middleware('can:create-admin')->group(function () {
        Route::get('/form-register', [AuthController::class, 'form_register'])->name('form_register');
        Route::post('/registrasi', [AuthController::class, 'registrasi'])->name('register');
     });


    Route::get('/admin/berita', [BeritaController::class, 'index'])->name('berita.index');
    Route::delete('/admins/{admin}', [AppController::class, 'destroy'])->name('admin.destroy');
    Route::post('/admin/berita/store', [BeritaController::class, 'store'])->name('storeberita');
    Route::put('/berita/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');

    Route::get('/account/settings', [AuthController::class, 'showSettings'])->name('account.settings');
    Route::put('/account/update-profile', [AuthController::class, 'updateProfile'])->name('account.updateProfile');
    Route::put('/account/update-password', [AuthController::class, 'updatePassword'])->name('account.updatePassword');
    Route::delete('/account/delete', [AuthController::class, 'destroyAccount'])->name('account.destroy');
   

    Route::get('/jadwal-ibadah', [appController::class, 'jadwal_ibadah'])->name('jadwal-ibadah.index');
    Route::post('/jadwal-ibadah', [appController::class, 'jadwal_ibadah_store'])->name('jadwal-ibadah.store');
    Route::put('/jadwal-ibadah/{jadwalIbadah}', [appController::class, 'jadwal_ibadah_update'])->name('jadwal-ibadah.update');
    Route::delete('/jadwal-ibadah/{jadwalIbadah}', [appController::class, 'jadwal_ibadah_destroy'])->name('jadwal-ibadah.destroy');

    Route::get('/statistik', [appController::class, 'showStatistik'])->name('statistik.index');

    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
    Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::get('/anggota/search', [AuthController::class, 'searchAnggota'])->name('anggota.search');
    Route::delete('/anggota/{anggota}', [AnggotaController::class, 'destroy'])->name('anggota_destroy');




    
});

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');


