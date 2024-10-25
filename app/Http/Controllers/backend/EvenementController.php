<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\Classification;
use Illuminate\Http\Request;
use App\Models\Evenement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // Ajouté pour l'authentification


class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       // Récupérer le terme de recherche
    $search = $request->input('search');

    // Récupérer les événements avec une recherche par titre
    // $evenements = Evenement::when($search, function ($query) use ($search) {
    //     return $query->where('title', 'like', '%' . $search . '%');
    // })->paginate(3);
    $evenements = Evenement::with('adminUser') // Inclure la relation adminUser
    ->when($search, function ($query) use ($search) {
        return $query->where('title', 'like', '%' . $search . '%');
    })->paginate(3);
        $classifications = Classification::all(); // Assurez-vous d'avoir ce code pour récupérer les classifications

    return view('backend.evenement.evenement', compact('evenements', 'classifications'));
        //return view('backend.evenement.evenement', compact('evenements')); // Passing 'jardins' to the correct blade file
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    // Récupérer toutes les classifications pour les afficher dans la liste déroulante
    $classifications = Classification::all();
    return view('backend.evenement.formEvenement', compact('classifications'));
       // return view('backend.evenement.formEvenement');
    }

    // public function edit()
    // {
    //     return view('backend.evenement.formEvenement');
    // }

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
            'date' => 'required',
            'classification_id' => 'required|exists:classifications,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ajoutez la validation pour l'image
        ]);

        // Créez un nouveau Jardin instance et sauvegardez dans la base de données
        $data = $request->except('image');
        
        // Si une image est téléchargée, stockez-la et ajoutez son chemin au tableau de données
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/evenements', 'public'); // Spécifiez le chemin où l'image sera stockée
        }


        // Create a new Jardin instance and save to the database
        //Evenement::create($request->post())
          // Associez l'utilisateur admin à l'événement
        $data['admin_user_id'] = auth()->id();
        Evenement::create($data);
       

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
    public function edit($id)
    {
        // Récupérer l'événement spécifique avec son ID
        $evenement = Evenement::findOrFail($id);
        // Récupérer les classifications pour la liste déroulante
        $classifications = Classification::all();
        
        // Passer l'événement et les classifications à la vue
        return view('backend.evenement.formEvenement', compact('evenement', 'classifications'));
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
         // Validation des données
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'location' => 'required|string|max:255',
        'date' => 'required|date',
        'classification_id' => 'required|exists:classifications,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Ajoutez la validation pour l'image
    ]);

    // Récupérer l'événement à mettre à jour
    $evenement = Evenement::findOrFail($id);
    
    // Sauvegarder l'ancienne image si elle existe
    $oldImage = $evenement->image;

    $evenement->title = $request->title;
    $evenement->description = $request->description;
    $evenement->location = $request->location;
    $evenement->date = $request->date;
    $evenement->classification_id = $request->classification_id;

    // Vérifiez si une nouvelle image a été téléchargée
    if ($request->hasFile('image')) {
        // Supprimez l'ancienne image si elle existe
        if ($oldImage) {
            Storage::disk('public')->delete($oldImage);
        }

        // Stockez la nouvelle image et mettez à jour le chemin
        $evenement->image = $request->file('image')->store('images/evenements', 'public');
    }
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
        // Supprimer l'image associée si elle existe
        if ($evenement->image) {
            Storage::disk('public')->delete($evenement->image);
        }
        $evenement->delete(); // Supprimer l'événement
    
        return redirect()->route('backend.evenement.index');
    }
}
