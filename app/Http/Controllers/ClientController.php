<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Entree;
use App\Models\Candidat;
use App\Models\RendezVous;
use Illuminate\Http\Request;
use App\Models\InfoConsultation;

class ClientController extends Controller
{
    public function index()
    {
        $pageTitle = 'Liste des Clients';

        Carbon::setLocale('fr');
        $idSuccursaleUtilisateur = auth()->user()->id_succursale;
        $now = Carbon::yesterday();

        $clients = Candidat::whereHas('rendezVous', function ($query) use ($idSuccursaleUtilisateur) {
                $query->where('consultation_payee', '1')
                    ->whereHas('commercial', function ($q) use ($idSuccursaleUtilisateur) {
                        $q->where('id_succursale', $idSuccursaleUtilisateur);
                    });
            })
            ->orderByDesc('date_enregistrement')
            ->get()
            ->each(function ($client) {
                $client->dateFormatee = $client->infoConsultation
                    ? ucwords(Carbon::parse($client->infoConsultation->date_heure)->translatedFormat('l j F Y H:i'))
                    : 'N / A';
            });
            //dd($clients);

        $consultations = InfoConsultation::where('nombre_candidats', '>', function ($query) {
                $query->selectRaw('count(*)')
                    ->from('candidat')
                    ->whereColumn('info_consultation.id', 'candidat.id_info_consultation');
            })
            ->where('date_heure', '>', $now)
            ->get()
            ->each(function ($consultation) {
                $consultation->dateFormatee = ucwords(Carbon::parse($consultation->date_heure)->translatedFormat('l j F Y H:i'));
            });

       

        return view('client.index', [
            'pageTitle' => $pageTitle, 
            'clients' => $clients, 
            'consultationsDisponible' => $consultations,
            ]);
    }


    public function succursaleClients(){
        $pays = auth()->user()->succursale->label;
        $pageTitle = 'Clients'.' '.$pays;
        $idSuccursaleUtilisateur = auth()->user()->id_succursale;
        $candidatsSuccursalle = Candidat::whereHas('utilisateur', function ($query) use ($idSuccursaleUtilisateur) {
            $query->where('id_succursale', $idSuccursaleUtilisateur);
        })->orderBy('date_enregistrement', 'desc')->paginate(10);

        return view('contact.succursale', [
            'data_candidat' => $candidatsSuccursalle,
            'pageTitle' => $pageTitle,
            'pays' => $pays,
        ]);
    }
}
