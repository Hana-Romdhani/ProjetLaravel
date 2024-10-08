<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\CategoriePlante;
use Illuminate\Http\Request;

class CategoryPlanteController extends Controller
{
    // Display a list of categories
    public function index()
    {
        $categories = CategoriePlante::paginate(10); // Paginate categories
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
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|image|max:2048', // Max 2MB file size
            'parent_id' => 'nullable|exists:categorie_plantes,id', // Ensure parent exists if selected
            'slug' => 'nullable|string|max:255|unique:categorie_plantes,slug',
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
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|image|max:2048',
            'parent_id' => 'nullable|exists:categorie_plantes,id',
            'slug' => 'nullable|string|max:255|unique:categorie_plantes,slug,' . $category->id,
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
