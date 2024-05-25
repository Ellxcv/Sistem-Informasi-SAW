<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\SupirController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\RatingKriteriaController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\JadwalKirimController;
use App\Http\Controllers\NormalisasiController;
use App\Http\Controllers\HasilSawController;
use App\Http\Controllers\SawController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/master', function () {
    return view('layouts.master');
})->name('master');

Route::get('/dashboard', function () {
    return view('master');
});


// Rute untuk menampilkan halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('password/forgot', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.forgot');
Route::post('password/forgot', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::resource('barang', BarangController::class);
Route::resource('gudang', GudangController::class);
Route::resource('toko', TokoController::class);
Route::resource('kendaraan', KendaraanController::class);
Route::resource('supir', SupirController::class);
Route::resource('alternatif', AlternatifController::class);
Route::resource('pegawai', PegawaiController::class);
Route::resource('kriteria', KriteriaController::class);
Route::resource('rating_kriteria', RatingKriteriaController::class);
Route::resource('pengiriman', PengirimanController::class);
Route::resource('jadwal_kirim', JadwalKirimController::class);
Route::resource('normalisasi', NormalisasiController::class);
Route::resource('hasil_saw', HasilSawController::class);

Route::put('/barang/{barang}', [BarangController::class, 'update'])->name('barang.update');
Route::get('/hasil/create', 'HasilSawController@create')->name('hasil.create');
Route::get('/hasil', [HasilSawController::class, 'index'])->name('hasil.index');
Route::delete('/hasil/{hasil}', [HasilSawController::class, 'destroy'])->name('hasil.destroy');
Route::get('/hasil/{id_hasil}/edit', [HasilSawController::class, 'edit'])->name('hasil.edit');

Route::put('/hasil_saw/{hasil_saw}', [HasilSawController::class, 'update'])->name('hasil_saw.update');

Route::get('/hasil/print', [HasilSawController::class, 'print'])->name('hasil.print');

Route::get('/saw', [SAWController::class, 'index']);

Route::get('/saw-results', [SawController::class, 'index'])->name('saw.results');

Route::post('/normalisasi/hitung', [NormalisasiController::class, 'hitungNormalisasi'])->name('hitung-normalisasi');

// Route untuk menampilkan dashboard dengan hasil SAW
Route::get('/dashboard', [DashboardController::class, 'showSawResults'])->name('dashboard.saw');



