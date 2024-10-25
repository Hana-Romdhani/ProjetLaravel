<?php
namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plantation;
use App\Models\Jardin;
use App\Models\Plantes;
use App\Models\User;

class PlantationController extends Controller
{
    // List all plantations
    public function index()
    {
        $plantations = Plantation::with('user', 'jardin', 'plantes')->get();
        return view('backend.plantation.plantation', compact('plantations'));
    }

    // Show form to create a new plantation
    public function create()
    {
        $jardins = Jardin::all();
        $plantes = Plantes::all();
        $users = User::where('role', 'editor')->get();

        return view('backend.plantation.formPlantation', compact('jardins', 'plantes', 'users'));
    }

    // Store a new plantation
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'nom' => 'required|string|max:255',
            'jardin_id' => 'required|exists:jardins,id',
            'user_id' => 'required|exists:users,id',
            'date_plantation' => 'required|date',
            'plantes' => 'required|array',
        ]);

        // Create the plantation
        $plantation = Plantation::create([
            'nom' => $request->nom,
            'jardin_id' => $request->jardin_id,
            'user_id' => $request->user_id,
            'date_plantation' => $request->date_plantation,
        ]);

        // Attach the selected plantes
        $plantation->plantes()->attach($request->plantes);

        return redirect()->route('backend.plantation.plantation')->with('success', 'Plantation added successfully!');
    }

    // Show form to edit an existing plantation
    public function edit(Plantation $plantation)
    {
        $jardins = Jardin::all();
        $plantes = Plantes::all();
        $users = User::where('role', 'editor')->get();

        return view('backend.plantation.formPlantation', compact('plantation', 'jardins', 'plantes', 'users'));
    }

    // Update an existing plantation
    public function update(Request $request, Plantation $plantation)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'jardin_id' => 'required|exists:jardins,id',
            'user_id' => 'required|exists:users,id',
            'date_plantation' => 'required|date',
            'plantes' => 'required|array',
        ]);

        $plantation->update([
            'nom' => $request->nom,
            'jardin_id' => $request->jardin_id,
            'user_id' => $request->user_id,
            'date_plantation' => $request->date_plantation,
        ]);

        // Sync the plantes
        $plantation->plantes()->sync($request->plantes);

        return redirect()->route('backend.plantation.plantation')->with('success', 'Plantation updated successfully!');
    }

    public function destroy(Plantation $plantation)
    {
        $plantation->delete();
        return redirect()->route('backend.plantation.plantation')->with('success', 'Plantation deleted successfully!');
    }
}
