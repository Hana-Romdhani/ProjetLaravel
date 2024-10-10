<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Ressource;
use Illuminate\Http\Request;

class RessourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ressources = Ressource::all();
        return view('frontend.ressources.Ressources', compact('ressources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.ressources.RessourcesForm');

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
            'nom' => 'required|string|max:255',
            'quantite' => 'required|numeric',
            'libelle' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);
    
        // Handle file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('uploads/ressources', 'public'); // Store image in 'public/uploads/ressources'
        }
    
        Ressource::create([
            'nom' => $request->nom,
            'quantite' => $request->quantite,
            'libelle' => $request->libelle,
            'image' => $imagePath ?? null,  // Store image path in database
        ]);
    
        return redirect()->route('frontend.ressources.Ressources')->with('success', 'Ressource added successfully!');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $ressources = Ressource::all();
        return view('frontend.ressources.RessourcesList', compact('ressources'));
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ressource $ressource)
    {
        return view('frontend.ressources.RessourcesForm', compact('ressource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ressource $ressource)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'quantite' => 'required|numeric',
            'libelle' => 'required|string',
        ]);

        $ressource->update([
            'nom' => $request->nom,
            'quantite' => $request->quantite,
            'libelle' => $request->libelle,
        ]);

        return redirect()->route('frontend.ressources.Ressources')->with('success', 'Ressource updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ressource $ressource)
    {
        $ressource->delete();
        return redirect()->route('frontend.ressources.Ressources')->with('success', 'Ressource deleted successfully!');
    }
}
