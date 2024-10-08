<?php

use App\Http\Controllers\backend\backendController;
use App\Http\Controllers\backend\conseil\ConseilCategorieController;
use App\Http\Controllers\frontend\frontendController;
use App\Http\Controllers\backend\JardinController;
use App\Http\Controllers\frontend\PlantFrontController;
use App\Http\Controllers\backend\PlantController;
use App\Http\Controllers\backend\CategoryPlanteController;
use App\Models\CategoriePlante;
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
});

//admin part
Route::prefix('/admin')->group(function () {

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

    // Display the form to edit an existing jardin
    Route::get('/jardin/{jardin}/edit', [JardinController::class, 'edit'])->name('admin.jardin.edit');
    // Handle form submission for updating an existing jardin
    Route::put('/jardin/{jardin}', [JardinController::class, 'update'])->name('jardin.update');

    // Handle deletion of a jardin
    Route::delete('/jardin/{jardin}', [JardinController::class, 'destroy'])->name('jardin.destroy');

    // ********************************conseil**********************************
    //conseil part
    Route::middleware('web')->prefix('/conseil')->group(function () {
        Route::resource('/categorie', ConseilCategorieController::class);
    });
    //conseil part

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
