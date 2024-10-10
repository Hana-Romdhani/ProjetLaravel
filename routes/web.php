<?php

use App\Http\Controllers\backend\backendController;
use App\Http\Controllers\backend\conseil\ConseilCategorieController;
use App\Http\Controllers\backend\conseil\ConseilController;
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
    Route::get('/user-workspace', function () {
        return view('frontend.ressources.RessourcesForm');
    });
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

//conseil part
    Route::middleware('web')->prefix('/')->group(function () {
        Route::resource('/conseil-categorie', ConseilCategorieController::class);
        Route::resource('/conseil', ConseilController::class);
    });
//conseil part

// Handle deletion of a jardin
Route::delete('/jardin/{jardin}', [JardinController::class, 'destroy'])->name('jardin.destroy');
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
