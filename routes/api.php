<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CustomerServiceController;
use App\Http\Controllers\DiskusiController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\HunterController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KomisiController;
use App\Http\Controllers\KurirController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PegawaiGudangController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PenitipController;
use App\Http\Controllers\PenukaranController;
use App\Http\Controllers\ReqDonasiController;
use Illuminate\Support\Facades\Route;

// =====================
// ROUTES REGISTER SEMUA ROLE
// =====================

Route::post('/owner/register', [OwnerController::class, 'store'])->name('owner.store');
Route::post('/admin/register', [AdminController::class, 'store'])->name('admin.store');
Route::post('/pegawaigudang/register', [PegawaiGudangController::class, 'store'])->name('pegawaigudang.store');
Route::post('/cs/register', [CustomerServiceController::class, 'store'])->name('cs.store');
Route::post('/kurir/register', [KurirController::class, 'store'])->name('kurir.store');
Route::post('/hunter/register', [HunterController::class, 'store'])->name('hunter.store');

// ROUTES REGISTER YANG SUDAH ADA
Route::post('/pembeli/register', [PembeliController::class, 'store'])->name('pembeli.store');
Route::post('/penitip/register', [PenitipController::class, 'store'])->name('penitip.store');
Route::post('/pegawai/register', [PegawaiController::class, 'store'])->name('pegawai.store');
Route::post('/organisasi/register', [OrganisasiController::class, 'store'])->name('organisasi.store');

// ROUTES LOGIN UNIFIED
Route::post('/login', [LoginController::class, 'login'])->name('login');

// =====================
// ROUTES AUTHENTICATED (LOGIN DULU PAKAI TOKEN SANCTUM)
// =====================

Route::middleware('auth:sanctum')->group(function () {
    // Info user authenticated & logout
    Route::get('/user', [LoginController::class, 'getUser'])->name('user.authenticated');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Pegawai
    Route::get('/pegawai/authenticated', [PegawaiController::class, 'index'])->name('pegawai.index.authenticated');
    Route::get('/pegawai/authenticated/{id}', [PegawaiController::class, 'show'])->name('pegawai.show.authenticated');
    Route::post('/pegawai/create/authenticated', [PegawaiController::class, 'store'])->name('pegawai.create.authenticated');
    Route::put('/pegawai/update/authenticated/{id}', [PegawaiController::class, 'update'])->name('pegawai.update.authenticated');
    Route::delete('/pegawai/delete/authenticated/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.delete.authenticated');

    // Pembeli
    Route::get('/pembeli/authenticated', [PembeliController::class, 'index'])->name('pembeli.index.authenticated');
    Route::get('/pembeli/authenticated/{id}', [PembeliController::class, 'show'])->name('pembeli.show.authenticated');
    Route::post('/pembeli/create/authenticated', [PembeliController::class, 'store'])->name('pembeli.create.authenticated');
    Route::put('/pembeli/update/authenticated/{id}', [PembeliController::class, 'update'])->name('pembeli.update.authenticated');
    Route::delete('/pembeli/delete/authenticated/{id}', [PembeliController::class, 'destroy'])->name('pembeli.delete.authenticated');

    // Penitip
    Route::get('/penitip/authenticated', [PenitipController::class, 'index'])->name('penitip.index.authenticated');
    Route::get('/penitip/authenticated/{id}', [PenitipController::class, 'show'])->name('penitip.show.authenticated');
    Route::post('/penitip/create/authenticated', [PenitipController::class, 'store'])->name('penitip.create.authenticated');
    Route::put('/penitip/update/authenticated/{id}', [PenitipController::class, 'update'])->name('penitip.update.authenticated');
    Route::delete('/penitip/delete/authenticated/{id}', [PenitipController::class, 'destroy'])->name('penitip.delete.authenticated');

    // Organisasi
    Route::get('/organisasi/authenticated', [OrganisasiController::class, 'index'])->name('organisasi.index.authenticated');
    Route::get('/organisasi/authenticated/{id}', [OrganisasiController::class, 'show'])->name('organisasi.show.authenticated');
    Route::post('/organisasi/create/authenticated', [OrganisasiController::class, 'store'])->name('organisasi.create.authenticated');
    Route::put('/organisasi/update/authenticated/{id}', [OrganisasiController::class, 'update'])->name('organisasi.update.authenticated');
    Route::delete('/organisasi/delete/authenticated/{id}', [OrganisasiController::class, 'destroy'])->name('organisasi.delete.authenticated');
});

// =====================
// ROUTES PUBLIC (CRUD LAINNYA)
// =====================

Route::get('/alamat', [AlamatController::class, 'index'])->name('alamat.index');
Route::get('/alamat/{id}', [AlamatController::class, 'show'])->name('alamat.show');
Route::post('/alamat/create', [AlamatController::class, 'store'])->name('alamat.store');
Route::put('/alamat/update/{id}', [AlamatController::class, 'update'])->name('alamat.update');
Route::delete('/alamat/delete/{id}', [AlamatController::class, 'destroy'])->name('alamat.destroy');

Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/{id}', [BarangController::class, 'show'])->name('barang.show');
Route::post('/barang/create', [BarangController::class, 'store'])->name('barang.store');
Route::put('/barang/update/{id}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/barang/delete/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

Route::get('/diskusi', [DiskusiController::class, 'index'])->name('diskusi.index');
Route::get('/diskusi/{id}', [DiskusiController::class, 'show'])->name('diskusi.show');
Route::post('/diskusi/create', [DiskusiController::class, 'store'])->name('diskusi.store');
Route::put('/diskusi/update/{id}', [DiskusiController::class, 'update'])->name('diskusi.update');
Route::delete('/diskusi/delete/{id}', [DiskusiController::class, 'destroy'])->name('diskusi.destroy');

Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');
Route::get('/donasi/{id}', [DonasiController::class, 'show'])->name('donasi.show');
Route::post('/donasi/create', [DonasiController::class, 'store'])->name('donasi.store');
Route::put('/donasi/update/{id}', [DonasiController::class, 'update'])->name('donasi.update');
Route::delete('/donasi/delete/{id}', [DonasiController::class, 'destroy'])->name('donasi.destroy');

Route::get('/jabatan', [JabatanController::class, 'index'])->name('jabatan.index');
Route::get('/jabatan/{id}', [JabatanController::class, 'show'])->name('jabatan.show');
Route::post('/jabatan/create', [JabatanController::class, 'store'])->name('jabatan.store');
Route::put('/jabatan/update/{id}', [JabatanController::class, 'update'])->name('jabatan.update');
Route::delete('/jabatan/delete/{id}', [JabatanController::class, 'destroy'])->name('jabatan.destroy');

Route::get('/komisi', [KomisiController::class, 'index'])->name('komisi.index');
Route::get('/komisi/{id}', [KomisiController::class, 'show'])->name('komisi.show');
Route::post('/komisi/create', [KomisiController::class, 'store'])->name('komisi.store');
Route::put('/komisi/update/{id}', [KomisiController::class, 'update'])->name('komisi.update');
Route::delete('/komisi/delete/{id}', [KomisiController::class, 'destroy'])->name('komisi.destroy');

Route::get('/merchandise', [MerchandiseController::class, 'index'])->name('merchandise.index');
Route::get('/merchandise/{id}', [MerchandiseController::class, 'show'])->name('merchandise.show');
Route::post('/merchandise/create', [MerchandiseController::class, 'store'])->name('merchandise.store');
Route::put('/merchandise/update/{id}', [MerchandiseController::class, 'update'])->name('merchandise.update');
Route::delete('/merchandise/delete/{id}', [MerchandiseController::class, 'destroy'])->name('merchandise.destroy');

Route::get('/penukaran', [PenukaranController::class, 'index'])->name('penukaran.index');
Route::get('/penukaran/{id}', [PenukaranController::class, 'show'])->name('penukaran.show');
Route::post('/penukaran/create', [PenukaranController::class, 'store'])->name('penukaran.store');
Route::put('/penukaran/update/{id}', [PenukaranController::class, 'update'])->name('penukaran.update');
Route::delete('/penukaran/delete/{id}', [PenukaranController::class, 'destroy'])->name('penukaran.destroy');

Route::get('/reqDonasi', [ReqDonasiController::class, 'index'])->name('reqDonasi.index');
Route::get('/reqDonasi/{id}', [ReqDonasiController::class, 'show'])->name('reqDonasi.show');
Route::post('/reqDonasi/create', [ReqDonasiController::class, 'store'])->name('reqDonasi.store');
Route::put('/reqDonasi/update/{id}', [ReqDonasiController::class, 'update'])->name('reqDonasi.update');
Route::delete('/reqDonasi/delete/{id}', [ReqDonasiController::class, 'destroy'])->name('reqDonasi.destroy');
