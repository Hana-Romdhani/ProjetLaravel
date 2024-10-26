<?php

namespace App\Http\Controllers\backend\conseil;

use App\Http\Controllers\Controller;
use App\Models\CategorieConseil;
use App\Models\Conseils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class ConseilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchTerm = $request->get('search');

        $conseils = Conseils::with('category')
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('titre', 'like', "%{$searchTerm}%");
            })
            ->paginate(2);

        return view('backend.conseil.index', compact('conseils', 'searchTerm'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategorieConseil::all();

        return view('backend.conseil.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
    {
        try {
            // Validate input data
            $validator = validator::make($request->all(), [
                'titre' => 'required|string|max:255|unique:conseils,titre', // Make title unique
                'question' => 'required|string|unique:conseils,question',
                'contenus' => 'required|string',
                'category_id' => 'required|exists:categorie_conseils,id',
                'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
                'video_url' => ['nullable',  new \App\Rules\YouTubeUrl()], // Ensure video URL is optional but correctly formatted
            ]);

            // Check if the validation fails
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                ], 422); // Return JSON response with validation errors and status code 422
            }

            // Prepare data, setting the 'user_id' to the authenticated user's ID
            $data = $request->except(['image_url']);
            $data['user_id'] = Auth::id();
            $data['role'] = 'editor';
            // Handle image upload if provided
            if ($request->hasFile('image_url')) {
                $image = $request->file('image_url');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $data['image_url'] = 'images/' . $imageName;
            }

            // Ensure the 'contenus' field (from TinyMCE) is stored correctly
            $data['contenus'] = $request->input('contenus');

            // Save conseil data in the database
            Conseils::create($data);

            // Return success response for AJAX
            return response()->json([
                'success' => true,
                'message' => 'Conseil created successfully.'
            ]);
        } catch (\Exception $e) {
            // Handle general errors
            return response()->json([
                'error' => 'An error occurred while creating the conseil.',
            ], 500); // Return JSON response with an error and status code 500
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

        $conseil = Conseils::findOrFail($id);

        return view('backend.conseil.detail', compact('conseil'));
    }


    public function categoryShow($id)
    {
        $categorie_conseil = CategorieConseil::findOrFail($id);

        $search = request()->query('search');

        $conseils = $categorie_conseil->conseils()
            ->when($search, function ($query, $search) {
                return $query->where('titre', 'like', '%' . $search . '%');
            })
            ->paginate(4);

        return view('backend.conseil.show', compact('categorie_conseil', 'conseils'))
            ->with('search', $search);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $conseil = Conseils::findOrFail($id);
        $categories = CategorieConseil::all();
        return view('backend.conseil.edit', compact('conseil', 'categories'));
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
        $request->validate([
            'titre' => 'required|string|max:255',
            'question' => 'required|string',
            'contenus' => 'required|string',
            'category_id' => 'required|exists:categorie_conseils,id',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $conseil = Conseils::findOrFail($id);

        // Récupérer les données sans l'image
        $conseilData = $request->only(['titre', 'question', 'contenus',  'category_id']);

        // Vérifiez si une nouvelle image est téléchargée
        if ($request->hasFile('image_url')) {
            // Supprimer l'ancienne image si elle existe
            if ($conseil->image_url) {
                $oldImagePath = public_path($conseil->image_url); // Chemin absolu pour la suppression
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Supprimer le fichier
                }
            }

            // Stocker la nouvelle image dans le même dossier que `store`
            $image = $request->file('image_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName); // Dossier de destination
            $conseilData['image_url'] = 'images/' . $imageName; // Enregistrer le chemin relatif
        }

        // Mettre à jour les données
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
    public function indexfront(Request $request)
    {
        // Fetch categories
        $categories = CategorieConseil::all();

        // Get the selected category id from the request
        $selectedCategoryId = $request->input('category');

        // Fetch all advice related to the selected category
        $adviceList = [];
        $firstAdvice = null;
        $firstCategory = null;

        if ($selectedCategoryId) {
            // Vérifier si la catégorie existe
            $firstCategory = CategorieConseil::find($selectedCategoryId);
            if ($firstCategory) {
                // Récupérer tous les conseils liés à la catégorie
                $adviceList = Conseils::where('category_id', $selectedCategoryId)->get();
                $firstAdvice = $adviceList->first(); // Récupérer le premier conseil
            }
        }

        // Passer les conseils à la vue
        return view('frontend.conseil.index', compact('categories', 'adviceList', 'firstAdvice', 'firstCategory'));
    }


    public function showfront($id)
    {

        $conseil = Conseils::findOrFail($id);

        return view('frontend.conseil.details', compact('conseil'));
    }
    public function jardinierfront()
    {
        // Récupérer tous les conseils
        $conseils = Conseils::all();

        return view('frontend.conseil.profiljardinier', compact('conseils'));
    }

    public function rate(Request $request, $id)
    {
        // Fetch the current authenticated user
        $user = auth()->user();

        // Check if the user has the 'user' role
        if ($user->role !== 'user') {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à noter ce conseil.');
        }

        // Fetch the conseil
        $conseil = Conseils::findOrFail($id);

        // Check if the user has already rated this conseil
        // You will need to implement your logic to track user ratings
        // For example, you could store user IDs in a JSON column or use a session to track ratings temporarily
        $ratedByUsers = json_decode($conseil->rated_by_users ?? '[]', true); // Assuming you have a field to track rated users

        if (in_array($user->id, $ratedByUsers)) {
            return redirect()->back()->with('error', 'Vous avez déjà noté ce conseil.');
        }

        // Proceed with rating
        $newRating = $request->input('rating');

        // Update the total rating and count
        $conseil->total_rating += $newRating; // Add the new rating to the total
        $conseil->rating_count += 1; // Increment the count of ratings

        // Save the changes
        $conseil->rated_by_users = json_encode(array_merge($ratedByUsers, [$user->id])); // Track the user who rated
        $conseil->save();

        return redirect()->back()->with('success', 'Note ajoutée avec succès!');
    }



}
