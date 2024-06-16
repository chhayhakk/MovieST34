<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('auth.register');
});
// This is for user
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user', function () {
        //This is for user interface
        return view('auth.user');
    });
    Route::get('/profile', function(){
        return view('auth.profile');
    })->name('profile');
    Route::post('/profile/upload-avatar', [UserController::class, 'storeimage'])->name('upload-avatar');
    Route::post('/profile', [UserController::class, 'updateprofile'])->name('upload-profile');
    Route::post('/profile/update-passowrd', [UserController::class, 'updatepassword'])->name('update-password');
    
    
});

Route::middleware(['auth', 'verified', IsAdmin::class])->group(function () {
    Route::get('/admin', function () {
        //This is for admin interface
        return view('auth.index');
    });
});









// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/user', function () {
//        //Check if admin
//         if (Auth::user()->is_admin) {
//             return redirect('/admin');
//         }
//         // If not an admin, display the user interface
//         return view('auth.user');
//     });

//     // Route for admin interface
//     Route::get('/admin', function () {
//         // Ensure the user is an admin
//         if (Auth::user()->is_admin) {
//             return view('auth.index');
//         }
//         // If not an admin, redirect to user interface
//         return abort(401);
//        // return redirect('/user');
//     });

//     //Default Route After Login
//     // Route::get('/', function () {
//     //    // check if it is admin
//     //     if (Auth::user()->is_admin) {
//     //         return redirect('/admin');
//     //     }
//     //     // If not an admin, redirect to user interface
//     //     return redirect('/user');
//     // });
// });





