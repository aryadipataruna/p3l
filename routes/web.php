<?php

use App\Http\Controllers\AlamatController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DiskusiController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KomisiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PenitipController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenukaranController;
use App\Http\Controllers\RegistrationHandleController;
use App\Http\Controllers\ReqDonasiController;
use Illuminate\Support\Facades\Route;

// Main pages
Route::view('/', 'welcome');
Route::view('/home', 'homePage')->name('home');
Route::view('/login-regis', 'loginRegister')->name('login-regis');
Route::view('/adminPageMerchandise', 'admin.adminPageMerchandise')->name('adminPageMerchandise');
Route::view('/adminPagePegawai', 'admin.adminPagePegawai')->name('adminPagePegawai');
Route::view('/adminPageOrganisasi', 'admin.adminPageOrganisasi')->name('adminPageOrganisasi');
Route::view('/passwordBiasa', 'password.passwordTglLahir')->name('passwordEmail');

// Registration and Login
Route::post('/register', [RegistrationHandleController::class, 'handleRegistration'])->name('handle.registration');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Detail Barang Page
Route::get('/detailBarang/{id}', [BarangController::class, 'show'])->name('detailBarang');

// Admin Pages
Route::prefix('admin')->group(function () {
    Route::get('/merchandise', [MerchandiseController::class, 'index'])->name('admin.merchandise.index');
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('admin.pegawai.index');
    Route::get('/organisasi', [OrganisasiController::class, 'index'])->name('admin.organisasi.index');
});

// Public Routes for Data Access
Route::apiResource('alamat', AlamatController::class);
Route::apiResource('barang', BarangController::class);
Route::apiResource('diskusi', DiskusiController::class);
Route::apiResource('donasi', DonasiController::class);
Route::apiResource('jabatan', JabatanController::class);
Route::apiResource('komisi', KomisiController::class);
Route::apiResource('merchandise', MerchandiseController::class);
Route::apiResource('organisasi', OrganisasiController::class);
Route::apiResource('pegawai', PegawaiController::class);
Route::apiResource('pembeli', PembeliController::class);
Route::apiResource('penitip', PenitipController::class);
Route::apiResource('penjualan', PenjualanController::class);
Route::apiResource('penukaran', PenukaranController::class);
Route::apiResource('reqdonasi', ReqDonasiController::class);

// Profile Routes
Route::get('/penitip/profile', [PenitipController::class, 'profile'])->name('penitip.profile');
Route::get('/pegawai/profile', [PegawaiController::class, 'profile'])->name('pegawai.profile');
Route::get('/pembeli/profile', [PembeliController::class, 'profile'])->name('pembeli.profile');
Route::get('/organisasi/profile', [OrganisasiController::class, 'profile'])->name('organisasi.profile');

// Password Reset Routes
Route::post('/password/reset/email', [LoginController::class, 'resetPasswordEmail'])->name('password.reset.email');
Route::post('/password/reset/phone', [LoginController::class, 'resetPasswordPhone'])->name('password.reset.phone');
Route::post('/password/reset/security', [LoginController::class, 'resetPasswordSecurity'])->name('password.reset.security');

// Additional routes based on functionality
Route::get('/barang/search/{query}', [BarangController::class, 'search'])->name('barang.search');
Route::get('/penitip/saldo/{id}', [PenitipController::class, 'saldo'])->name('penitip.saldo');
Route::get('/pegawai/komisi/{id}', [PegawaiController::class, 'komisi'])->name('pegawai.komisi');
Route::get('/pembeli/rewards/{id}', [PembeliController::class, 'rewards'])->name('pembeli.rewards');
Route::get('/penjualan/history/{id}', [PenjualanController::class, 'history'])->name('penjualan.history');
Route::get('/penukaran/history/{id}', [PenukaranController::class, 'history'])->name('penukaran.history');
Route::get('/reqdonasi/history/{id}', [ReqDonasiController::class, 'history'])->name('reqdonasi.history');

// Cart and Checkout
Route::post('/cart/add', [BarangController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [BarangController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/checkout', [PenjualanController::class, 'checkout'])->name('cart.checkout');

// PDF Nota Route
Route::get('/penitip/nota/{id}', [PenitipController::class, 'generateNota'])->name('penitip.nota');
Route::post('/register/owner', [OwnerController::class, 'store'])->name('owner.store');
Route::post('/register/cs', [CsController::class, 'store'])->name('cs.store');
Route::post('/register/admin', [AdminController::class, 'store'])->name('admin.store');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);
