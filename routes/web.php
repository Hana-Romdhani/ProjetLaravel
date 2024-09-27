<?php

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


//admin home
Route::prefix('/')->group(function () {
    Route::get('/', function () {
        return view('landingPage.home');
    });
    Route::get('/contact', function () {
        return view('landingPage.contact');
    });


});

//admin part
Route::prefix('/admin')->group(function () {
    Route::get('/', function () {
        return view('dashbored.dashbored');
    });
    Route::get('/edit-profile', function () {
        return view('dashbored.profileadmin');
    });

});
//auth part
Route::prefix('auth')->group(function () {
    Route::get('/signin', function () {
        return view('auth.Signin');
    });

    Route::get('/signup', function () {
        return view('auth.Signup');
    });

    Route::get('/forgot-password', function () {
        return view('auth.ForgotPassword');
    });
    Route::get('/edit-profile', function () {
        return view('auth.profile');
    });
});


