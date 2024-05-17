<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\IsAdmin;

Route::get('/', function () {
    return view('auth.register');
});
// This is for user
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user', function () {
        //This is for admin interface
        if(Auth::user()->is_admin){
            return view('auth.index');
        }
        //This is for user interface
        return view('auth.user');
    });
});





