<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jardin;

class JardinController extends Controller
{
    // List all jardins
    public function index(Request $request)
    {
        $jardins = Jardin::all();
        $query = Jardin::query();

    // Search functionality
    if ($request->has('search') && $request->search != '') {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // Sort functionality
    if ($request->has('sort') && in_array($request->sort, ['name', 'location', 'size', 'created_at'])) {
        $query->orderBy($request->sort);
    }

    // Get the results with pagination
    $jardins = $query->paginate(2); // Adjust per page as needed

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

            $request->validate([
                'name' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'size' => 'required|integer|min:1',
                'description' => 'required|string|max:500',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'name.required' => 'You should fill in the Jardin Name field.',
                'location.required' => 'You should fill in the Location field.',
                'size.required' => 'You should specify the Size of the jardin (in sq meters).',
                'description.required' => 'Please provide a description for the jardin.',
                'image.required' => 'An image is required for the jardin.',
                'image.image' => 'The uploaded file must be an image.',
                'image.mimes' => 'The image should be of type jpeg, png, jpg, or gif.',
            ]);

            // Code to store jardin data



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
            'image' => $imagePath,
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
        ]);


        $jardin->update([
            'name' => $request->name,
            'location' => $request->location,
            'size' => $request->size,
            'description' => $request->description,
        ]);

        return redirect()->route('backend.jardin.jardin')->with('success', 'Jardin updated successfully!');
    }

    public function destroy(Jardin $jardin)
    {
        $jardin->delete();
        return redirect()->route('backend.jardin.jardin')->with('success', 'Jardin deleted successfully!');
    }
}
