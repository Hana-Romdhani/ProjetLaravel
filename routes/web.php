<?php

use App\Http\Controllers\backend\backendController;
use App\Http\Controllers\frontend\frontendController;
use App\Http\Controllers\backend\JardinController;
use App\Http\Controllers\backend\RessourcesController;
use App\Http\Controllers\frontend\RessourceController;

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
    Route::get('/user-workspace', function () {
        return view('frontend.ressources.RessourcesForm');

    });
    Route::get('/ressource/create',  [RessourceController::class, 'create',])->name('frontend.ressources.RessourcesForm.create');
    Route::get('/ressource/{ressource}/edit', [RessourceController::class, 'edit'])->name('frontend.ressources.RessourcesForm.edit');
    Route::put('/ressource/{ressource}', [RessourceController::class, 'update'])->name('ressource.update');


});

//admin part
Route::prefix('/admin')->group(function () {
    Route::get('/',  [backendController::class, 'index']);

    Route::get('/edit-profile', function () {
        return view('backend.pages.profileAdmin');
    });

    Route::get('/jardin',  [JardinController::class, 'index'])->name('backend.jardin.jardin');

    // Display the form to create a new jardin
    Route::get('/jardin/create',  [JardinController::class, 'create',])->name('admin.jardin.create');
    // Handle form submission for creating a new jardin
    Route::post('/jardin', [JardinController::class, 'store'])->name('backend.jardin.formJardin');

    // Display the form to edit an existing jardin
    Route::get('/jardin/{jardin}/edit', [JardinController::class, 'edit'])->name('admin.jardin.edit');
    // Handle form submission for updating an existing jardin
    Route::put('/jardin/{jardin}', [JardinController::class, 'update'])->name('jardin.update');

    // Handle deletion of a jardin
    Route::delete('/jardin/{jardin}', [JardinController::class, 'destroy'])->name('jardin.destroy');



    Route::get('/ressource',  [RessourcesController::class, 'index'])->name('backend.ressource.ressource');

    // Handle form submission for creating a new jardin
    Route::post('/ressource', [RessourceController::class, 'store'])->name('frontend.ressources.RessourcesForm');
    // Route::get('/ressource',  [RessourceController::class, 'index'])->name('frontend.ressources.RessourcesForm');


    // Route::get('/ressource/{ressource}/edit', [RessourceController::class, 'edit'])->name('admin.ressource.edit');

    // Route::put('/ressource/{ressource}', [RessourceController::class, 'update'])->name('RessourcesForm.update');



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
