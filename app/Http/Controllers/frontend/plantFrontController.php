<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\CategoriePlante;
use App\Models\Plantes;

class PlantFrontController extends Controller
{
    // Display a list of plants
    public function index()
    {
        $plants = Plantes::paginate(10); // 10 plants per page
        $categories = CategoriePlante::paginate(10); // 10 categories per page

        // Make sure to pass both plants and categories to the view
        return view('frontend.plant.index', compact('plants', 'categories'));
    }
}
