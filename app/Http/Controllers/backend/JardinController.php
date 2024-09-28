<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JardinController extends Controller
{
    public function index()
    {
        return view(view: 'backend.jardin.jardin');
    }

    public function edit()
    {
        return view('backend.jardin.editJardin');
    }


}
