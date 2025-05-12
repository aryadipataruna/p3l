<?php

use App\Http\Controllers\AlamatController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DiskusiController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KomisiController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PenitipController;
use App\Http\Controllers\PenukaranController;
use App\Http\Controllers\ReqDonasiController;
use Illuminate\Http\Request; // Sebaiknya disertakan jika ada route yang menggunakan Request
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sinilah Anda dapat mendaftarkan rute web untuk aplikasi Anda. Rute-rute
| ini dimuat oleh RouteServiceProvider dalam grup yang berisi
| middleware group "web". Buat sesuatu yang hebat!
|
*/

// ======================
// HALAMAN STATIS (VIEWS)
// ======================
Route::get('/', function () {
    return view('welcome'); // Menampilkan view welcome.blade.php
});

Route::get('/home', function () {
    return view('homePage'); // Menampilkan view homePage.blade.php
});

Route::get('/login-regis', function () {
    return view('loginRegister'); // Menampilkan view loginRegister.blade.php
});

Route::get('/reset-password', function () {
                              // Ini adalah view umum untuk reset password
    return view('resetPass'); // Menampilkan view resetPass.blade.php
});

// Rute untuk menampilkan form reset password pembeli (pembeli.blade.php)
Route::get('/pembeli-reset-form', function () {
    // Asumsi Anda memiliki 'pembeli.blade.php' di resources/views
    // View ini biasanya berisi form untuk pengguna memasukkan password baru dan token
    return view('pembeli');
});

// ======================
// RUTE AUTENTIKASI & RESET PASSWORD
// ======================

// Pembeli
Route::prefix('pembeli')->group(function () {
    Route::post('/register', [PembeliController::class, 'store'])->name('pembeli.register.submit');
    Route::post('/login', [PembeliController::class, 'login'])->name('pembeli.login.submit');
    Route::post('/forgot-password', [PembeliController::class, 'forgotPassword'])->name('pembeli.password.email'); // Menangani permintaan kirim link reset
    Route::post('/reset-password', [PembeliController::class, 'resetPassword'])->name('pembeli.password.update');  // Menangani reset password aktual dengan token
                                                                                                                   // Jika Anda memiliki halaman form login/register khusus untuk pembeli yang diakses via GET
                                                                                                                   // Route::get('/login', [PembeliController::class, 'showLoginForm'])->name('pembeli.login');
                                                                                                                   // Route::get('/register', [PembeliController::class, 'showRegistrationForm'])->name('pembeli.register');
});

// Penitip
Route::prefix('penitip')->group(function () {
    Route::post('/register', [PenitipController::class, 'store'])->name('penitip.register.submit');
    Route::post('/login', [PenitipController::class, 'login'])->name('penitip.login.submit');
    Route::post('/forgot-password', [PenitipController::class, 'forgotPassword'])->name('penitip.password.email');
    Route::post('/reset-password', [PenitipController::class, 'resetPassword'])->name('penitip.password.update');
});

// Pegawai
Route::prefix('pegawai')->group(function () {
    Route::post('/register', [PegawaiController::class, 'store'])->name('pegawai.register.submit');
    Route::post('/login', [PegawaiController::class, 'login'])->name('pegawai.login.submit');
    // Tambahkan rute forgot-password dan reset-password untuk Pegawai jika diperlukan
    // Route::post('/forgot-password', [PegawaiController::class, 'forgotPassword'])->name('pegawai.password.email');
    // Route::post('/reset-password', [PegawaiController::class, 'resetPassword'])->name('pegawai.password.update');
});

// Organisasi
Route::prefix('organisasi')->group(function () {
    Route::post('/register', [OrganisasiController::class, 'store'])->name('organisasi.register.submit');
    Route::post('/login', [OrganisasiController::class, 'login'])->name('organisasi.login.submit');
    // Tambahkan rute forgot-password dan reset-password untuk Organisasi jika diperlukan
    // Route::post('/forgot-password', [OrganisasiController::class, 'forgotPassword'])->name('organisasi.password.email');
    // Route::post('/reset-password', [OrganisasiController::class, 'resetPassword'])->name('organisasi.password.update');
});

// ======================
// RUTE YANG DILINDUNGI (Membutuhkan Autentikasi Web)
// ======================
// Middleware 'auth' digunakan untuk autentikasi web berbasis sesi Laravel
Route::middleware('auth')->group(function () {

    // Pegawai
    // Route::apiResource tetap digunakan jika controller mengembalikan JSON.
    // Jika controller mengembalikan view, pertimbangkan Route::resource.
    Route::apiResource('pegawai', PegawaiController::class)->except(['create', 'edit', 'store']);
    Route::post('pegawai/logout', [PegawaiController::class, 'logout'])->name('pegawai.logout');

    // Pembeli
    Route::apiResource('pembeli', PembeliController::class)->except(['create', 'edit', 'store']);
    Route::post('pembeli/logout', [PembeliController::class, 'logout'])->name('pembeli.logout');

    // Penitip
    Route::apiResource('penitip', PenitipController::class)->except(['create', 'edit', 'store']);
    Route::post('penitip/logout', [PenitipController::class, 'logout'])->name('penitip.logout');

    // Organisasi
    Route::apiResource('organisasi', OrganisasiController::class)->except(['create', 'edit', 'store']);
    Route::post('organisasi/logout', [OrganisasiController::class, 'logout'])->name('organisasi.logout');

    // Contoh rute untuk pengguna yang terautentikasi
    Route::get('/user', function (Request $request) {
        return $request->user();  // Mengembalikan data pengguna yang sedang login
    })->name('user.profile'); // Memberi nama pada rute
});

// ======================
// RUTE RESOURCE PUBLIK
// ======================
// Rute-rute ini dapat diakses tanpa login.
// Jika salah satu dari resource ini memerlukan autentikasi untuk beberapa aksi (misalnya create, update, delete),
// Anda harus mendefinisikannya secara terpisah di dalam grup middleware 'auth' atau menyesuaikan controller.
// Penggunaan apiResource mengasumsikan controller mengembalikan JSON.
// Jika untuk halaman web dengan view, pertimbangkan Route::resource dan sesuaikan controller.

Route::apiResource('alamat', AlamatController::class)->except(['create', 'edit']);
Route::apiResource('barang', BarangController::class)->except(['create', 'edit']);
Route::apiResource('diskusi', DiskusiController::class)->except(['create', 'edit']);
Route::apiResource('donasi', DonasiController::class)->except(['create', 'edit']);
Route::apiResource('jabatan', JabatanController::class)->except(['create', 'edit']);
Route::apiResource('komisi', KomisiController::class)->except(['create', 'edit']);
Route::apiResource('merchandise', MerchandiseController::class)->except(['create', 'edit']);
Route::apiResource('penukaran', PenukaranController::class)->except(['create', 'edit']);
Route::apiResource('reqDonasi', ReqDonasiController::class)->except(['create', 'edit']);

// Jika Anda memiliki halaman dashboard utama setelah login
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware('auth')->name('dashboard');
