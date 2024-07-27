<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Entree;
use App\Models\Depense;
use App\Models\Candidat;
use App\Models\Succursale;
use App\Models\consultante;
use App\Models\InfoConsultation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        $pageTitle = 'Banque';
        setlocale(LC_TIME, 'fr_FR.utf8');
        $transactionController = new Controller();
        $donneesCandidat = $transactionController->getAllTransactions();

        return view('Direction.Views.Banque', [
            'donneesCandidat' => $donneesCandidat,
            'page' => $pageTitle,
        ]);
    }

public function ChartData()
{
    $anneeActuelle = Carbon::now()->year;
    $data = Entree::whereYear('date', $anneeActuelle)
        ->join('users', 'entree.id_utilisateur', '=', 'users.id')
        ->join('succursale', 'users.id_succursale', '=', 'succursale.id')
        ->select('entree.*', 'succursale.label as succursale')
        ->get();
    $formattedData = $this->formatChartData($data);

    return response()->json($formattedData);
}

private function formatChartData($data)
    {

        $formattedData = [];

        $groupedData = $data->groupBy(['succursale', function ($entry) {
            return Carbon::parse($entry->date)->format('M');
        }]);

        foreach ($groupedData as $succursale => $dataByMonth) {
            foreach ($dataByMonth as $month => $entries) {
                $totalMontant = $entries->sum('montant');
                $formattedData[] = [
                    'succursale' => $succursale,
                    'month' => $month,
                    'totalMontant' => $totalMontant,
                ];
            }
        }
        return $formattedData;
    }

public function Consultation()
    {

    $pageTitle = 'Consultations';
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
            $consultation->datePassee = false; 
            $consultation->dateFormatee = 'N / A';
        }
        return $consultation;
    });

    return view('Direction.Views.Consultation', [
        'consultations' => $consultations,
        'page' => $pageTitle,
    ]);
    }



public function DossierClient()
{
    $pageTitle = 'Dossier client';

      $idSuccursaleUtilisateur = auth()->user()->id_succursale;
      $entreesType2 = Entree::where('id_type_paiement', 2)
          ->whereHas('utilisateur', function ($query) use ($idSuccursaleUtilisateur) {
              $query->where('id_succursale', $idSuccursaleUtilisateur);
          })
          ->get();

      $candidats = Candidat::whereIn('id', $entreesType2->pluck('candidat_id'))->get();
      $datesPaiement = [];
      foreach ($entreesType2 as $entree) {
          $datesPaiement[$entree->id_candidat] = $entree->date;
      }
      $candidats = $candidats->sortByDesc(function ($candidat) use ($datesPaiement) {
          return $datesPaiement[$candidat->id];
      });
  
      return view('Direction.Views.DossierClient', [
        'data_client' => $candidats, 
        'dates_paiement' => $datesPaiement,
        'page' => $pageTitle,
    ]);
  
}

public function Equipe(){

    $pageTitle = 'Equipe';
   $users  = User::get();

    return view('Direction.Views.Equipe', [
        'users' => $users,
        'page' => $pageTitle,
    ]);
  }

  
}
