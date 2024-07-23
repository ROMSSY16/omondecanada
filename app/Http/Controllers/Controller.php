<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\Depense;
use App\Models\Entree;
use App\Models\Procedure;
use App\Models\InfoConsultation;
use App\Models\FicheConsultation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public $timestamps = false;

    public function soumettreFormulaire(Request $request)
    {
        try {
            // Validation des données du formulaire
            $request->validate([
                'nom' => 'required|string|max:255',
                'prenoms' => 'required|string|max:255',
                'pays' => 'required|string|max:255',
                'ville' => 'required|string|max:255',
                'numero_telephone' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'profession' => 'required|string|max:255',
            ]);

            // Récupération de l'ID de l'utilisateur connecté
            $idUtilisateur = Auth::id();

            // Création du candidat
            $candidat = Candidat::create([
                'nom' => ucwords(strtolower($request->input('nom'))),
                'prenom' => ucwords(strtolower($request->input('prenoms'))),
                'pays' => ucwords(strtolower($request->input('pays'))),
                'ville' => ucwords(strtolower($request->input('ville'))),
                'numero_telephone' => $request->input('numero_telephone'),
                'email' => $request->input('email'),
                'profession' => ucwords(strtolower($request->input('profession'))),
                'consultation_payee' => $request->has('consultation_payee'),
                'id_utilisateur' => $idUtilisateur,
                'date_naissance' => $request->input('date_naissance'),
                'remarque_agent' => $request->has('consultation_payee') ? $request->input('remarques') : 'Sans Objet',
            ]);

            // Création du dossier pour les documents du candidat
            // Construction du chemin du dossier
            $dossierPath = 'public/dossierClient/' . substr($candidat->nom, 0, 2) . substr($candidat->prenom, 0, 1);

            // Vérification et création du dossier s'il n'existe pas
            if (!file_exists(storage_path($dossierPath))) {
                mkdir(storage_path($dossierPath), 0755, true);
            }

            // Initialisation du chemin du CV à null
            $cvPath = null;

            // Traitement du fichier CV s'il est présent et valide
            if ($request->hasFile('cv') && $request->file('cv')->isValid()) {
                // Générez un nom de fichier unique (par exemple, en utilisant le timestamp)
                $nomFichier = 'cv.pdf';

                // Enregistrez le CV dans le dossier spécifique du candidat avec un nom de fichier unique
                $cvPath = $request->file('cv')->storeAs($dossierPath, $nomFichier, 'public');
            }

            // Si la consultation est payée, créez une entrée et la fiche de consultation
            if ($candidat->consultation_payee) {
                $entree = Entree::create([
                    'id_candidat' => $candidat->id,
                    'montant' => 50000,
                    'date' => Carbon::now(),
                    'id_utilisateur' => $idUtilisateur,
                    'id_type_paiement' => 2,
                ]);

                FicheConsultation::create(
                    [
                        'id_candidat' => $candidat->id,
                        'lien_cv' => $cvPath,
                        'type_visa' => $request->input('type_visa'),
                        'reponse1' => $request->input('statut_matrimonial'),
                        'reponse2' => $request->input('passeport_valide'),
                        'reponse3' => $request->input('passeport_valide') == 'oui' ? $request->input('date_expiration_passeport') : 'Pas de Passeport valide',
                        'reponse4' => $request->input('casier_judiciaire'),
                        'reponse5' => $request->input('soucis_sante'),
                        'reponse6' => $request->input('enfants'),
                        'reponse7' => $request->input('enfants') == 'oui' ? $request->input('age_enfants') : "Pas d'enfant",
                        'reponse8' => $request->input('profession_domaine_travail'),
                        'reponse9' => $request->input('temps_travail_actuel'),
                        'reponse10' => $request->input('documents_emploi'),
                        'reponse11' => $request->input('procedure_immigration'),
                        'reponse12' => $request->input('procedure_immigration') == 'oui' ? $request->input('questions-procedure-immigration1') : 'Pas de procedure deja tentee',
                        'reponse13' => $request->input('procedure_immigration') == 'oui' ? $request->input('questions-procedure-immigration2') : 'Pas de procedure deja tentee',
                        'reponse14' => $request->input('diplome_etudes'),
                        'reponse15' => $request->input('annee_obtention_diplome') ?? 'Pas de diplomes',
                        'reponse16' => $request->input('membre_famille_canada'),
                        'reponse17' => $request->input('immigrer_seul_ou_famille'),
                        'reponse18' => $request->input('langues_parlees'),
                        'reponse19' => $request->input('test_connaissances_linguistiques'),
                        'reponse20' => $request->input('niveau_scolarite_conjoint'),
                        'reponse21' => $request->input('domaine_formation_conjoint'),
                        'reponse22' => $request->input('age_conjoint'),
                        'reponse23' => $request->input('niveau_francais'),
                        'reponse24' => $request->input('niveau_anglais'),
                        'reponse25' => $request->input('age_enfants_linguistique'),
                        'reponse26' => $request->input('niveau_scolarite_enfants'),
                    ]
                );
            }

            // Redirection vers le dossier contact
            return redirect()->route('DossierContacts')->with('success', 'Formulaire soumis avec succès.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Gérer les erreurs de validation
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Gérer les autres exceptions
            return redirect()->back()->withErrors(['error' => 'Une erreur inattendue s\'est produite.'])->withInput();
        }
    }


    public function modifierFormulaire(Request $request, $idCandidat)
    {
        try {
            // Validation du formulaire
            $request->validate([
                'nom' => 'required|string|max:255',
                'prenoms' => 'required|string|max:255',
                'pays' => 'required|string|max:255',
                'ville' => 'required|string|max:255',
                'numero_telephone' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'profession' => 'required|string|max:255',
            ]);

            // Récupération de l'ID de l'utilisateur connecté
            $idUtilisateur = Auth::id();

            // Récupération du candidat à modifier
            $candidat = Candidat::findOrFail($idCandidat);

            // Modification des informations du candidat
            $candidat->update([
                'nom' => ucwords(strtolower($request->input('nom'))),
                'prenom' => ucwords(strtolower($request->input('prenoms'))),
                'pays' => ucwords(strtolower($request->input('pays'))),
                'ville' => ucwords(strtolower($request->input('ville'))),
                'numero_telephone' => $request->input('numero_telephone'),
                'email' => $request->input('email'),
                'profession' => ucwords(strtolower($request->input('profession'))),
                'consultation_payee' => $request->has('consultation_payee'),
                'id_utilisateur' => $idUtilisateur,
                'date_naissance' => $request->input('date_naissance'),
                'remarque_agent' => $request->has('consultation_payee') ? $request->input('remarques') : 'Sans Objet',
            ]);

            // Récupération du chemin du CV existant
            $cvPath = $candidat->ficheConsultation->lien_cv ?? null;

            // Traitement du nouveau fichier CV s'il est présent et valide
            if ($request->hasFile('cv') && $request->file('cv')->isValid()) {
                // Générez un nom de fichier unique (par exemple, en utilisant le timestamp)
                $nomFichier = 'cv' . $candidat->id . '.' . $request->file('cv')->extension();

                // Créez le dossier du candidat s'il n'existe pas encore
                $dossierPath = 'dossierClient/' . substr($candidat->nom, 0, 2) . substr($candidat->prenom, 0, 1) . $candidat->id;
                if (!file_exists(storage_path('app/public/' . $dossierPath))) {
                    mkdir(storage_path('app/public/' . $dossierPath), 0755, true);
                }

                // Enregistrez le CV dans le dossier spécifique du candidat avec un nom de fichier unique
                $request->file('cv')->storeAs('public/' . $dossierPath, $nomFichier);

                // Mettez à jour le chemin du CV dans la base de données
                $cvPath = 'public/' . $dossierPath . '/' . $nomFichier;
            }


            // Si la consultation est payée, mettez à jour ou créez une entrée et une fiche de consultation
            if ($candidat->consultation_payee) {
                $entree = Entree::updateOrCreate(
                    ['id_candidat' => $candidat->id],
                    [
                        'montant' => 50000,
                        'date' => now(),
                        'id_utilisateur' => $idUtilisateur,
                        'id_type_paiement' => 2,
                    ]
                );

                FicheConsultation::updateOrCreate(
                    [
                        'id_candidat' => $candidat->id,
                    ],
                    [
                        'lien_cv' => $cvPath,
                        'type_visa' => $request->input('type_visa'),
                        'reponse1' => $request->input('statut_matrimonial'),
                        'reponse2' => $request->input('passeport_valide'),
                        'reponse3' => $request->input('passeport_valide') == 'oui' ? $request->input('date_expiration_passeport') : 'Pas de Passeport valide',
                        'reponse4' => $request->input('casier_judiciaire'),
                        'reponse5' => $request->input('soucis_sante'),
                        'reponse6' => $request->input('enfants'),
                        'reponse7' => $request->input('enfants') == 'oui' ? $request->input('age_enfants') : "Pas d'enfant",
                        'reponse8' => $request->input('profession_domaine_travail'),
                        'reponse9' => $request->input('temps_travail_actuel'),
                        'reponse10' => $request->input('documents_emploi'),
                        'reponse11' => $request->input('procedure_immigration'),
                        'reponse12' => $request->input('procedure_immigration') == 'oui' ? $request->input('questions-procedure-immigration1') : 'Pas de procedure deja tentee',
                        'reponse13' => $request->input('procedure_immigration') == 'oui' ? $request->input('questions-procedure-immigration2') : 'Pas de procedure deja tentee',
                        'reponse14' => $request->input('diplome_etudes'),
                        'reponse15' => $request->input('annee_obtention_diplome') ?? 'Pas de diplomes',
                        'reponse16' => $request->input('membre_famille_canada'),
                        'reponse17' => $request->input('immigrer_seul_ou_famille'),
                        'reponse18' => $request->input('langues_parlees'),
                        'reponse19' => $request->input('test_connaissances_linguistiques'),
                        'reponse20' => $request->input('niveau_scolarite_conjoint'),
                        'reponse21' => $request->input('domaine_formation_conjoint'),
                        'reponse22' => $request->input('age_conjoint'),
                        'reponse23' => $request->input('niveau_francais'),
                        'reponse24' => $request->input('niveau_anglais'),
                        'reponse25' => $request->input('age_enfants_linguistique'),
                        'reponse26' => $request->input('niveau_scolarite_enfants'),
                    ]
                );
            } else {
                // Si la consultation n'est pas payée, vérifiez s'il existe une entrée et supprimez-la
                Entree::where('id_candidat', $candidat->id)->delete();

                // Supprimez également la fiche de consultation s'il en existe une
                FicheConsultation::where('id_candidat', $candidat->id)->delete();
            }

            // Redirection vers dossier contact avec un message de succès
            return redirect()->route('DossierContacts')->with('success', 'Formulaire modifié avec succès.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Gérer les erreurs de validation
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Gérer les autres exceptions
            return redirect()->back()->withErrors(['error' => 'Une erreur inattendue s\'est produite.'])->withInput();
        }
    }




    public function rechercheCandidat(Request $request)
    {
        $term = $request->input('term'); // Terme de recherche

        // Effectuez la recherche dans la base de données et renvoyez les résultats au format JSON
        $candidats = Candidat::where('nom', 'LIKE', "%$term%")->orWhere('prenom', 'LIKE', "%$term%")->get();

        $formattedCandidats = [];

        foreach ($candidats as $candidat) {
            $formattedCandidats[] = [
                'id' => $candidat->id,
                'text' => $candidat->nom . ' ' . $candidat->prenom,
            ];
        }

        return response()->json($formattedCandidats);
    }

    public function ajouterCandidatAConsultation(Request $request)
    {
        try {
            // Récupérer les données de la requête AJAX
            $consultationId = $request->input('consultation_id');
            $candidatId = $request->input('candidat_id');

            // Récupérer le candidat
            $candidat = Candidat::find($candidatId);

            // Vérifier si le candidat est déjà inscrit à une consultation
            if ($candidat->id_info_consultation !== null) {
                // Le candidat est déjà inscrit à une consultation
                // Vous pourriez renvoyer ici une liste des consultations disponibles ou d'autres informations
                return response()->json(['success' => false, 'message' => 'Le candidat est déjà inscrit à une consultation.']);
            }

            // Récupérer la consultation
            $consultation = InfoConsultation::findOrFail($consultationId);

            $candidatsInscrits = $consultation->candidats;

            // Calculer le nombre de candidats inscrits et les places disponibles
            $nombreCandidatsInscrits = count($candidatsInscrits);
            $placesDisponibles = $consultation->nombre_candidats - $nombreCandidatsInscrits;

            // Vérifier s'il y a des places disponibles
            if ($placesDisponibles > 0) {
                // Ajouter l'ID de la nouvelle consultation à la colonne id_info_consultation du candidat
                $candidat->id_info_consultation = $consultation->id;
                $candidat->save();

                return response()->json(['success' => true, 'message' => 'Candidat ajouté avec succès à la nouvelle consultation']);
            } else {
                return response()->json(['success' => false, 'message' => 'La nouvelle consultation est complète, aucune place disponible.']);
            }
        } catch (\Exception $e) {
            // Log l'erreur pour un débogage ultérieur

            return response()->json(['success' => false, 'message' => 'Erreur lors de l\'ajout du candidat à la nouvelle consultation ' . $e->getMessage()]);
        }
    }
    public function ajouterTypeDeVisa(Request $request)
    {
        try {
            // Récupérer les données de la requête AJAX
            $visaId = $request->input('visaId');
            $candidatId = $request->input('candidatId');

            // Vérifier si le candidat est déjà inscrit à un type de visa
            if (Procedure::where('id_candidat', $candidatId)->exists()) {
                // Le candidat est déjà inscrit à un type de visa
                // Vous pourriez renvoyer ici une liste des types de visa disponibles ou d'autres informations
                return response()->json(['success' => false, 'message' => 'Le candidat est déjà inscrit à un type de visa.']);
            }

            // Vérifier si $visaId est non nul
            if ($visaId === null) {
                return response()->json(['success' => false, 'message' => 'L\'ID du type de visa est manquant.']);
            }

            Procedure::create([
                'id_candidat' => $candidatId,
                'id_type_procedure' => $visaId,
            ]);

            return response()->json(['success' => true, 'message' => 'Candidat ajouté avec succès au nouveau type de visa']);
        } catch (\Exception $e) {
            // Log l'erreur pour un débogage ultérieur

            return response()->json(['success' => false, 'message' => 'Erreur lors de l\'ajout du candidat au nouveau type de visa ' . $e->getMessage()]);
        }
    }


    public function getAllTransactions($userId = null)
    {
        $depensesQuery = Depense::query();
        $entreesQuery = Entree::query();

        if ($userId) {
            $depensesQuery->where('id_utilisateur', $userId);
            $entreesQuery->where('id_utilisateur', $userId);
        }

        $depenses = $depensesQuery->get();
        $entrees = $entreesQuery->get();


        $transactions = $depenses->concat($entrees);
        $transactions = $transactions->sortByDesc('date');

        return  $transactions;
    }
}
