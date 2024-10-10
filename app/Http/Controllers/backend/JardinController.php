<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jardin;

class JardinController extends Controller
{
    // List all jardins
    public function index()
    {
        $jardins = Jardin::all();
        return view('backend.jardin.jardin', compact('jardins'));
    }

    // Show form to create a new jardin
    public function create()
    {
        return view('backend.jardin.formJardin');
    }

    // Store a new jardin
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'size' => 'nullable|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
        ]);
    
        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // Store image in 'public/images' directory
        }
    
        // Create a new jardin instance
        Jardin::create([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'size' => $request->size,
            'image' => $imagePath, // Save the image path in the database
        ]);
    
        return redirect()->route('backend.jardin.jardin')->with('success', 'Jardin added successfully!');
    }
    

    // Show form to edit an existing jardin
    public function edit(Jardin $jardin)
    {
        return view('backend.jardin.formJardin', compact('jardin'));
    }

    // Update an existing jardin
    public function update(Request $request, Jardin $jardin)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'size' => 'required|numeric',
            'description' => 'required|string',
//             'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
//    // Handle the image upload
//    if ($request->hasFile('image')) {
//     $imagePath = $request->file('image')->store('images', 'public'); // Store image in 'public/images' directory
// }

        $jardin->update([
            'name' => $request->name,
            'location' => $request->location,
            'size' => $request->size,
            'description' => $request->description,
            // 'image' => $imagePath,
        ]);

        return redirect()->route('backend.jardin.jardin')->with('success', 'Jardin updated successfully!');
    }

    // Delete an existing jardin
    public function destroy(Jardin $jardin)
    {
        $jardin->delete();
        return redirect()->route('backend.jardin.jardin')->with('success', 'Jardin deleted successfully!');
    }
}
