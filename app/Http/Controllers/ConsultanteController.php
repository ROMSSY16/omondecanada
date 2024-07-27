<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidat;
use App\Models\consultante;
use App\Models\InfoConsultation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ConsultanteController extends Controller
{
    public function Dashboard()
    {
        return view('Consultante.Views.Dashboard');
    }

    public function getListCandidatByConsultation($id)
    {
        $page = 'Liste des candidats';

        $info_consultation = InfoConsultation::find($id);
        $info_consultation->date_heure = ucfirst(Carbon::parse($info_consultation->date_heure)->translatedFormat('d F Y'));

        $info_consultation->load(['candidats' => function ($query) {
            $query->join('entree', 'candidat.id', '=', 'entree.id_candidat')
            ->where('entree.id_type_paiement', 2)
            ->orderBy('entree.date', 'asc')
            ->select('candidat.*');
        }]);
        

        return view('Consultante.listcandidats', compact('info_consultation', 'page'));
    }



    public function getCandidatByConsultation($id, $id_candidat)
    {
        $page = 'Candidat';

        $info_consultation = InfoConsultation::find($id);
        $candidats = $info_consultation->candidats()->pluck('id')->toArray();
        $currentIndex = array_search($id_candidat, $candidats);
        $previousId = $candidats[$currentIndex - 1] ?? null;
        $nextId = $candidats[$currentIndex + 1] ?? null;
        $consultation = Candidat::find($id_candidat);
        return view('Consultante.candidat', compact('info_consultation', 'consultation', 'previousId', 'nextId', 'page'));
    }


    public function DossierClient()
    {
        $page = 'Dossier Client';

        $userId = Auth::id();
        $consultantId = consultante::where('id_utilisateur', $userId)->value('id');


        // Récupérer la liste des candidats avec des procédures associées pour le consultant connecté
        $candidats = Candidat::whereHas('proceduresDemandees', function ($query) use ($consultantId) {
            $query->where('consultante_id', $consultantId);
        })->get();

        return view('Consultante.Views.DossierClient', compact('candidats', 'page'));
    }

    public function myCandidat()
    {
        $page = 'Les candidats enregistrés';

        $consultantId = consultante::where('id_utilisateur', Auth::user()->id)->first();

        $candidats = Candidat::whereHas('proceduresDemandees', function ($query) use ($consultantId) {
            $query->where('consultante_id', $consultantId);
        })->get();

        return view('Consultante.my_candidat', compact('candidats', 'page'));
    }
    public function allCandidats()
    {
        $page = 'Les des candidats enregistrés';
        $candidats = Candidat::get();

        return view('Consultante.all_candidats', compact('candidats', 'page'));
    }
}
