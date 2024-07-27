<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\ModelNotFoundException; // Add this line

use Carbon\Carbon;
use App\Models\Candidat;
use Illuminate\Support\Facades\Auth;
use App\Models\RendezVous;
use App\Models\User;

class CommercialController extends Controller
{

    public function Contacts(){
        $pageTitle = 'Contacts';
        $pays = auth()->user()->succursale->label;
        $consultants = User::where('role_as', 'consultante')->orderBy('created_at', 'desc')->get();
        $candidatsAgents = Candidat::where('id_utilisateur', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(5);

        return view('Commercial.contacts', [
            'data_candidat' => $candidatsAgents,
            'page' => $pageTitle,
            'pays' => $pays,
            'consultants' => $consultants,
        ]);
    }
    public function succursaleContacts(){
        $pays = auth()->user()->succursale->label;
        $pageTitle = 'Contacts'.' '.$pays;
        $idSuccursaleUtilisateur = auth()->user()->id_succursale;
        $candidatsSuccursalle = Candidat::whereHas('utilisateur', function ($query) use ($idSuccursaleUtilisateur) {
            $query->where('id_succursale', $idSuccursaleUtilisateur);
        })->orderBy('date_enregistrement', 'desc')->get();

        return view('Commercial.contacts_succursale', [
            'data_candidat' => $candidatsSuccursalle,
            'page' => $pageTitle,
            'pays' => $pays,
        ]);
    }
    public function rendezVous(){
        $pageTitle = 'Rendez Vous';
        $candidats = Candidat::where('id_utilisateur', auth()->user()->id) 
            ->whereNotNull('date_rdv')
            ->orderBy('date_rdv', 'desc')
            ->get();
        return view('Commercial.rendezvous', [
            'candidats' => $candidats,
            'page' => $pageTitle,
        ]);
    }

    public function appelChartData()
    {
        // Obtenez l'utilisateur connecté
        $utilisateurConnecte = Auth::user();
    
        // Obtenez la date de début et de fin de la semaine actuelle
        $debutSemaine = Carbon::now()->startOfWeek();
        $finSemaine = Carbon::now()->endOfWeek();
    
        // Récupérez les données de la base de données pour la semaine actuelle
        $data = RendezVous::whereBetween('date_enregistrement_appel', [$debutSemaine, $finSemaine])
            ->where('commercial_id', $utilisateurConnecte->id)
            ->orderBy('date_enregistrement_appel')
            ->get();
    
        // Convertir les noms des jours en français
        $jours = ['Monday' => 'Lundi', 'Tuesday' => 'Mardi', 'Wednesday' => 'Mercredi', 'Thursday' => 'Jeudi', 'Friday' => 'Vendredi', 'Saturday' => 'Samedi', 'Sunday' => 'Dimanche'];
    
        $data->transform(function ($item, $key) use ($jours) {
            $dateEnregistrement = Carbon::parse($item->date_enregistrement_appel);
            $jourSemaineAnglais = $dateEnregistrement->format('l');
            $item->jour_semaine = $jours[$jourSemaineAnglais];
            return $item;
        });
    
        // Grouper les données par jour de la semaine et obtenir le compte pour chaque jour
        $data = $data->groupBy('jour_semaine')->map(function ($item, $key) {
            return ['jour_semaine' => $key, 'nombre_visite' => $item->count()];
        })->values();
        
    
        // Retournez les données au format JSON
        return response()->json($data);
    }
    
    

    public function consultationChartData()
    {
        // Obtenez l'utilisateur connecté
        $utilisateurConnecte = Auth::user();
    
        // Obtenez l'année actuelle
        $currentYear = Carbon::now()->year;
    
        // Récupérez les données de la base de données pour l'année actuelle
        $data = RendezVous::whereYear('date_rdv', $currentYear)
            ->where('consultation_payee', 1) // Assurez-vous que le type de paiement correspond à celui que vous utilisez
            ->where('commercial_id', $utilisateurConnecte->id)
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
    
        // Groupement des données par mois
        $groupedData = $data->groupBy(function ($entry) {
            return Carbon::parse($entry->date_rdv)->format('M'); // Utilisez la colonne correcte ici (date_rdv)
        });
    
        // Bouclez à travers les données groupées et formatez-les
        foreach ($groupedData as $month => $entries) {
            $formattedData[] = [
                'month' => $month,
                'count' => count($entries),
            ];
        }
    
        // Retournez les données formatées
        return $formattedData;
    }
    

    public function contactSuccursalle()
    {
        // Obtenir l'utilisateur connecté
        $idSuccursaleUtilisateur = auth()->user()->id_succursale;

        // Obtenir les données des candidats liés à la succursale de l'utilisateur
        $candidats = Candidat::whereHas('utilisateur', function ($query) use ($idSuccursaleUtilisateur) {
            $query->where('id_succursale', $idSuccursaleUtilisateur);
        })
            ->orderBy('date_enregistrement', 'desc')
            ->get();

        return $candidats;
    }

    

    public function addProspect(Request $request, $id = null)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'numero_telephone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'profession' => 'required|string|max:255',
            'date_rdv' => 'nullable|date',
        ]);

        $candidat = Candidat::create([
            'nom' => ucwords(strtolower($validated['nom'])),
            'prenom' => ucwords(strtolower($validated['prenoms'])),
            'pays' => ucwords(strtolower($validated['pays'])),
            'ville' => ucwords(strtolower($validated['ville'])),
            'numero_telephone' => $validated['numero_telephone'],
            'email' => $validated['email'],
            'profession' => ucwords(strtolower($validated['profession'])),
            'consultation_payee' => $request->consultation_payee,
            'id_utilisateur' => Auth::id(),
            'date_rdv' => $request->date_rdv ?? null,
        ]);

        if ($request->date_rdv) {
            $rendezVousData = [
                'date_rdv' => $request->date_rdv,
                'candidat_id' => $candidat->id,
                'commercial_id' => Auth::id(),
            ];
    
            $rendezVous = RendezVous::firstOrNew(['candidat_id' => $candidat->id]);
            $rendezVous->fill($rendezVousData);
            $rendezVous->save();
        }

        $message = $id ? 'Prospect updated successfully.' : 'Prospect added successfully.';
        return redirect()->route('commercial.contact')->with('success', $message);
        
        // $validatedData = $request->validate([
        //     'nom' => 'required|string|max:255',
        //     'prenoms' => 'required|string|max:255',
        //     'pays' => 'required|string|max:255',
        //     'ville' => 'required|string|max:255',
        //     'numero_telephone' => 'required|string|max:20',
        //     'email' => 'required|email|max:255',
        //     'profession' => 'required|string|max:255',
        //     'date_rdv' => 'nullable|date',
        // ]);
       
        //     $data = [
        //         'nom' => ucwords(strtolower($validatedData['nom'])),
        //         'prenom' => ucwords(strtolower($validatedData['prenoms'])),
        //         'pays' => ucwords(strtolower($validatedData['pays'])),
        //         'ville' => ucwords(strtolower($validatedData['ville'])),
        //         'numero_telephone' => $validatedData['numero_telephone'],
        //         'email' => $validatedData['email'],
        //         'profession' => ucwords(strtolower($validatedData['profession'])),
        //         'consultation_payee' => $request->has('consultation_payee'),
        //         'id_utilisateur' => Auth::id(),
        //         'date_rdv' => $request->has('date_rdv') ? $validatedData['date_rdv'] : null,
        //     ];
            
        //     try {
        //         $candidat = $id ? Candidat::findOrFail($id) : new Candidat;
        //         $candidat->fill($data);
        //         $candidat->save();
            
        //         if ($request->filled('date_rdv')) {
        //             $rendezVousData = [
        //                 'date_rdv' => $validatedData['date_rdv'],
        //                 'candidat_id' => $candidat->id,
        //                 'commercial_id' => Auth::id(),
        //             ];
            
        //             $rendezVous = RendezVous::firstOrNew(['candidat_id' => $candidat->id]);
        //             $rendezVous->fill($rendezVousData);
        //             $rendezVous->save();
        //         }

        //         $message = $id ? 'Prospect updated successfully.' : 'Prospect added successfully.';
        //     return redirect()->route('Commercial.Contacts')->with('success', $message);
        // } catch (\Exception $e) {
        //     return redirect()->back()->withErrors(['error' => 'An unexpected error occurred.'])->withInput();
        // }
    }

     
    

    public function changeStatutConsultationPayee($id, $statut)
    {
        try {
            $rendezVous = RendezVous::findOrFail($id);
            $rendezVous->consultation_payee = ($statut === 'yes');
            $rendezVous->save();
    
            return response()->json([
                'status' => 'success',
                'message' => 'Consultation status changed successfully.'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'RendezVous with ID ' . $id . ' not found.'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while changing the consultation status.'
            ], 500);
        }
    }
    
    public function changeStatutRendezVous($id, $statut)
    {
        try {
            $rendezVous = RendezVous::findOrFail($id);
            $rendezVous->rdv_effectue = ($statut === 'yes');
            $rendezVous->save();
    
            return response()->json([
                'status' => 'success',
                'message' => 'Consultation status changed successfully.'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'RendezVous with ID ' . $id . ' not found.'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while changing the consultation status.'
            ], 500);
        }
    }
    

     
    
}
