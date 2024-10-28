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
use App\Http\Controllers\backend\PlantationController;
use App\Http\Controllers\backend\CategoryPlanteController;
use App\Models\CategoriePlante;
use App\Http\Controllers\backend\RessourcesController;
use App\Http\Controllers\backend\RessourcesPartagesController;
use App\Http\Controllers\frontend\RessourceController;
use App\Http\Controllers\frontend\RessourcesPartageController;
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


// ******************************** mettre toute les urls de front ici  **********************************
Route::prefix('/')->group(function () {
    Route::get('/',  [frontendController::class, 'index'])->name('home');
    Route::get('/contact', function () {
        return view('frontend.pages.contact');
    });
    Route::get('/user-workspace', function () {
        return view('frontend.ressources.RessourcesForm');
    });
    // ********************************plants**********************************
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

    Route::get('/ressourceUser',  [RessourceController::class, 'index'])->name('frontend.ressources.Ressources');
    Route::get('/ressourcesPartage',  [RessourcesPartageController::class, 'index'])->name('frontend.ressources.RessourcesPartage');
    Route::post('/ressources-partages/{id}/accepter', [RessourcesPartageController::class, 'accepter'])->name('frontend.ressources.RessourcesPartage.accepter');
    Route::post('/ressources/{ressource}/quantite-restante', [RessourcesPartageController::class, 'getQuantiteRestante'])->name('frontend.ressources.RessourcesPartage.getQuantiteRestante');;
    Route::post('/ressources-partages/{id}/refuser', [RessourcesPartageController::class, 'refuser'])->name('frontend.ressources.RessourcesPartage.refuser');
    Route::post('/ressources-partages/demande', [RessourcesPartageController::class, 'store'])->name('frontend.ressources.RessourcesPartage.store');

    Route::get('/ressourcesList',  [RessourceController::class, 'show'])->name('frontend.ressources.RessourcesList');
    Route::get('/jardins',  [JardinsController::class, 'index'])->name('frontend.jardin.jardin');
    // ********************************conseil**********************************

    Route::get('/conseil', action: [ConseilController::class, 'indexfront'])->name('frontend.conseil.index');
    Route::get('/conseil/{id}', [ConseilController::class, 'showfront'])->name('frontend.conseil.details');
    Route::post('/conseils/{id}/rate', [ConseilController::class, 'rate'])->name('conseils.rate');
    Route::get('/profiljardinier', [ConseilController::class, 'jardinierfront'])->name('frontend.conseil.profiljardinier');
    Route::get('/evenement', action: [EvenementFrontController::class, 'index'])->name('frontend.evenement.index');

});

    // ***********************************************************************
    // ********************************admin**********************************
    // ***********************************************************************
//jardinier part
Route::prefix('/jardinier')->middleware(['auth'])->group(function () {
    Route::get('/agenda', [PlantationController::class, 'agenda'])->middleware('auth')->name('backend.plantation.agenda');

});

//admin part
Route::prefix('/admin')->middleware(['auth', 'role:admin,editor'])->group(function () {

    Route::get('/',  [backendController::class, 'index']);

    Route::get('/edit-profile', function () {
        return view('backend.pages.profileAdmin');
    });

    // ********************************jardin**********************************

    Route::get('/jardin',  [JardinController::class, 'index'])->name('backend.jardin.jardin');
    Route::get('/plantation',  [PlantationController::class, 'index'])->name('backend.plantation.plantation');

    // Display the form to create a new jardin
    Route::get('/jardin/create',  [JardinController::class, 'create',])->name('admin.jardin.create');
    Route::get('/plantation/create',  [PlantationController::class, 'create',])->name('admin.plantation.create');
    // Handle form submission for creating a new jardin
    Route::post('/jardin', [JardinController::class, 'store'])->name('backend.jardin.formJardin');
    Route::post('/plantation', [PlantationController::class, 'store'])->name('backend.plantation.formPlantation');

    // Route::get('/jardin',  [JardinController::class, 'index']);
    // Route::get('/jardin/edit',  [JardinController::class, 'edit'])->name('backend.jardin.formJardin');
    // Route::resource('/jardin/edit',  JardinController::class);

    Route::get('/jardin/{jardin}/edit', [JardinController::class, 'edit'])->name('admin.jardin.edit');
    Route::put('/jardin/{jardin}', [JardinController::class, 'update'])->name('jardin.update');
    Route::delete('/jardin/{jardin}', [JardinController::class, 'destroy'])->name('jardin.destroy');
    // ********************************conseil**********************************
    Route::get('/plantation/{plantation}/edit', [PlantationController::class, 'edit'])->name('admin.plantation.edit');
    // Handle form submission for updating an existing jardin
    Route::put('/plantation/{plantation}', [PlantationController::class, 'update'])->name('plantation.update');

    //conseil part
    Route::middleware('web')->prefix('/')->group(function () {
        Route::resource('/conseil-categorie', ConseilCategorieController::class);
        Route::resource('/conseil', ConseilController::class);
        Route::get('/conseil/category/{id}', action: [ConseilController::class, 'categoryShow'])->name('conseil.categoryShow');

    });
    //conseil part
    Route::get('/evenement',  [EvenementController::class, 'index'])->name('backend.evenement.index');
    Route::get('/evenement/create', [EvenementController::class, 'create'])->name('backend.evenement.create'); // Route pour le formulaire de création
    Route::post('/evenement', [EvenementController::class, 'store'])->name('backend.evenement.store'); // Route pour stocker l'événement
    Route::get('/evenement/edit/{id}', [EvenementController::class, 'edit'])->name('backend.evenement.edit'); // Route pour l'édition

    Route::put('/evenement/{id}', [EvenementController::class, 'update'])->name('backend.evenement.update');    // Route pour mettre à jour l'événement

    Route::delete('/evenement/{id}', [EvenementController::class, 'destroy'])->name('backend.evenement.destroy');
    Route::get('/export-evenements', [EvenementController::class, 'export'])->name('backend.evenement.export');


    //Classification
    Route::get('/classification',  [ClassificationController::class, 'index'])->name('backend.classification.index');
    Route::get('/classification/create', [ClassificationController::class, 'create'])->name('backend.classification.create'); // Route pour le formulaire de création
    Route::post('/classification', [ClassificationController::class, 'store'])->name('backend.classification.store'); // Route pour stocker l'événement
    Route::get('/classification/edit/{id}', [ClassificationController::class, 'edit'])->name('backend.classification.edit'); // Route pour l'édition

    Route::put('/classification/{id}', [ClassificationController::class, 'update'])->name('backend.classification.update');    // Route pour mettre à jour l'événement

    Route::delete('/classification/{id}', [ClassificationController::class, 'destroy'])->name('backend.classification.destroy');


    //Route::get('/evenement/edit',  [EvenementController::class, 'edit'])->name('backend.evenement.formEvenement');
    //Route::get('/evenement/edit/{id}', [EvenementController::class, 'edit'])->name('backend.evenement.formEvenement');

    // Handle deletion of a jardin
    Route::delete('/jardin/{jardin}', [JardinController::class, 'destroy'])->name('jardin.destroy');
    Route::delete('/plantation/{plantation}', [PlantationController::class, 'destroy'])->name('plantation.destroy');

    // ********************************conseil**********************************
    // ********************************plants**********************************
    // Display a list of plants
    Route::get('/plant', [PlantController::class, 'index'])->name('backend.plant.index');

    Route::get('/plant/create', [PlantController::class, 'create'])->name('backend.plant.create');
    Route::post('/plant', [PlantController::class, 'store'])->name('backend.plant.store');

    Route::get('/plant/{plante}/edit', [PlantController::class, 'edit'])->name('backend.plant.edit');

    Route::put('/plant/{plante}', [PlantController::class, 'update'])->name('backend.plant.update');

    Route::delete('/plant/{plante}', [PlantController::class, 'destroy'])->name('backend.plant.destroy');

    // ********************************categoriesPlante **********************************
    Route::get('/category', [CategoryPlanteController::class, 'index'])->name('backend.categoriePlante.index');

    Route::get('/category/create', [CategoryPlanteController::class, 'create'])->name('backend.categoriePlante.create');

    Route::post('/category', [CategoryPlanteController::class, 'store'])->name('backend.categoriePlante.store');

    Route::get('/category/{category}/edit', [CategoryPlanteController::class, 'edit'])->name('backend.categoriePlante.edit');

    Route::put('/category/{category}', [CategoryPlanteController::class, 'update'])->name('backend.categoriePlante.update');

    Route::delete('/category/{category}', [CategoryPlanteController::class, 'destroy'])->name('backend.categoriePlante.destroy');

        // ********************************ressource  **********************************

    Route::get('/ressource',  [RessourcesController::class, 'index'])->name('backend.ressource.ressource');
    Route::get('/ressourcespartage',  [RessourcesPartagesController::class, 'index'])->name('backend.ressource.ressourcesPartage');

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
