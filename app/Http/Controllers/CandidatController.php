<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use Illuminate\Http\Request;
use App\Models\InfoConsultation;
use Illuminate\Support\Facades\Auth;

class CandidatController extends Controller
{
    public function index(){
        return view('candidats.index');
    }
    public function saveRemarques(Request $request, $id){

        $candidat = Candidat::find($id);
        $candidat->update([
            'remarque_consultante' => $request->input('consultant_opinion'),
            'status' => '1',
        ]);
        if ($candidat) {
            return redirect()->route('consultation.listcandidats', ['id' => $candidat->infoConsultation->id])
                            ->with('success', 'Remarques ajoutées avec succès');
        }
        return redirect()->back()->with('error', 'Erreur lors de l\'ajout des remarques');

    }
}
