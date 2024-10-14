<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\RessourcesPartage;
use Illuminate\Http\Request;

class RessourcesPartageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Charger les ressources partagées avec les relations 'emprunteur' et 'ressource'
        $ressourcesPartage = RessourcesPartage::with(['emprunteur', 'ressource'])->get();
    
        // Retourner la vue avec les ressources partagées
        return view('frontend.ressources.RessourcesPartage', compact('ressourcesPartage'));
    }
    


    public function accepter($id)
{
    // Find the resource-sharing request by ID
    $ressourcePartage = RessourcesPartage::findOrFail($id);

    // Update the status to 'accepté'
    $ressourcePartage->statut = 'accepté';
    $ressourcePartage->save();

    return redirect()->back()->with('success', 'Ressource acceptée avec succès.');
}

public function refuser($id)
{
    // Find the resource-sharing request by ID
    $ressourcePartage = RessourcesPartage::findOrFail($id);

    // Update the status to 'refusé'
    $ressourcePartage->statut = 'refusé';
    $ressourcePartage->save();

    return redirect()->back()->with('success', 'Ressource refusée avec succès.');
}



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
