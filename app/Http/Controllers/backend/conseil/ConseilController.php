<?php

namespace App\Http\Controllers\backend\conseil;

use App\Http\Controllers\Controller;
use App\Models\Conseils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ConseilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchTerm = $request->get('titre');


        $conseils = Conseils::when($searchTerm, function($query, $searchTerm) {
            return $query->where('titre', 'like', "%{$searchTerm}%");
        })->paginate(2);

        return view('backend.conseil.index', compact('conseils'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.conseil.create'); // Return the view for creating a conseil
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation des données d'entrée
        $request->validate( [
            'titre' => 'required|string|max:255',
            'questions.*' => 'required|string',
            'contents.*' => 'required|string',
            'user_id' => 'required',
            'category_id' => 'required',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de l'image
        ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        // Récupérer les données du formulaire
        $data = $request->except('image_url'); // Exclure 'image_url' car nous allons le gérer séparément

        // Gérer le téléchargement de l'image si elle est présente
        if ($request->hasFile('image_url')) {
            // Récupérer le fichier de l'image
            $image = $request->file('image_url');

            // Définir un nom unique pour l'image
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Déplacer l'image vers le dossier de stockage
            $image->move(public_path('images'), $imageName);

            // Ajouter l'URL de l'image aux données à sauvegarder
            $data['image_url'] = 'images/' . $imageName;
        }

        // Créer une nouvelle instance de Conseil et sauvegarder dans la base de données
        Conseils::create($data);

        return redirect()->route('conseil.index')->with('success', 'Conseil created successfully.');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $conseil = Conseils::findOrFail($id); // Find the conseil by ID
        return view('backend.conseil.show', compact('conseil')); // Return the view for displaying a single conseil
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conseil = Conseils::findOrFail($id); // Find the conseil by ID
        return view('backend.conseil.edit', compact('conseil')); // Return the view for editing a conseil
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
        // Validation rules
        $request->validate( [
            'titre' => 'required|string|max:255',
            'question' => 'required|string',
            'contenus' => 'required|string|max:1000',
            'user_id' => 'required',
            'category_id' => 'required',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        // Handle validation failures
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        // Retrieve the advice item to update
        $conseil = Conseils::findOrFail($id);

        // Get data to update
        $conseilData = $request->only(['titre', 'question', 'contenus', 'user_id', 'category_id']);

        // Handle file upload if an image is provided
        if ($request->hasFile('image_url')) {
            // Delete the old image if it exists (optional)
            if ($conseil->image_url) {
                Storage::delete($conseil->image_url); // Use appropriate path based on your storage
            }

            // Store the new image
            $path = $request->file('image_url')->store('images', 'public'); // Store in 'storage/app/public/images'
            $conseilData['image_url'] = $path;
        }


        $conseil->update($conseilData);

        return redirect()->route('conseil.index')->with('success', 'Conseil mis à jour avec succès.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $conseil = Conseils::findOrFail($id);
        $conseil->delete();
        return redirect()->route('conseil.index')->with('success', 'Conseil deleted successfully.');
    }
}
