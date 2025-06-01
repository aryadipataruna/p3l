<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('homePage');
})->name('home');

Route::match(['GET', 'POST'], '/login-regis', function () {
    return view('loginRegister');
})->name('login-regis');

Route::post('/register', [RegistrationHandleController::class, 'handleRegistration'])->name('handle.registration');

Route::get('/adminPageMerchandise', function () {
    return view('admin.adminPageMerchandise');
})->name('adminPageMerchandise');

Route::get('/adminPagePegawai', function () {
    return view('admin.adminPagePegawai');
})->name('adminPagePegawai');

Route::get('/adminPageOrganisasi', function () {
    return view('admin.adminPageOrganisasi');
})->name('adminPageOrganisasi');

// Route::get('/detailBarang/{id}', function ($id) {
//     return view('detailBarangPage', ['id' => $id]);
// })->name('detailBarang');

Route::get('/cartPembeli', function () {
    return view('cart');
})->name('cartPembeli');

Route::get('/detailBarang', function () {
    return view('detailBarangPage');
})->name('detailBarang');

Route::get('/cartPembeli/detailPemesanan', function () {
    return view('detailPemesanan');
})->name('order');

Route::get('/cartPembeli/detailPemesanan/nota', function () {
    return view('nota');
})->name('nota');
