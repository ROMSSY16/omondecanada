<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Entree;
use App\Models\Depense;
use App\Models\Candidat;
use App\Models\RendezVous;
use Illuminate\Http\Request;
use App\Models\InfoConsultation;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    public  function userAuth()
    {
        return ['user' => auth()->user()];
    }

    public function dashboard(){
        $pageTitle = 'Tableau de bord';

        if ($this->userAuth()['user']['role_as'] == 'direction') {

            return view('dashboard', [
                'page' => $pageTitle, 
            ]);
        }

        if ($this->userAuth()['user']['role_as'] == 'consultante') {

            return view('dashboard', [
                'page' => $pageTitle, 
            ]);
        }
        if ($this->userAuth()['user']['role_as'] == 'commercial') {

            Carbon::setLocale('fr');
            $jourActuel = Carbon::now()->translatedFormat('d F Y');
            $moisActuel = Carbon::now()->monthName;
            $anneeActuelle = Carbon::now()->year;

            $utilisateurConnecte = auth()->user();
  
            $totalAppelDeCeJour = RendezVous::whereDate('date_enregistrement_appel', Carbon::now())
                ->where('commercial_id' , $utilisateurConnecte->id )
                ->count();
            $totalVisiteAujourdhui = RendezVous::whereDate('date_enregistrement_appel', Carbon::now())
                ->where('commercial_id' , $utilisateurConnecte->id )
                ->whereNotNull('date_rdv')
                ->count();
            $totalConsultationsDeCeMois = RendezVous::where('consultation_payee', true)
                ->whereMonth('date_rdv', $moisActuel)
                ->whereYear('date_rdv', $anneeActuelle)
                ->where('commercial_id', $utilisateurConnecte->id)
                ->count();
            $rendezVous = Candidat::where('id_utilisateur', $utilisateurConnecte->id)
                ->whereDate('date_rdv', Carbon::today())
                ->orderBy('date_enregistrement', 'desc')
                ->get();

            return view('dashboard', [
                'totalAppelDeCeJour' => $totalAppelDeCeJour, 
                'totalVisiteAujourdhui' => $totalVisiteAujourdhui,
                'totalConsultationsDeCeMois' => $totalConsultationsDeCeMois, 
                'jourActuel' => $jourActuel, 
                'moisActuel' => $moisActuel, 
                'rendezVous' => $rendezVous,
                'page' => $pageTitle, 
            ]);
        }
        if ($this->userAuth()['user']['role_as'] == 'administratif') {

            $entreeMensuelData = Entree::where('id_utilisateur', auth()->user()->id)
                ->whereMonth('date', now()->month)
                ->whereYear('date', now()->year)
                ->sum('montant');

            $depenseMensuel = Depense::where('id_utilisateur', auth()->user()->id)
                ->whereMonth('date', now()->month)
                ->whereYear('date', now()->year)
                ->sum('montant');

            $caisseMensuel = $entreeMensuelData - $depenseMensuel;

            $nombreConsultationData = Entree::where('id_utilisateur', auth()->user()->id)
                ->where('id_type_paiement', 2)
                ->whereMonth('date', now()->month)
                ->whereYear('date', now()->year)
                ->count();

            $nombreVersementData = Entree::where('id_utilisateur', auth()->user()->id)
                ->where('id_type_paiement', 1)
                ->whereMonth('date', now()->month)
                ->whereYear('date', now()->year)
                ->count();

            $devise = auth()->user()->id_succursale;
            // if ($devise === 4) {
            //     return '$';
            // } else {
            //     return 'FCFA';
            // }

            $consultations = InfoConsultation::where('date_heure', '>=', Carbon::today())
                ->orderBy('date_heure')
                ->take(4)
                ->get();

            $consultations->transform(function ($consultation) {
                $dateFormatee = Carbon::parse($consultation->date_heure)->translatedFormat('l j F Y H:i');
                $consultation->dateFormatee = ucwords($dateFormatee);
                return $consultation;
            });

            return view('dashboard', [
                'entreeMensuel' => $entreeMensuelData,
                'moisEnCours' => now()->month,
                'devise' => $devise,
                'nombreConsultationMensuel' => $nombreConsultationData,
                'nombreVersementMensuel' => $nombreVersementData,
                'consultations' => $consultations,
                'caisse' => $caisseMensuel,
                'page' => $pageTitle, 
            ]);

        }
        if ($this->userAuth()['user']['role_as'] == 'informaticien') {

            return view('dashboard', [
                'page' => $pageTitle, 
            ]);
        }
    }
     
    public function DossierContacts()
    {
        return view('Contact.DossierContacts');
    }
    public function DossierClients()
    {
        return view('Client.DossierClients');
    }
    public function Banque()
    {
        return view('Banque.Banque');
    }
   
    public function Consultation()
    {
        return view('Consultation');
    }
    public function dashBoardConsultante()
    {
        return view('Consultante.dashBoardConsultante');
    }

    public function adminDashboard()
    {
        return view('AdminDashboard.adminDashboard');
    }

    public function connexion()
    {
        return view('Connexion.connexionPage');
    }

    public function dossier()
    {
        return view('DocumentClients.documentClients');
    }
    public function equipeView()
    {
        return view('Equipe.Team');
    }
    public function documentAgent()
    {
        return view('DocumentsAgents.documentAgent');
    }


    // Recuperer tous candidats
    public function allCandidat()
    {
        $pageTitle = 'Tous les candidats';

        $idSuccursaleUtilisateur = auth()->user()->id_succursale;

        $candidats = Candidat::whereHas('utilisateur', function ($query) use ($idSuccursaleUtilisateur) {
            $query->where('id_succursale', $idSuccursaleUtilisateur);
        })
        ->orderBy('date_enregistrement', 'desc')
        ->get();
    
        return view('Contact.DossierContacts', [
            'data_candidat' => $candidats,
            'page' => $pageTitle, 
        ]);
     
    }
 
    public function allClient() {
        $pageTitle = 'Dossier Clients';

        $idSuccursaleUtilisateur = auth()->user()->id_succursale;
        $entreesType2 = Entree::where('id_type_paiement', 2)
            ->whereHas('utilisateur', function ($query) use ($idSuccursaleUtilisateur) {
                $query->where('id_succursale', $idSuccursaleUtilisateur);
            })
            ->get();
        $candidats = Candidat::whereIn('id', $entreesType2->pluck('id_candidat'))->get();
    
        $datesPaiement = [];
        foreach ($entreesType2 as $entree) {
            $datesPaiement[$entree->id_candidat] = $entree->date;
        }
        $candidats = $candidats->sortByDesc(function ($candidat) use ($datesPaiement) {
            return $datesPaiement[$candidat->id];
        });
    
        return view('Client.DossierClients', [
            'data_client' => $candidats, 
            'dates_paiement' => $datesPaiement,
            'page' => $pageTitle, 
        ]);
    }


    public function saveRemarques(Request $request, $id)
    {
       
        $remarques = $request->input('consultant_opinion');
    
        $candidat = Candidat::find($id);
    
        if ($candidat) {
            $candidat->remarque_consultante = $remarques;
            $candidat->save();
    
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'error' => 'Candidat not found.']);
    }
    
    

   
}
