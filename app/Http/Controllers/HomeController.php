<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Candidat;
use App\Models\Entree;



class HomeController extends Controller
{


    //Fonction qui ramene les dashbords en fonctions des roles
    public function index()
    {
        // Vérifiez si l'utilisateur est connecté
        if (Auth::check()) {
            // Obtenez le rôle de l'utilisateur
            $userRole = Auth::user()->id_role_utilisateur;
    
            // Redirigez l'utilisateur en fonction de son rôle
            switch ($userRole) {
                case 0:
                    // Consultante, redirigez-la vers la page "Dashboard Consultante"
                    return redirect()->route('Consultante.Dashboard');
                    case 1:
                    // Commercial, redirigez-le vers le dashboard Commercial
                    return redirect()->route('Commercial.Dashboard');
                    
                case 2:
                    // Administratif, redirigez-le vers le dashboard Administratif
                    return redirect()->route('Administratif.Dashboard');
                  
                case 3:
                    // Informatique, redirigez-le vers le dashboard Informatique
                    return redirect()->route('Informatique.Dashboard');
                    case 4:
                    // Direction, redirigez-le vers le dashboard Direction
                    return redirect()->route('Direction.Dashboard');
                default:
                    // Si le rôle n'est pas reconnu, redirigez-le vers la page de connexion
                    return redirect()->route('login');
            }
        }
    
        // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
        return redirect()->route('login');
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
        // Obtenir l'utilisateur connecté
        $idSuccursaleUtilisateur = auth()->user()->id_succursale;
    
            // Obtenir les données des candidats liés à la succursale de l'utilisateur
            $candidats = Candidat::whereHas('utilisateur', function ($query) use ($idSuccursaleUtilisateur) {
                $query->where('id_succursale', $idSuccursaleUtilisateur);
            })
            ->orderBy('date_enregistrement', 'desc')
            ->get();
    
            // Passer les données à la vue principale
            return view('Contact.DossierContacts', ['data_candidat' => $candidats]);
     
    }
    
 
    // Recuperer tous clients
    public function allClient() {
        // Récupérer l'id de la succursale de l'utilisateur en cours
        $idSuccursaleUtilisateur = auth()->user()->id_succursale;
    
        // Récupérer la liste des entrees de type 2 liées à la succursale de l'utilisateur
        $entreesType2 = Entree::where('id_type_paiement', 2)
            ->whereHas('utilisateur', function ($query) use ($idSuccursaleUtilisateur) {
                $query->where('id_succursale', $idSuccursaleUtilisateur);
            })
            ->get();
    
        // Récupérer les candidats liés à ces entrées
        $candidats = Candidat::whereIn('id', $entreesType2->pluck('id_candidat'))->get();
    
        // Créer un tableau associatif pour stocker la date de paiement correspondante à chaque candidat
        $datesPaiement = [];
        foreach ($entreesType2 as $entree) {
            $datesPaiement[$entree->id_candidat] = $entree->date;
        }
    
        // Trier les candidats par date de paiement (de la plus récente à la plus ancienne)
        $candidats = $candidats->sortByDesc(function ($candidat) use ($datesPaiement) {
            return $datesPaiement[$candidat->id];
        });
    
        return view('Client.DossierClients', ['data_client' => $candidats, 'dates_paiement' => $datesPaiement]);
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
    
        // If Candidat with the given ID is not found
        return response()->json(['success' => false, 'error' => 'Candidat not found.']);
    }
    


   
}
