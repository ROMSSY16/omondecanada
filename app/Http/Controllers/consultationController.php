<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Entree;
use App\Models\Candidat;
use App\Models\RendezVous;
use App\Models\Consultante;
use Illuminate\Http\Request;
use App\Models\InfoConsultation;
use App\Models\FicheConsultation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;

class ConsultationController extends Controller
{
    public function index()
    {
        $pageTitle = 'Consultations';
        Carbon::setLocale('fr');
        $consultations = InfoConsultation::orderBy('date_heure', 'desc')->get();
        foreach ($consultations as $consultation) {
            $formattedDate = Carbon::parse($consultation->date_heure)->translatedFormat('l j F Y');
            $consultation->date_heure_formatee = ucwords($formattedDate);
        }
        return view('consultation.index', [
            'consultations' => $consultations,
            'page' => $pageTitle, 
        ]);
    }

    public function confirmConsultation($id){
        $candidat = Candidat::findOrFail($id);
        $candidat->update([
            'consultation_payee' => '1',
        ]);
        $rendezvous = RendezVous::where('candidat_id', $candidat->id)->first();
        $rendezvous->update([
            'consultation_payee' => '1',
        ]);
        return redirect()->back()->with('success', 'Consultation confirmée avec succès.');
    }

    public function cancelConsultation($id){
        $candidat = Candidat::findOrFail($id);
        $candidat->update([
            'consultation_payee' => '0',
        ]);
        $rendezvous = RendezVous::where('candidat_id', $candidat->id)->first();
        $rendezvous->update([
            'consultation_payee' => '0',
        ]);
        return redirect()->back()->with('success', 'Consultation annulée avec succès.');
    }
    public function modifierDateConsultation(Request $request, $candidatId)
    {
        try {
            Carbon::setLocale('fr');

            $consultation = InfoConsultation::findOrFail($request->input('consultation_id'));
            $candidat = Candidat::findOrFail($candidatId);

            $dateConsultation = Carbon::parse($consultation->date_heure)->translatedFormat('l j F');
            $heureConsultation = Carbon::parse($consultation->date_heure)->translatedFormat('H:i');

            $firstTime = is_null($candidat->id_info_consultation);

            $candidat->update(['id_info_consultation' => $consultation->id]);

            // A refaire

            // Notification::route('mail', $candidat->email)->notify(
            //     new DateConsultationNotification(
            //         $candidat->nom,
            //         $candidat->prenom,
            //         $firstTime,
            //         $dateConsultation,
            //         $heureConsultation,
            //         $consultation->lien_zoom
            //     )
            // );

            return redirect()->back()->with('success', 'Consultation mise à jour avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Echec de mise à jour');
        }
    }
    public function getConsultationWaitingList($consultationId)
    {
        $info_consultation = InfoConsultation::find($consultationId);
        return view('consultation.waitingList', ['data_candidat' => $info_consultation->candidats]);
    }
    public function toggleConsultation($candidatId)
    {
        $candidat = Candidat::find($candidatId);

        if (!$candidat) {
            return redirect()->back()->with('message', 'Candidat non trouvé');
        }

        $status = request('status');

        $candidat->update(['consultation_effectuee' => ($status === 'yes')]);

        $message = 'Statut de consultation mis à jour avec succès.';

        return redirect()->back()->with('success', $message);
    }

    public function listeConsultantes()
    {
        $consultantes = Consultante::all();
        return view('Consultation.Consultation', ['data_consultante' => $consultantes]);
    }

    

    public function creerConsultation(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'lien_zoom' => 'required',
            'lien_zoom_demarrer' => 'required',
            'date_heure' => 'required|date',
            'nombre_candidats' => 'required|integer',
            'id_consultante' => 'required|integer',
        ]);

        $consultation = InfoConsultation::create([
            'label' => 'CONS-' . date('Ymd', strtotime($request->input('date_heure'))) . '-' . $request->input('id_consultante'),
            'lien_zoom' => $request->input('lien_zoom'),
            'lien_zoom_demarrer' => $request->input('lien_zoom_demarrer'),
            'date_heure' => $request->input('date_heure'),
            'nombre_candidats' => $request->input('nombre_candidats'),
            'id_consultante' => $request->input('id_consultante')
        ]);

        $this->sendNotification($consultation, 'créée');

        return redirect()->back();
    }

    public function ModifierConsultation(Request $request, $id)
    {
        // Valider les données du formulaire
        $request->validate([
            'lien_zoom' => 'required',
            'lien_zoom_demarrer' => 'required',
            'date_heure' => 'required|date',
            'nombre_candidats' => 'required|integer',
            'id_consultante' => 'required|integer',
        ]);

        try {
            $consultation = InfoConsultation::findOrFail($id);

            $consultation->update([
                'lien_zoom' => $request->input('lien_zoom'),
                'lien_zoom_demarrer' => $request->input('lien_zoom_demarrer'),
                'date_heure' => $request->input('date_heure'),
                'nombre_candidats' => $request->input('nombre_candidats'),
                'id_consultante' => $request->input('id_consultante')
            ]);

            $this->sendNotification($consultation, 'modifiée');

            return redirect()->back();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function SupprimerConsultation($id)
    {
        $consultation = InfoConsultation::findOrFail($id);
        $consultation->delete();

        $this->sendNotification($consultation, 'supprimée');

        return response()->json(['message' => 'La consultation a été supprimée avec succès.'], 200);
    }

    protected function sendNotification($consultation, $action)
    {
        $emails = ['info@omondecanada.com', 'doh.tosseta@omondecanada.com', 'andreamelissaf@gmail.com'];
        $roleBasedUsers = $this->getUsersByRole(3);

        foreach ($emails as $email) {
            Mail::to($email)->send(new \App\Mail\ConsultationMail($consultation, $action));
        }

        foreach ($roleBasedUsers as $user) {
            Mail::to($user->email)->send(new \App\Mail\ConsultationMail($consultation, $action));
        }
    }

    public function getUsersByRole($roleId)
    {
        return User::where('id_role_utilisateur', $roleId)->get();
    }

    public function modifierAjouterFicheConsultationClient(Request $request, $id)
    {
        $candidat = Candidat::find($id);

        if (!$candidat) {
            return response()->json(['error' => 'Candidat not found'], 404);
        }

        $ficheconsultation = FicheConsultation::firstOrNew(['id_candidat' => $candidat->id]);

        $cvPath = $ficheconsultation->lien_cv; 
        if ($request->hasFile('cv')) {

            if ($ficheconsultation->lien_cv && Storage::exists($ficheconsultation->lien_cv)) {
                Storage::delete($ficheconsultation->lien_cv);
            }

            $cvPath = $request->file('cv')->store('cv');
        }
        $reponses = [
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
            'reponse15' => $request->input('annee_obtention_diplome'),
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
            'reponse27' => $request->input('reponse27'),
            'reponse28' => $request->input('reponse28'),
            'reponse29' => $request->input('reponse29'),
        ];

        $ficheconsultation->fill($reponses)->save();

        $entree = Entree::where('id_candidat', $candidat->id)->where('id_utilisateur', Auth::user()->id)->first();
        if (!$entree) {
            $montant = auth()->user()->succursale->montant;

            Entree::create([
                'id_candidat' => $candidat->id,
                'montant' => $montant,
                'date' => now(),
                'id_utilisateur' => auth()->id(),
                'id_type_paiement' => 2,
                'id_moyen_paiement' => $request->input('modePaiement'),
            ]);
        }

        return redirect()->back()->with('success','Fiche consultation modifiee avec succes.');
    }

}
