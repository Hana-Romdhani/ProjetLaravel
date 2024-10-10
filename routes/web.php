<?php

use App\Http\Controllers\backend\backendController;
use App\Http\Controllers\backend\conseil\ConseilCategorieController;
use App\Http\Controllers\backend\conseil\ConseilController;
use App\Http\Controllers\frontend\frontendController;
use App\Http\Controllers\backend\JardinController;
use App\Http\Controllers\backend\EvenementController;
use App\Http\Controllers\backend\ClassificationController;
use App\Http\Controllers\frontend\EvenementFrontController;


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
   // Route::get('/jardin',  [JardinController::class, 'index']);
   // Route::get('/jardin/edit',  [JardinController::class, 'edit'])->name('backend.jardin.formJardin');
    // Route::resource('/jardin/edit',  JardinController::class);

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
    Route::get('/evenement',  [EvenementController::class, 'index'])->name('backend.evenement.index');
    Route::get('/evenement/create', [EvenementController::class, 'create'])->name('backend.evenement.create'); // Route pour le formulaire de création
    Route::post('/evenement', [EvenementController::class, 'store'])->name('backend.evenement.store'); // Route pour stocker l'événement
    Route::get('/evenement/edit/{id}', [EvenementController::class, 'edit'])->name('backend.evenement.edit'); // Route pour l'édition

    Route::put('/evenement/{id}', [EvenementController::class, 'update'])->name('backend.evenement.update');    // Route pour mettre à jour l'événement

    Route::delete('/evenement/{id}', [EvenementController::class, 'destroy'])->name('backend.evenement.destroy');


    //Classification
    Route::get('/classification',  [ClassificationController::class, 'index'])->name('backend.classification.index');
    Route::get('/classification/create', [ClassificationController::class, 'create'])->name('backend.classification.create'); // Route pour le formulaire de création
    Route::post('/classification', [ClassificationController::class, 'store'])->name('backend.classification.store'); // Route pour stocker l'événement
    Route::get('/classification/edit/{id}', [ClassificationController::class, 'edit'])->name('backend.classification.edit'); // Route pour l'édition

    Route::put('/classification/{id}', [ClassificationController::class, 'update'])->name('backend.classification.update');    // Route pour mettre à jour l'événement

    Route::delete('/classification/{id}', [ClassificationController::class, 'destroy'])->name('backend.classification.destroy');



    //frontEvent
    //Route::get('/evenementsfront', [EvenementFrontController::class, 'index'])->name('frontend.evenement.index');
    //Route::get('/evenements/{id}', [EvenementFrontController::class, 'show'])->name('frontend.evenement.show');

    // Routes pour les événements dans le front-end
Route::prefix('front')->group(function () {
    Route::get('/',  [frontendController::class, 'index']);
    Route::get('/contact', function () {
        return view('frontend.pages.contact');
    });

    Route::get('/evenement', action: [EvenementFrontController::class, 'index'])->name('frontend.evenement.index');
});

    //Route::get('/evenement/edit',  [EvenementController::class, 'edit'])->name('backend.evenement.formEvenement');
    //Route::get('/evenement/edit/{id}', [EvenementController::class, 'edit'])->name('backend.evenement.formEvenement');


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
