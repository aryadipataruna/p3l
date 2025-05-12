<?php

use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PenitipController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DiskusiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KomisiController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenukaranController;
use App\Http\Controllers\ReqDonasiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/pembeli/register', [PembeliController::class, 'store'])->name('pembeli.store');
Route::post('/pembeli/login', [PembeliController::class, 'login'])->name('pembeli.login');
Route::post('/penitip/register', [PenitipController::class, 'store'])->name('penitip.store');
Route::post('/penitip/login', [PenitipController::class, 'login'])->name('penitip.login');
Route::post('/pegawai/register', [PegawaiController::class, 'store'])->name('pegawai.store');
Route::post('/pegawai/login', [PegawaiController::class, 'login'])->name('pegawai.login');
Route::post('/organisasi/register', [OrganisasiController::class, 'store'])->name('organisasi.store');
Route::post('/organisasi/login', [OrganisasiController::class, 'login'])->name('organisasi.login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::get('/pegawai/{id}', [PegawaiController::class, 'show'])->name('pegawai.show');
    Route::post('/pegawai/create', [PegawaiController::class, 'store'])->name('pegawai.store');
    Route::put('/pegawai/update/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('/pegawai/delete/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');
    Route::post('pegawai/logout', [PegawaiController::class, 'logout'])->name('pegawai.logout');

    Route::get('/pembeli', [PembeliController::class, 'index'])->name('pembeli.index');
    Route::get('/pembeli/{id}', [PembeliController::class, 'show'])->name('pembeli.show');
    Route::post('/pembeli/create', [PembeliController::class, 'store'])->name('pembeli.store');
    Route::put('/pembeli/update/{id}', [PembeliController::class, 'update'])->name('pembeli.update');
    Route::delete('/pembeli/delete/{id}', [PembeliController::class, 'destroy'])->name('pembeli.destroy');
    Route::post('pembeli/logout', [PembeliController::class, 'logout'])->name('pembeli.logout');

    Route::get('/penitip', [PenitipController::class, 'index'])->name('penitip.index');
    Route::get('/penitip/{id}', [PenitipController::class, 'show'])->name('penitip.show');
    Route::post('/penitip/create', [PenitipController::class, 'store'])->name('penitip.store');
    Route::put('/penitip/update/{id}', [PenitipController::class, 'update'])->name('penitip.update');
    Route::delete('/penitip/delete/{id}', [PenitipController::class, 'destroy'])->name('penitip.destroy');
    Route::post('penitip/logout', [PenitipController::class, 'logout'])->name('penitip.logout');

    Route::get('/organisasi', [OrganisasiController::class, 'index'])->name('organisasi.index');
    Route::get('/organisasi/{id}', [OrganisasiController::class, 'show'])->name('organisasi.show');
    Route::post('/organisasi/create', [OrganisasiController::class, 'store'])->name('organisasi.store');
    Route::put('/organisasi/update/{id}', [OrganisasiController::class, 'update'])->name('organisasi.update');
    Route::delete('/organisasi/delete/{id}', [OrganisasiController::class, 'destroy'])->name('organisasi.destroy');
    Route::post('organisasi/logout', [OrganisasiController::class, 'logout'])->name('organisasi.logout');
});

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
