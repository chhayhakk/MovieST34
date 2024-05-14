<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.register');
});
Route::get('/index', function () {
    return view('auth.index');
});


Route::get('/profile', function(){
    return "Welcome....";
})->middleware(['auth', 'verified']);


