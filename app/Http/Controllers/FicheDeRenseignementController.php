<?php
// app/Http/Controllers/FicheDeRenseignementController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class FicheDeRenseignementController extends Controller
{
    public function showForm()
    {
        $categories = Category::with('questions')->get();
        return view('Administratif.Partials.AddFicheRens', 'categories');
    }
}
