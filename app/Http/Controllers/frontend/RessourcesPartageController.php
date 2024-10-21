<?php

namespace App\Http\Controllers\frontend;
use App\Notifications\RessourcePartageAcceptee;
use App\Http\Controllers\Controller;
use App\Models\RessourcesPartage;
use App\Models\Ressource; // Assurez-vous d'importer le modèle Ressource
use Illuminate\Http\Request;
use App\Notifications\RessourcePartageRefusee;

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
    // Trouver la demande de partage par ID
    $ressourcesPartage = RessourcesPartage::findOrFail($id);

    // Mettre à jour le statut à 'accepté'
    $ressourcesPartage->statut = 'accepté';
    $ressourcesPartage->save();

    // Envoyer un email à l'emprunteur
    $emprunteur = $ressourcesPartage->emprunteur;
    $emprunteur->notify(new RessourcePartageAcceptee($ressourcesPartage));

    return redirect()->back()->with('success', 'Ressource acceptée avec succès.');
}


public function getQuantiteRestante(Request $request, $ressourceId)
    {
        try {
            $datePartage = $request->input('date_partage');
            $ressource = Ressource::find($ressourceId);
            
            if (!$ressource) {
                return response()->json(['error' => 'Ressource non trouvée'], 404);
            }
            
            // Quantité initiale de la ressource
            $quantiteInitiale = $ressource->quantite;

            // Quantité déjà réservée à la date donnée et avec statut accepté
            $quantiteReservee = RessourcesPartage::where('ressource_id', $ressourceId)
                ->where('date_partage', $datePartage)
                ->where('statut', 'accepté') // Utilisez les noms d'attributs corrects
                ->sum('quantite');

            // Calcul de la quantité restante
            $quantiteRestante = $quantiteInitiale - $quantiteReservee;

            return response()->json([
                'quantite_restante' => $quantiteRestante > 0 ? $quantiteRestante : 0,
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur dans getQuantiteRestante: ' . $e->getMessage());
            return response()->json(['error' => 'Erreur serveur'], 500);
        }
    }


public function refuser($id)
{
    // Trouver la demande de partage par ID
    $ressourcesPartage = RessourcesPartage::findOrFail($id);

    // Mettre à jour le statut à 'refusé'
    $ressourcesPartage->statut = 'refusé';
    $ressourcesPartage->save();

    // Envoyer un email à l'emprunteur
    $emprunteur = $ressourcesPartage->emprunteur;
    $emprunteur->notify(new RessourcePartageRefusee($ressourcesPartage));

    return redirect()->back()->with('success', 'Ressource refusée avec succès.');
}


public function store(Request $request)
{
    try {
        // Valider les données d'entrée
        $validatedData = $request->validate([
            'user_preteur_id' => 'required|exists:users,id',
            'ressource_id' => 'required|exists:ressources,id',
            'quantite' => 'required|integer|min:1',
            'date_partage' => 'required|date',
        ]);

        // Récupérer la ressource correspondante
        $ressource = Ressource::findOrFail($validatedData['ressource_id']);

        // Récupérer la quantité totale de la ressource
        $quantiteTotale = $ressource->quantite;

        // Calculer la quantité déjà réservée pour cette date spécifique
        $quantiteReservee = RessourcesPartage::where('ressource_id', $validatedData['ressource_id'])
            ->where('date_partage', $validatedData['date_partage'])
            ->where('statut', 'accepté') // Statut accepté seulement
            ->sum('quantite');

        // Calculer la quantité restante disponible pour la date spécifiée
        $quantiteRestante = $quantiteTotale - $quantiteReservee;

        // Vérifier si la quantité restante est suffisante pour cette nouvelle demande
        if ($quantiteRestante < $validatedData['quantite']) {
            return response()->json(['error' => 'Quantité insuffisante pour la date spécifiée'], 400);
        }

        // Créer la ressource partagée
        $ressourcePartage = new RessourcesPartage();
        // $ressourcePartage->user_emprunteur_id = auth()->id();  // Utilisateur authentifié
        $ressourcePartage->user_emprunteur_id = 2;  // Utilisateur authentifié
        $ressourcePartage->user_preteur_id = $validatedData['user_preteur_id'];
        $ressourcePartage->ressource_id = $validatedData['ressource_id'];
        $ressourcePartage->quantite = $validatedData['quantite'];
        $ressourcePartage->date_partage = $validatedData['date_partage'];
        $ressourcePartage->statut = 'en attente';  // Statut par défaut
        $ressourcePartage->save();

        return response()->json(['success' => true]);

    } catch (\Exception $e) {
        \Log::error('Erreur lors de la création du partage de ressource : ' . $e->getMessage());
        return response()->json(['error' => 'Erreur serveur', 'message' => $e->getMessage()], 500);
    }
}



// public function store(Request $request)
// {
//     $validatedData = $request->validate([
//         'user_preteur_id' => 'required|exists:users,id',
//         'ressource_id' => 'required|exists:ressources,id',
//         'quantite' => 'required|integer|min:1',
//         'date_partage' => 'required|date',
//     ]);

//     // Créer une nouvelle ressource partagée
//     $ressourcePartage = new RessourcesPartage();
//     $ressourcePartage->user_emprunteur_id = 2; // ID statique de l'emprunteur
//     $ressourcePartage->user_preteur_id = $validatedData['user_preteur_id'];
//     $ressourcePartage->ressource_id = $validatedData['ressource_id'];
//     $ressourcePartage->quantite = $validatedData['quantite'];
//     $ressourcePartage->date_partage = $validatedData['date_partage'];
//     $ressourcePartage->statut = 'en attente'; // Par défaut
//     $ressourcePartage->save();

//     return response()->json(['success' => true]);
// }



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
