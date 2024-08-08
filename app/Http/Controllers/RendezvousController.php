<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use Illuminate\Http\Request;

class RendezvousController extends Controller
{
    public function index(){
        $pageTitle = 'Mes Rendez Vous';
        $candidats = Candidat::where('id_utilisateur', auth()->user()->id) 
            ->whereNotNull('date_rdv')
            ->orderBy('date_rdv', 'desc')
            ->get();
        return view('rendezvous.index', [
            'candidats' => $candidats,
            'page' => $pageTitle,
        ]);
    }
}
