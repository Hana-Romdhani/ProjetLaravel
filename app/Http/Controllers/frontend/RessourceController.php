<?php

namespace App\Http\Controllers\landingpage;

use App\Http\Controllers\Controller;
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
        return view('frontend.ressource.ressource', compact('ressources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.ressource.formRessource');

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
        ]);

        Jardin::create([
            'nom' => $request->nom,
            'quantite' => $request->quantite,
            'libelle' => $request->libelle,
        ]);

        return redirect()->route('frontend.ressource.ressource')->with('success', 'Ressource added successfully!');
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
    public function edit(Ressource $ressource)
    {
        return view('frontend.ressource.formRessource', compact('ressource'));
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

        $jardin->update([
            'nom' => $request->nom,
            'quantite' => $request->quantite,
            'libelle' => $request->libelle,
        ]);

        return redirect()->route('frontend.ressource.ressource')->with('success', 'Ressource updated successfully!');
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
        return redirect()->route('frontend.ressource.ressource')->with('success', 'Ressource deleted successfully!');
    }
}
