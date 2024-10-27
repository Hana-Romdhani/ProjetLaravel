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
        $plants = Plantes::paginate(10);
        $categories = CategoriePlante::paginate(10); // 10 categories per page

        // Make sure to pass both plants and categories to the view
        return view('frontend.plant.index', compact('plants', 'categories'));
    }

    public function show($id)
    {
        // Retrieve plant by ID or return a 404 if not found
        $plant = Plantes::findOrFail($id);

        // Return the view with plant data
        return view('frontend.plant.show', compact('plant'));
    }

    public function filterByCategory($slug)
    {
        $category = CategoriePlante::where('slug', $slug)->first();
        if (!$category) {
            return response()->json([]);
        }

        $plants = $category->plants()->with('category')->get(); // Remove paginate to simplify data format

        return response()->json($plants);
    }

}
