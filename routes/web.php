<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\IsAdmin;

Route::get('/', function () {
    return view('auth.register');
});
// This is for user
// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/user', function () {
//         //This is for admin interface
//         if(Auth::user()->is_admin){
//             return view('auth.index');
//         }
//         //This is for user interface
//         return view('auth.user');
//     });
// });
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user', function () {
       //Check if admin
        if (Auth::user()->is_admin) {
            return redirect('/admin');
        }
        // If not an admin, display the user interface
        return view('auth.user');
    });

    // Route for admin interface
    Route::get('/admin', function () {
        // Ensure the user is an admin
        if (Auth::user()->is_admin) {
            return view('auth.index');
        }
        // If not an admin, redirect to user interface
        return abort(401);
       // return redirect('/user');
    });

    //Default Route After Login
    Route::get('/', function () {
       // check if it is admin
        if (Auth::user()->is_admin) {
            return redirect('/admin');
        }
        // If not an admin, redirect to user interface
        return redirect('/user');
    });
});





