<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Jardin;


class JardinController extends Controller
{
    public function index()
    {
        $jardins = Jardin::all();
        return view('backend.jardin.jardin', compact('jardins')); // Passing 'jardins' to the correct blade file
    }

    public function show($id)
    {
        $jardin = Jardin::findOrFail($id);
        return view('jardin.show', compact('jardin')); // Create a view to display a single Jardin
    }


    public function edit()
    {
        return view('backend.jardin.formJardin');
    }
    public function create()
    {
        return view('backend.jardin.formJardin');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            // Add more fields as per your needs
        ]);

        // Create a new Jardin instance and save to the database
        Jardin::create($request->post());

        return redirect()->route('backend.jardin.jardin')->with('success', 'Jardin created successfully.');
    }
}
