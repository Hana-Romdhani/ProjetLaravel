<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\CategoriePlante;
use Illuminate\Http\Request;

class CategoryPlanteController extends Controller
{

    public function index(Request $request)
    {
        // Fetch search query
        $search = $request->input('search');

        // Query the categories based on search and apply pagination
        $categories = CategoriePlante::when($search, function ($query, $search) {
            return $query->where('nom', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })
            ->paginate(5);

        return view('backend.categoriePlante.index', compact('categories'));
    }


    // Show the form to create a new category
    public function create()
    {
        $categories = CategoriePlante::all(); // To allow selection of parent category if necessary
        return view('backend.categoriePlante.formCategory', compact('categories'));
    }

    // Store the new category in the database
    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255|unique:categorie_plantes,nom',
            'description' => 'nullable|string|max:500',
            'image_url' => 'nullable|image|max:2048', // 2MB max for image files
            'parent_id' => 'nullable|exists:categorie_plantes,id', // Check if parent category exists
            'slug' => 'nullable|string|max:255|unique:categorie_plantes,slug',
        ], [
            'nom.required' => 'Veuillez entrer le nom de la catégorie.',
            'nom.unique' => 'Ce nom de catégorie existe déjà.',
            'image_url.image' => 'Le fichier doit être une image.',
            'image_url.max' => 'L\'image ne doit pas dépasser 2MB.',
            'parent_id.exists' => 'La catégorie parente sélectionnée n\'existe pas.',
            'slug.unique' => 'Ce slug est déjà utilisé.',
        ]);

        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/images/categories'), $filename);
            $validatedData['image_url'] = $filename;
        }

        CategoriePlante::create($validatedData);

        return redirect()->route('backend.categoriePlante.index')->with('success', 'Category added successfully!');
    }


    // Show the form to edit an existing category
    public function edit(CategoriePlante $category)
    {
        $categories = CategoriePlante::all(); // To allow parent category selection
        return view('backend.categoriePlante.formCategory', compact('category', 'categories'));
    }

    // Update the category
    public function update(Request $request, CategoriePlante $category)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255|unique:categorie_plantes,nom,' . $category->id,
            'description' => 'nullable|string|max:500',
            'image_url' => 'nullable|image|max:2048', // 2MB max for image files
            'parent_id' => 'nullable|exists:categorie_plantes,id',
            'slug' => 'nullable|string|max:255|unique:categorie_plantes,slug,' . $category->id,
        ], [
            'nom.required' => 'Veuillez entrer le nom de la catégorie.',
            'nom.unique' => 'Ce nom de catégorie existe déjà.',
            'image_url.image' => 'Le fichier doit être une image.',
            'image_url.max' => 'L\'image ne doit pas dépasser 2MB.',
            'parent_id.exists' => 'La catégorie parente sélectionnée n\'existe pas.',
            'slug.unique' => 'Ce slug est déjà utilisé.',
        ]);

        if ($request->hasFile('image_url')) {
            if ($category->image_url && file_exists(public_path('assets/images/categories/' . $category->image_url))) {
                unlink(public_path('assets/images/categories/' . $category->image_url));
            }

            $file = $request->file('image_url');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/images/categories'), $filename);
            $validatedData['image_url'] = $filename;
        }

        $category->update($validatedData);

        return redirect()->route('backend.categoriePlante.index')->with('success', 'Category updated successfully!');
    }


    // Delete a category
    public function destroy(CategoriePlante $category)
    {
        $category->delete();
        return redirect()->route('backend.categoriePlante.index')->with('success', 'Category deleted successfully!');
    }
}
