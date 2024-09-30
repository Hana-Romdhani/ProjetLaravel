<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Evenement;

class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evenements = Evenement::all();
        return view('backend.evenement.evenement', compact('evenements')); // Passing 'jardins' to the correct blade file
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.evenement.formEvenement');
    }

    public function edit()
    {
        return view('backend.evenement.formEvenement');
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
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required'
            // Add more fields as per your needs
        ]);

        // Create a new Jardin instance and save to the database
        Evenement::create($request->post());

        return redirect()->route('backend.evenement.index')->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $evenement = Evenement::findOrFail($id);
        return view('evenement.show', compact('evenement')); // Create a view to display a single Jardin
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     return view('backend.evenement.formEvenement');
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
         // Validation des données
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'location' => 'required|string|max:255',
        'date' => 'required|date',
    ]);

    // Récupérer l'événement à mettre à jour
    $evenement = Evenement::findOrFail($id);
    $evenement->title = $request->title;
    $evenement->description = $request->description;
    $evenement->location = $request->location;
    $evenement->date = $request->date;
    $evenement->save(); // Sauvegarder les changements

    // Rediriger avec un message de succès
    return redirect()->route('backend.evenement.index')->with('success', 'Event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $evenement = Evenement::findOrFail($id); // Récupérer l'événement par ID
        $evenement->delete(); // Supprimer l'événement
    
        return redirect()->route('backend.evenement.index');
    }
}
