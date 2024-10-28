<?php

namespace App\Http\Controllers\shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('auth.pages.Signin', compact('users'));
    }

    public function authenticate(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        // Si l'authentification réussit, régénérez la session
        $request->session()->regenerate();

        // Récupérez l'utilisateur connecté
        $user = Auth::user();

        // Debug: Affichez le rôle de l'utilisateur
        \Log::info('User role: ' . $user->role); // Ajoutez cette ligne pour le debug

        // Redirection en fonction du rôle
        if ($user->role === 'editor' || $user->role === 'user') {
            return redirect()->intended('/');  // Rediriger vers /
        } else {
            return redirect()->intended('/admin/conseil');  // Rediriger vers /
        }
    }

    // Si l'authentification échoue, revenez à la connexion avec un message d'erreur
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
}



    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out

        // Invalidate the session and regenerate the CSRF token to prevent session fixation attacks
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect the user to the login page after logout
        return redirect()->route('login');
    }



    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Validate the form inputs
        $validated = $request->validate([
            'nameUser' => 'required',   // Username field
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required'  // Ensure role is selected
        ]);

        // Determine the role value based on the selected option
        $roleValue = ($validated['role'] === 'editor') ? 2 : 3;

        // Create the user
        $user = User::create([
            'nameUser' => $validated['nameUser'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),  // Hash the password
            'role' => $roleValue,
        ]);

        // Redirect to login page with a success message
        return redirect()->route('login')->with('success', 'User created successfully. Please log in.');
    }

    public function createAdmin()
    {
        // Create an admin user only if there isn't one already
        if (!User::where('role', 'admin')->exists()) {
            User::create([
                'nameUser' => 'AdminUser',   // Change as needed
                'email' => 'admin@gmail.com',  // Set a secure email
                'password' => bcrypt('admin@gmail.com'),  // Set a secure password
                'role' => 'admin',
            ]);

            return 'Admin user created successfully.';
        }

        return 'Admin user already exists.';
    }

    // Add other methods for updating and deleting
}
