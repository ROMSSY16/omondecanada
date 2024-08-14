<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\RendezVous;
use Illuminate\Http\Request;

class RendezvousController extends Controller
{
    public function index(){
        $pageTitle = 'Mes Rendez Vous';
        $candidats = Candidat::where('id_utilisateur', auth()->user()->id) 
            ->whereNotNull('date_rdv')
            ->orderBy('date_rdv', 'desc')
            ->paginate(5);
        return view('rendezvous.index', [
            'candidats' => $candidats,
            'pageTitle' => $pageTitle,
        ]);
    }
    public function confirmRendezVous($id){
        $candidat = Candidat::findOrFail($id);
        $candidat->update([
            'consultation_payee' => '1',
        ]);
        $rendezvous = RendezVous::where('candidat_id', $candidat->id)->first();
        $rendezvous->update([
            'rdv_effectue' => '1',
        ]);
        return redirect()->back()->with('success', 'Rendez Vous confirmé avec succès.');
    }

    public function cancelRendezVous($id){
        $candidat = Candidat::findOrFail($id);
        $candidat->update([
            'consultation_effectuee' => '0',
        ]);
        $rendezvous = RendezVous::where('candidat_id', $candidat->id)->first();
        $rendezvous->update([
            'rdv_effectue' => '0',
        ]);
        return redirect()->back()->with('success', 'Rendez Vous confirmé avec succès.');
    }
}
