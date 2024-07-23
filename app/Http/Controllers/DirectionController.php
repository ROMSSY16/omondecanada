<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\consultante;
use App\Models\Depense;
use App\Models\Entree;
use App\Models\InfoConsultation;
use App\Models\Succursale;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DirectionController extends Controller
{
   
    
    public function Dashboard()
{
    setlocale(LC_TIME, 'fr_FR.utf8');
    $donneesSuccursales = $this->allSuccursalle();
    $donneesCandidat = $this->getAllCandidatsData();
    // Passez les données à la vue
    return view('Direction.Views.Dashboard', [
        'donneesSuccursales' => $donneesSuccursales ,
        'donneesCandidat' => $donneesCandidat
    ]);
}


public function getAllCandidatsData()
{
    $candidatsPagines = Candidat::has('entrees')
        ->join('entree', 'candidat.id', '=', 'entree.id_candidat')
        ->join('type_paiement', 'entree.id_type_paiement', '=', 'type_paiement.id')
        ->join('users', 'candidat.id_utilisateur', '=', 'users.id')
        ->join('succursale', 'users.id_succursale', '=', 'succursale.id')
        ->select(
            'candidat.id',
            'candidat.nom',
            'candidat.prenom',
            'type_paiement.label as type_paiement',
            DB::raw('CONCAT(users.name, " ", users.last_name, " / ", succursale.label) as agent_succursale'),
            'entree.montant as montant_dernier_paiement',
            'entree.date as date_dernier_paiement'
        )
        ->orderBy('entree.date', 'desc')
        ->get();

    return $candidatsPagines;
}

public function dataSuccursale()
{
    // Obtenez le mois actuel
    $moisActuel = now()->format('m');
    // Obtenez la liste des succursales
    $succursales = Succursale::all();
    $donneesSuccursales = [];
    // Itérez sur chaque succursale
    foreach ($succursales as $succursale) {
        // Obtenez le total du mois en cours pour la succursale actuelle (entrées)
        $totalEntrant = Entree::whereMonth('date', $moisActuel)
            ->whereHas('utilisateur', function ($query) use ($succursale) {
                $query->where('id_succursale', $succursale->id);
            })
            ->sum('montant');
        // Obtenez le total du mois en cours pour les dépenses de la succursale actuelle
        $totalDepenses = Depense::whereMonth('date', $moisActuel)
            ->whereHas('utilisateur', function ($query) use ($succursale) {
                $query->where('id_succursale', $succursale->id);
            })
            ->sum('montant');
        // Déterminez la devise en fonction de la succursale
        $devise = ($succursale->id == 4) ? '$' : 'FCFA';
        // Stockez les totaux dans le tableau associatif
        $donneesSuccursales[] = [
            'id' => $succursale->id, // Ajoutez l'ID de la succursale ici
            'label' => $succursale->label,
            'totalEntrant' => $totalEntrant ,
            'totalDepenses' => $totalDepenses ,
            'totalCaisse' => $totalEntrant - $totalDepenses ,
            'devise' => $devise ,
            // Ajoutez d'autres données si nécessaire
        ];
    }
    // Retournez le tableau sous forme de JSON
    return response()->json($donneesSuccursales);
}



private function allSuccursalle()
{
    // Obtenez le mois actuel
    $moisActuel = now()->format('m');
    
    // Obtenez la liste des succursales
    $succursales = Succursale::where('label', '!=', 'Canada')->get();


    $donneesSuccursales = [];

    // Itérez sur chaque succursale
    foreach ($succursales as $succursale) {
        // Obtenez le total du mois en cours pour la succursale actuelle (entrées)
        $totalEntrant = Entree::whereMonth('date', $moisActuel)
            ->whereHas('utilisateur', function ($query) use ($succursale) {
                $query->where('id_succursale', $succursale->id);
            })
            ->sum('montant');

        // Obtenez le total du mois en cours pour les dépenses de la succursale actuelle
        $totalDepenses = Depense::whereMonth('date', $moisActuel)
            ->whereHas('utilisateur', function ($query) use ($succursale) {
                $query->where('id_succursale', $succursale->id);
            })
            ->sum('montant');

        // Déterminez la devise en fonction de la succursale
        $devise = ($succursale->id == 4) ? '$' : 'FCFA';

        // Stockez les totaux dans le tableau associatif
        $donneesSuccursales[$succursale->label] = [
            'totalEntrant' => $totalEntrant ,
            'totalDepenses' => $totalDepenses ,
            'devise' => $devise ,
            // Ajoutez d'autres données si nécessaire
        ];
    }

    // Retournez le tableau associatif
    return $donneesSuccursales;
}
    
        
    public function Banque()
{
    setlocale(LC_TIME, 'fr_FR.utf8');
    $transactionController = new Controller();
    $donneesCandidat = $transactionController->getAllTransactions();

   

    // Passez les données à la vue
    return view('Direction.Views.Banque', [
        'donneesCandidat' => $donneesCandidat
    ]);
}

public function ChartData()
{
    // Utilisateur connecté
    $utilisateurConnecte = Auth::user();

    // Année actuelle
    $anneeActuelle = Carbon::now()->year;

    // Récupérez les données de la base de données pour l'année actuelle
    $data = Entree::whereYear('date', $anneeActuelle)
        ->join('users', 'entree.id_utilisateur', '=', 'users.id')
        ->join('succursale', 'users.id_succursale', '=', 'succursale.id')
        ->select('entree.*', 'succursale.label as succursale')
        ->get();

    // Formatez les données pour le graphique
    $formattedData = $this->formatChartData($data);

    // Retournez les données au format JSON
    return response()->json($formattedData);
}

private function formatChartData($data)
{
    // Initialisez un tableau pour stocker les données formatées
    $formattedData = [];

    // Groupement des données par succursale et par mois
    $groupedData = $data->groupBy(['succursale', function ($entry) {
        return Carbon::parse($entry->date)->format('M');
    }]);

    // Bouclez à travers les données groupées et formatez-les
    foreach ($groupedData as $succursale => $dataByMonth) {
        foreach ($dataByMonth as $month => $entries) {
            // Calculez la somme des montants pour le mois actuel
            $totalMontant = $entries->sum('montant');

            $formattedData[] = [
                'succursale' => $succursale,
                'month' => $month,
                'totalMontant' => $totalMontant,
            ];
        }
    }

    // Retournez les données formatées
    return $formattedData;
}

public function Consultation(){

    Carbon::setLocale('fr');
    
    $consultations = InfoConsultation::with(['consultante', 'candidats'])
        ->orderBy('date_heure', 'desc')
        ->get();

    $consultations->transform(function ($consultation) {
        if ($consultation->date_heure) {
            $date_heure = Carbon::parse($consultation->date_heure);
            $consultation->datePassee = $date_heure->isPast();
            $consultation->dateFormatee = $date_heure->translatedFormat('l j F Y H:i');
        } else {
            $consultation->datePassee = false; // Ou toute autre valeur par défaut que vous souhaitez définir
            $consultation->dateFormatee = 'N / A';
        }
        return $consultation;
    });

    return view('Direction.Views.Consultation', ['consultations' => $consultations]);
}



public function DossierClient(){

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
  
      return view('Direction.Views.DossierClient', ['data_client' => $candidats, 'dates_paiement' => $datesPaiement]);
  
  
   
}

public function Equipe(){
 
   $users  = \App\Models\User::all();

    return view('Direction.Views.Equipe', ['users' => $users]);
  }

  
}
