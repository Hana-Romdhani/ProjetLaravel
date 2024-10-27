<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Classification;


class ClassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $classifications = Classification::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->get();
        return view('backend.classification.classification', compact('classifications')); // Passing 'jardins' to the correct blade file
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.classification.formClassification');
    }

    public function edit()
    {
        return view('backend.classification.formClassification');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
            // Add more fields as per your needs
        ], [
            'name.required' => 'Name is required',
   ] );

        // Create a new Jardin instance and save to the database
        Classification::create($request->post());

        return redirect()->route('backend.classification.index')->with('success', 'Classification created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classification = Classification::findOrFail($id);
        return view('classification.show', compact('classification')); // Create a view to display a single Jardin
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     return view('backend.classification.formClassification');
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
    
        // Récupérer l'événement à mettre à jour
        $classification = Classification::findOrFail($id);
        $classification->name = $request->name;
        $classification->save(); // Sauvegarder les changements
    
        // Rediriger avec un message de succès
        return redirect()->route('backend.classification.index')->with('success', 'Classification updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classification = Classification::findOrFail($id); // Récupérer l'événement par ID
        $classification->delete(); // Supprimer l'événement
    
        return redirect()->route('backend.classification.index')->with('success', 'Classification deleted successfully.');
    }
}
