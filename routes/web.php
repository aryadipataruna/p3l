<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('homePage');
});

Route::get('/login-regis', function () {
    return view('loginRegister');
});