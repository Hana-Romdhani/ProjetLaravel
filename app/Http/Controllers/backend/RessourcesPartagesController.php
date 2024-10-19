<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RessourcesPartage;

class RessourcesPartagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index(Request $request)
     {
         $query = RessourcesPartage::query();
     
         // Filtre par statut si un statut est sélectionné
         if ($request->filled('statut')) {
             $query->where('statut', $request->input('statut'));
         }
     
         // Pagination avec conservation des paramètres de filtre
         $ressourcespartages = $query->paginate(2)->appends($request->query());
     
         return view('backend.ressource.ressourcesPartage', compact('ressourcespartages'));
     }
     


    // public function index()
    // {
    //     $ressourcespartages = RessourcesPartage::paginate(2);
    //     return view('backend.ressource.ressourcesPartage', compact('ressourcespartages'));
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
