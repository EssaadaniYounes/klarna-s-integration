<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/confirm', function () {
    return redirect('http://localhost:5173/products/2');
});