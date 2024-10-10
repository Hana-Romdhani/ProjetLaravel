<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\CategoriePlante;
use Illuminate\Http\Request;
use App\Models\Plant; // Assuming Plant is the model
use App\Models\Plantes;
use Illuminate\Support\Facades\Storage;


class PlantController extends Controller
{
    // Display a list of plants
    public function index()
    {
        // $plants = Plantes::all();
        // return view('backend.plant.index', compact('plants'));
        // Fetch plants with pagination
        $plants = Plantes::paginate(10); // 10 plants per page
        return view('backend.plant.index', compact('plants'));
    }

    // Show the form to create a new plant
    public function create()
    {
        $categories = CategoriePlante::all();
        return view('backend.plant.formPlant', compact('categories'));
    }

    // Store the new plant in the database
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'nom_scientifique' => 'nullable|string|max:255',
            'famille' => 'nullable|string|max:255',
            'origine' => 'nullable|string|max:255',
            'categorie_plante_id' => 'required|exists:categorie_plantes,id',
            'description' => 'nullable|string',
            'image_url' => 'nullable|image|max:2048', // Max 2MB file size
            'type' => 'nullable|string|max:255',
            'exposition' => 'nullable|string|max:255',
            'arrosage' => 'nullable|string|max:255',
            'type_sol' => 'nullable|string|max:255',
            'periode_plantation' => 'nullable|string|max:255',
            'periode_floraison' => 'nullable|string|max:255',
            'hauteur_max' => 'nullable|numeric',
            'largeur_max' => 'nullable|numeric',
            'croissance' => 'nullable|string|max:255',
            'besoins_speciaux' => 'nullable|string',
            'utilisations' => 'nullable|string',
            'conseils_entretien' => 'nullable|string',
        ]);


        if ($request->hasFile('image_url')) {
            // Store the file in the public directory (you can move it to the desired location if necessary)
            $file = $request->file('image_url');
            $filename = $file->getClientOriginalName(); // Get the original filename
            $file->move(public_path('assets/images/course'), $filename); // Move the file to the desired directory
            $validatedData['image_url'] = $filename; // Store only the filename in the database
        }


        // Plantes::create($request->all());
        Plantes::create($validatedData);


        return redirect()->route('backend.plant.index')->with('success', 'Plant added successfully!');
    }


    // Show the form to edit an existing plant
    public function edit(Plantes $plante)
    {
        $categories = CategoriePlante::all(); // Fetch categories
        return view('backend.plant.formPlant', compact('plante', 'categories')); // Pass plant and categories to the view
    }


    // Update the plant
    public function update(Request $request, Plantes $plante)
    {
        // Validate the input
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'nom_scientifique' => 'nullable|string|max:255',
            'famille' => 'nullable|string|max:255',
            'origine' => 'nullable|string|max:255',
            'categorie_plante_id' => 'required|exists:categorie_plantes,id',
            'description' => 'nullable|string',
            'image_url' => 'nullable|image|max:2048', // Max 2MB file size
            'type' => 'nullable|string|max:255',
            'exposition' => 'nullable|string|max:255',
            'arrosage' => 'nullable|string|max:255',
            'type_sol' => 'nullable|string|max:255',
            'periode_plantation' => 'nullable|string|max:255',
            'periode_floraison' => 'nullable|string|max:255',
            'hauteur_max' => 'nullable|numeric',
            'largeur_max' => 'nullable|numeric',
            'croissance' => 'nullable|string|max:255',
            'besoins_speciaux' => 'nullable|string',
            'utilisations' => 'nullable|string',
            'conseils_entretien' => 'nullable|string',
        ]);

        if ($request->hasFile('image_url')) {
            // Delete the old image if it exists
            if ($plante->image_url && file_exists(public_path('assets/images/course/' . $plante->image_url))) {
                unlink(public_path('assets/images/course/' . $plante->image_url));
            }

            // Store the new image
            $file = $request->file('image_url');
            $filename = $file->getClientOriginalName(); // Get the original filename
            $file->move(public_path('assets/images/course'), $filename); // Move the file to the correct directory
            $validatedData['image_url'] = $filename; // Store only the filename in the database
        }


        // Use $validatedData instead of $request->all()
        $plante->update($validatedData);

        // Redirect back with success message
        return redirect()->route('backend.plant.index')->with('success', 'Plant updated successfully!');
    }



    // Delete a plant
    public function destroy(Plantes $plante)
    {
        $plante->delete();
        return redirect()->route('backend.plant.index')->with('success', 'Plant deleted successfully!');
    }
}
