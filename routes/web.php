<?php

use App\Http\Controllers\AlamatController;
use App\Http\Controllers\BarangController;

// Controllers
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
use Illuminate\Support\Facades\Route;

// ======================
// HALAMAN STATIC
// ======================
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('homePage');
});

Route::get('/login-regis', function () {
    return view('loginRegister');
});

Route::get('/reset-password', function () {
    return view('resetPass');
});

// ======================
// AUTHENTICATION ROUTES
// ======================

// Pembeli
Route::prefix('pembeli')->group(function () {
    Route::post('/register', [PembeliController::class, 'store']);
    Route::post('/login', [PembeliController::class, 'login']);
});

// Penitip
Route::prefix('penitip')->group(function () {
    Route::post('/register', [PenitipController::class, 'store']);
    Route::post('/login', [PenitipController::class, 'login']);
});

// Pegawai
Route::prefix('pegawai')->group(function () {
    Route::post('/register', [PegawaiController::class, 'store']);
    Route::post('/login', [PegawaiController::class, 'login']);
});

// Organisasi
Route::prefix('organisasi')->group(function () {
    Route::post('/register', [OrganisasiController::class, 'store']);
    Route::post('/login', [OrganisasiController::class, 'login']);
});

// ======================
// PROTECTED ROUTES
// ======================
Route::middleware('auth:sanctum')->group(function () {

    // Pegawai
    Route::apiResource('pegawai', PegawaiController::class)->except(['create', 'edit']);
    Route::post('pegawai/logout', [PegawaiController::class, 'logout']);

    // Pembeli
    Route::apiResource('pembeli', PembeliController::class)->except(['create', 'edit']);
    Route::post('pembeli/logout', [PembeliController::class, 'logout']);

    // Penitip
    Route::apiResource('penitip', PenitipController::class)->except(['create', 'edit']);
    Route::post('penitip/logout', [PenitipController::class, 'logout']);

    // Organisasi
    Route::apiResource('organisasi', OrganisasiController::class)->except(['create', 'edit']);
    Route::post('organisasi/logout', [OrganisasiController::class, 'logout']);
});

// ======================
// PUBLIC RESOURCE ROUTES
// ======================
Route::apiResource('alamat', AlamatController::class)->except(['create', 'edit']);
Route::apiResource('barang', BarangController::class)->except(['create', 'edit']);
Route::apiResource('diskusi', DiskusiController::class)->except(['create', 'edit']);
Route::apiResource('donasi', DonasiController::class)->except(['create', 'edit']);
Route::apiResource('jabatan', JabatanController::class)->except(['create', 'edit']);
Route::apiResource('komisi', KomisiController::class)->except(['create', 'edit']);
Route::apiResource('merchandise', MerchandiseController::class)->except(['create', 'edit']);
Route::apiResource('penukaran', PenukaranController::class)->except(['create', 'edit']);
Route::apiResource('reqDonasi', ReqDonasiController::class)->except(['create', 'edit']);
