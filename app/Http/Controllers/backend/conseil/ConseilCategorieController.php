<?php

namespace App\Http\Controllers\backend\conseil;

use App\Http\Controllers\Controller;
use App\Models\CategorieConseil;
use Illuminate\Http\Request;

class ConseilCategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorie_conseils = CategorieConseil::paginate(2);
        return view ('backend.conseil.categories.index', compact('categorie_conseils'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.conseil.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      // Store a newly created resource in storage
      public function store(Request $request)
      {
          $request->validate([
              'name' => 'required|string|max:255',
          ]);

          CategorieConseil::create($request->post());

          return redirect()->route('categorie.index')->with('success', 'Category created successfully.');
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
        $categorie_conseil = CategorieConseil::findOrFail($id);
        return view('backend.conseil.categories.edit', compact('categorie_conseil'));
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
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $categorie_conseil = CategorieConseil::findOrFail($id);
        $categorie_conseil->update($request->all());

        return redirect()->route('categorie.index')->with('success', 'Category updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categorie_conseil = CategorieConseil::findOrFail($id);
        $categorie_conseil->delete();

        return redirect()->route('categorie.index')->with('success', 'Category deleted successfully.');
    }
}
