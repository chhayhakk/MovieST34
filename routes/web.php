<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\IsAdmin;
Route::get('/', function () {
    return view('auth.register');
});
// Route::get('/index', function () {
//     return view('auth.main');
// });

Route::middleware(['auth','verified'])->group(function(){
    Route::get('/index', function(){
        return view('auth.index');
    });
});

// Route::middleware(['auth'.'verified', IsAdmin::class])->group(function(){
//     Route::get('/index', function(){
//         return view('auth.index');
//     });
// });



