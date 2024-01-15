<?php

use Illuminate\Support\Facades\Route;

Route::get('/view', function () {
    return view('view');
});
Route::get('/update', function () {
    return view('update');
});

Route::get('/index', function () {
    return view('index');
});
Route::get('/', function () {
    return view('index');
});
