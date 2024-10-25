<?php
namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plantation;
use App\Models\Jardin;
use App\Models\Plantes;
use App\Models\User;
use App\Mail\PlantationCreated;  // Importation du Mailable
use Illuminate\Support\Facades\Mail;  // Importation de Mail

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

        // Envoyer l'email à l'éditeur sélectionné
        $user = User::find($request->user_id);
        if ($user) {
            Mail::to($user->email)->send(new PlantationCreated($plantation));
        }

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


//     public function agenda()
// {
//     $user = auth()->user(); // Get the logged-in user
//     $plantations = Plantation::with('jardin', 'plantes')
//                              ->where('user_id', $user->id)
//                              ->orderBy('date_plantation', 'asc')
//                              ->get();

//     return view('backend.plantation.agenda', compact('plantations'));
// }

public function agenda()
{
    $user = auth()->user();

    if ($user->role !== 'editor') {
        abort(403, 'Unauthorized action.');
    }

    $plantations = Plantation::with(['jardin', 'plantes'])
        ->where('user_id', $user->id)
        ->get()
        ->map(function ($plantation) {
            return [
                'title' => $plantation->nom . ' - ' . optional($plantation->jardin)->name,
                'start' => $plantation->date_plantation->format('Y-m-d'),
                'description' => 'Plants: ' . $plantation->plantes->pluck('nom')->implode(', ')
            ];
        });

    // Encode as JSON for direct use in the view
    $plantationEvents = json_encode($plantations);

    return view('backend.plantation.agenda', compact('plantationEvents'));
}

}
