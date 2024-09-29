<?php

use App\Http\Controllers\backend\backendController;
use App\Http\Controllers\frontend\frontendController;
use App\Http\Controllers\backend\JardinController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// home part
Route::prefix('/')->group(function () {
    Route::get('/',  [frontendController::class, 'index']);
    Route::get('/contact', function () {
        return view('frontend.pages.contact');
    });
});

//admin part
Route::prefix('/admin')->group(function () {
    Route::get('/',  [backendController::class, 'index']);

    Route::get('/edit-profile', function () {
        return view('backend.pages.profileAdmin');
    });

    Route::get('/jardin',  [JardinController::class, 'index']);
    Route::get('/jardin/edit',  [JardinController::class, 'store',])->name('backend.jardin.formJardin');
    // Route::resource('/jardin/edit',  JardinController::class);



});
//auth part
Route::prefix('auth')->group(function () {
    Route::get('/signin', function () {
        return view('auth.pages.Signin');
    });

    Route::get('/signup', function () {
        return view('auth.pages.Signup');
    });

    Route::get('/forgot-password', function () {
        return view('auth.pages.ForgotPassword');
    });
    Route::get('/edit-profile', function () {
        return view('auth.pages.profile');
    });
});


