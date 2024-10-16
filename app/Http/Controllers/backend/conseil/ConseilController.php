<?php

namespace App\Http\Controllers\backend\conseil;

use App\Http\Controllers\Controller;
use App\Models\CategorieConseil;
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
    // public function store(Request $request)
    // {
    //     try {
    //         // Validate input data
    //         $request->validate([
    //             'titre' => 'required|string|max:255|unique:conseils,titre', // Make title unique
    //             'question' => 'required|string|unique:conseils,question',
    //             'contenus' => 'required|string',
    //             'user_id' => 'required|integer',
    //             'category_id' => 'required|exists:categorie_conseils,id',
    //             'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
    //             'video_url' => 'nullable|url', // Ensure video URL is optional but correctly formatted
    //         ]);

    //         // Prepare data excluding image
    //         $data = $request->except('image_url');

    //         // Handle image upload if provided
    //         if ($request->hasFile('image_url')) {
    //             $image = $request->file('image_url');
    //             $imageName = time() . '.' . $image->getClientOriginalExtension();
    //             $image->move(public_path('images'), $imageName);
    //             $data['image_url'] = 'images/' . $imageName;
    //         }

    //         // Ensure the 'contenus' field (from TinyMCE) is stored correctly
    //         $data['contenus'] = $request->input('contenus');

    //         // Save conseil data in database
    //         Conseils::create($data);

    //         // Redirect on success
    //         return redirect()->route('conseil.index')->with('success', 'Conseil created successfully.');
    //     } catch (\Exception $e) {
    //         // Handle error and redirect back with error message
    //         return redirect()->back()->with('error', 'An error occurred while creating the conseil.');
    //     }
    // }



    // public function store(Request $request)
    // {
    //     try {
    //         // Validate input data
    //         $request->validate([
    //             'titre' => 'required|string|max:255|unique:conseils,titre', // Make title unique
    //             'question' => 'required|string|unique:conseils,question',
    //             'contenus' => 'required|string',
    //             'user_id' => 'required|integer',
    //             'category_id' => 'required|exists:categorie_conseils,id',
    //             'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
    //             'video_url' => 'nullable|url', // Ensure video URL is optional but correctly formatted
    //         ]);

    //         // Prepare data excluding image
    //         $data = $request->except('image_url');

    //         // Handle image upload if provided
    //         if ($request->hasFile('image_url')) {
    //             $image = $request->file('image_url');
    //             $imageName = time() . '.' . $image->getClientOriginalExtension();
    //             $image->move(public_path('images'), $imageName);
    //             $data['image_url'] = 'images/' . $imageName;
    //         }

    //         // Ensure the 'contenus' field (from TinyMCE) is stored correctly
    //         $data['contenus'] = $request->input('contenus');

    //         // Save conseil data in database
    //         Conseils::create($data);

    //         // Redirect on success
    //         return redirect()->route('conseil.index')->with('success', 'Conseil created successfully.');
    //     } catch (\Exception $e) {
    //         // Handle error and redirect back with error message
    //         return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while creating the conseil.']);

    //     }
    // }
    public function store(Request $request)
    {
        try {
            // Validate input data with a validator instance
            $validator = validator::make($request->all(), [
                'titre' => 'required|string|max:255|unique:conseils,titre', // Make title unique
                'question' => 'required|string|unique:conseils,question',
                'contenus' => 'required|string',
                'user_id' => 'required|integer',
                'category_id' => 'required|exists:categorie_conseils,id',
                'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
                'video_url' => 'nullable|url', // Ensure video URL is optional but correctly formatted
            ]);

            // Check if the validation fails
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                ], 422); // Return a JSON response with validation errors and status code 422
            }

            // Prepare data excluding image
            $data = $request->except('image_url');

            // Handle image upload if provided
            if ($request->hasFile('image_url')) {
                $image = $request->file('image_url');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $data['image_url'] = 'images/' . $imageName;
            }

            // Ensure the 'contenus' field (from TinyMCE) is stored correctly
            $data['contenus'] = $request->input('contenus');

            // Save conseil data in database
            Conseils::create($data);

            // Return success response for AJAX
            return response()->json([
                'success' => true,
                'message' => 'Conseil created successfully.'
            ]);
            return redirect()->route('conseil.index')->with('success', 'Conseil created successfully.');


        } catch (\Exception $e) {
            // Handle general errors
            return response()->json([
                'error' => 'An error occurred while creating the conseil.',
            ], 500);
            return redirect()->route('conseil.index')->with('success', 'Conseil created successfully.');
            // Return a JSON response with an error and status code 500
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
            'contenus' => 'required|string|max:1000',
            'user_id' => 'required',
            'category_id' => 'required|exists:categorie_conseils,id',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle validation failures
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        $conseil = Conseils::findOrFail($id);

        $conseilData = $request->only(['titre', 'question', 'contenus', 'user_id', 'category_id']);

        if ($request->hasFile('image_url')) {
            if ($conseil->image_url) {
                Storage::delete($conseil->image_url);
            }


            $path = $request->file('image_url')->store('images', 'public');
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
}
