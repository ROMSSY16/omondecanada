<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\consultante;
use App\Models\InfoConsultation;
use App\Models\RendezVous;

use App\Http\Controllers\AdministratifController as AdminCont;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InformatiqueController extends Controller
{
    //


    public function Equipe()
    {

        $users  = \App\Models\User::all();

        return view('Informatique.Views.Equipe', ['users' => $users]);
    }

    public function Consultation()
    {
        Carbon::setLocale('fr');
        $consultantes = consultante::all();
        $consultations = InfoConsultation::orderBy('date_heure', 'desc')->get();
        $consultations->transform(function ($consultations) {
            if ($consultations->date_heure) {
                $dateFormatee = Carbon::parse($consultations->date_heure)->translatedFormat('l j F Y H:i');
                $consultations->dateFormatee = ucwords($dateFormatee);
            } else {
                $consultations->dateFormatee = 'N / A'; // Ou toute autre valeur par défaut que vous souhaitez afficher pour les valeurs nulles
            }
            return $consultations;
        });
        return view('Informatique.Views.Consultation', ['data_consultante' => $consultantes, 'consultations' => $consultations]);
    }
    public function Client(){
        $clients = $this->allClients();
        $adminController = new AdminCont;
        $consultations = $adminController->consultationsDisponible();
        
        return view('Informatique.Views.Candidat', ['clients' => $clients, 'consultationsDisponible' => $consultations]);


    }
    public function allClients()
    {
        Carbon::setLocale('fr');

        // Obtenir l'utilisateur connecté
        $idSuccursaleUtilisateur = auth()->user()->id_succursale;

        // Obtenez les candidats avec les rendez-vous et la consultation payée pour le commercial de la même succursale
        $clientsIds = RendezVous::where('consultation_payee', 1)
            ->orderBy('date_rdv', 'desc')
            ->pluck('candidat_id'); // Supposons que la clé étrangère soit id_candidat

        $clients = Candidat::whereIn('id', $clientsIds)
            ->orderBy('date_enregistrement', 'desc')
            ->get();

        // Convertir la date et l'heure pour chaque candidat
        $clients->transform(function ($client) {
            if ($client->infoConsultation) {
                $dateFormatee = Carbon::parse($client->infoConsultation->date_heure)->translatedFormat('l j F Y H:i');
                $client->dateFormatee = ucwords($dateFormatee);
            } else {
                $client->dateFormatee = 'N / A'; // Ou toute autre valeur par défaut que vous souhaitez afficher pour les valeurs nulles
            }
            return $client;
        });



        return $clients;
    }
}
