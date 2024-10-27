<?php

use App\Http\Controllers\backend\backendController;
use App\Http\Controllers\backend\conseil\ConseilCategorieController;
use App\Http\Controllers\backend\conseil\ConseilController;
use App\Http\Controllers\frontend\frontendController;
use App\Http\Controllers\backend\JardinController;
use App\Http\Controllers\backend\EvenementController;
use App\Http\Controllers\backend\ClassificationController;
use App\Http\Controllers\frontend\EvenementFrontController;
use App\Http\Controllers\frontend\PlantFrontController;
use App\Http\Controllers\backend\PlantController;
use App\Http\Controllers\backend\CategoryPlanteController;
use App\Models\CategoriePlante;
use App\Http\Controllers\backend\RessourcesController;
use App\Http\Controllers\frontend\RessourceController;
use App\Http\Controllers\frontend\JardinsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\shared\UserController;


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

// ******************************** User **********************************
//auth part

Route::prefix('auth')->group(function () {
    Route::get('/signin', function () {
        return view('auth.pages.Signin');  // Your custom sign-in view
    })->name('login');  // This will use Laravel's built-in login route

    // Handle login form submission (POST request)
    Route::post('/signin', [UserController::class, 'authenticate'])->name('login.store');  // POST route to handle login


    Route::get('/register', function () {
        return view('auth.pages.Signup');  // Your custom sign-up view
    })->name('register');  // This will use Laravel's built-in register route

    // Handle the registration form submission (POST request)
    Route::post('/register', [UserController::class, 'store'])->name('register.store'); // POST route to handle registration


    Route::get('/forgot-password', function () {
        return view('auth.pages.ForgotPassword');  // Your custom forgot-password view
    })->name('password.request');  // This will use Laravel's built-in password reset route

    Route::get('/edit-profile', function () {
        return view('auth.pages.profile');  // Custom profile view
    })->middleware('auth');  // Protect profile page with 'auth' middleware

    Route::resource('users', UserController::class);

    Route::post('/auth/logout', [UserController::class, 'logout'])->name('logout');
});


// ******************************** Home **********************************
Route::prefix('/')->group(function () {
    Route::get('/',  [frontendController::class, 'index']);
    Route::get('/contact', function () {
        return view('frontend.pages.contact');
    });
    Route::get('/user-workspace', function () {
        return view('frontend.ressources.RessourcesForm');
    });
    // ********************************plants**********************************
    // Route::get('/plantsss', [plantFrontController::class, 'index'])->name('frontend.plant.index');
    Route::get('/plants',  [PlantFrontController::class, 'index']);
    // Display a specific plant by ID
    Route::get('/plant/{id}', [PlantFrontController::class, 'show'])->name('frontend.plant.show');

    Route::get('/plants/filter/{slug}', [PlantFrontController::class, 'filterByCategory'])->name('plants.filter');

    Route::get('/wishlist', function () {
        return view('frontend.plant.wishlist');
    })->name('wishlist');
    Route::get('/ressource/create',  [RessourceController::class, 'create',])->name('frontend.ressources.RessourcesForm.create');
    Route::get('/ressource/{ressource}/edit', [RessourceController::class, 'edit'])->name('frontend.ressources.RessourcesForm.edit');
    Route::put('/ressource/{ressource}', [RessourceController::class, 'update'])->name('ressource.update');
    Route::delete('/ressource/{ressource}', [RessourceController::class, 'destroy'])->name('Ressources.destroy');
    // Route::get('/ressourceUser', function () {
    //     return view('frontend.ressources.Ressources');
    // });
    Route::get('/ressourceUser',  [RessourceController::class, 'index'])->name('frontend.ressources.Ressources');
    Route::get('/ressourcesList',  [RessourceController::class, 'show'])->name('frontend.ressources.RessourcesList');
    Route::get('/jardins',  [JardinsController::class, 'index'])->name('frontend.jardin.jardin');
});

// ***********************************************************************
// ********************************admin**********************************
// ***********************************************************************

//admin part
Route::prefix('/admin')->middleware(['auth'])->group(function () {

    Route::get('/',  [backendController::class, 'index']);

    Route::get('/edit-profile', function () {
        return view('backend.pages.profileAdmin');
    });

    // ********************************jardin**********************************

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

    // ********************************conseil**********************************
    // ********************************plants**********************************
    // Display a list of plants
    Route::get('/plant', [PlantController::class, 'index'])->name('backend.plant.index');

    // Display the form to create a new plant
    Route::get('/plant/create', [PlantController::class, 'create'])->name('backend.plant.create');
    // Store the new plant
    Route::post('/plant', [PlantController::class, 'store'])->name('backend.plant.store');

    // Display the form to edit an existing plant
    Route::get('/plant/{plante}/edit', [PlantController::class, 'edit'])->name('backend.plant.edit');

    // Update the existing plant
    Route::put('/plant/{plante}', [PlantController::class, 'update'])->name('backend.plant.update');

    // Delete the plant
    Route::delete('/plant/{plante}', [PlantController::class, 'destroy'])->name('backend.plant.destroy');

    // ********************************categoriesPlante **********************************
    // Display a list of categories
    Route::get('/category', [CategoryPlanteController::class, 'index'])->name('backend.categoriePlante.index');

    // Display the form to create a new category
    Route::get('/category/create', [CategoryPlanteController::class, 'create'])->name('backend.categoriePlante.create');

    // Store the new category
    Route::post('/category', [CategoryPlanteController::class, 'store'])->name('backend.categoriePlante.store');

    // Display the form to edit an existing category
    Route::get('/category/{category}/edit', [CategoryPlanteController::class, 'edit'])->name('backend.categoriePlante.edit');

    // Update the existing category
    Route::put('/category/{category}', [CategoryPlanteController::class, 'update'])->name('backend.categoriePlante.update');

    // Delete the category
    Route::delete('/category/{category}', [CategoryPlanteController::class, 'destroy'])->name('backend.categoriePlante.destroy');


    Route::get('/ressource',  [RessourcesController::class, 'index'])->name('backend.ressource.ressource');

    // Handle form submission for creating a new jardin
    Route::post('/ressource', [RessourceController::class, 'store'])->name('frontend.ressources.RessourcesForm');
    // Route::get('/ressource',  [RessourceController::class, 'index'])->name('frontend.ressources.RessourcesForm');


    // Route::get('/ressource/{ressource}/edit', [RessourceController::class, 'edit'])->name('admin.ressource.edit');

    // Route::put('/ressource/{ressource}', [RessourceController::class, 'update'])->name('RessourcesForm.update');




});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
