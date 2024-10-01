<?php

namespace App\Http\Controllers\backend\conseil;

use App\Http\Controllers\Controller;
use App\Models\CategorieConseil;
use Illuminate\Http\Request;

class ConseilCategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search = $request->get('name');

        if ($search) {
            $categorie_conseils = CategorieConseil::where('name', 'like', '%' . $search . '%')->paginate(2);
            $categorie_conseils->appends(['name' => $search]);
        } else {
            $categorie_conseils = CategorieConseil::paginate(2);
        }

        return view('backend.conseil.categories.index', compact('categorie_conseils'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.conseil.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      // Store a newly created resource in storage
      public function store(Request $request)
      {
          // Validate the request
          $request->validate([
              'name' => [
                  'required',                 // Field must be present and not empty
                  'string',                   // Field must be a string
                  'max:255',                  // Field must not exceed 255 characters
                  'regex:/^[a-zA-Z\s]+$/',    // Field must contain only letters and spaces
                  'unique:categorie_conseils,name',  // Field must be unique in the 'categorie_conseils' table
              ],
          ]);

          // Create the new category
          $categorie = CategorieConseil::create($request->post());

          // Check if creation was successful
          if ($categorie) {
              return redirect()->route('conseil-categorie.index')->with('success', 'Category created successfully.');
          } else {
              return redirect()->route('conseil-categorie.create')->with('error', 'Failed to create the category. Please try again.');
          }
      }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorie_conseil = CategorieConseil::findOrFail($id);
        return view('backend.conseil.categories.edit', compact('categorie_conseil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => [
                'required',                 // Field must be present and not empty
                'string',                   // Field must be a string
                'max:255',                  // Field must not exceed 255 characters
                'regex:/^[a-zA-Z\s]+$/',    // Field must contain only letters and spaces
                'unique:categorie_conseils,name',  // Field must be unique in the 'categorie_conseils' table
            ],
        ]);

        // Find the category or fail if not found
        $categorie_conseil = CategorieConseil::findOrFail($id);

        // Update the category
        $success = $categorie_conseil->update($request->all());

        // Check if the update was successful
        if ($success) {
            return redirect()->route('conseil-categorie.index')->with('success', 'Category updated successfully.');
        } else {
            // If the update failed, redirect back to the edit form with the input
            return redirect()->route('conseil-categorie.edit', $id)
                             ->withInput() // retain the input values
                             ->with('error', 'Failed to update the category. Please try again.');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categorie_conseil = CategorieConseil::findOrFail($id);
        $categorie_conseil->delete();

        return redirect()->route('conseil-categorie.index')->with('success', 'Category deleted successfully.');
    }
}
