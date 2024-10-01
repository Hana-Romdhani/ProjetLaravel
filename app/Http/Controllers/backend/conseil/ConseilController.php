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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'questions.*' => 'required|string',
            'contents.*' => 'required|string',
            'user_id' => 'required',
            'category_id' => 'required',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $imagePath = null;
        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('images', 'public/images/conseil/imgupload'); // Stocker dans le répertoire public/images
        }

        $conseilData = $request->post();
        $conseilData['image_url'] = $imagePath;

        Conseils::create($conseilData);
        return redirect()->route('conseils.index')->with('success', 'Conseil created successfully.');
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

        $validator = Validator::make($request->all(), [
            'titre' => 'required|string|max:255',
            'question' => 'required|string',
            'contenus' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'image_url' => 'nullable|url',
            'video_url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

         $conseil = Conseils::findOrFail($id);


         $imagePath = $conseil->image_url;
         if ($request->hasFile('image_url')) {
             if ($imagePath) {
                 Storage::disk('public/images/conseil/imgupload')->delete($imagePath);
             }
             $imagePath = $request->file('image_url')->store('images', 'public/images/conseil/imgupload');
         }

         $conseilData = $request->all();
         $conseilData['image_url'] = $imagePath;

         $conseil->update($conseilData);
         return redirect()->route('conseils.index')->with('success', 'Conseil updated successfully.');

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
        return redirect()->route('conseils.index')->with('success', 'Conseil deleted successfully.');
    }
}
