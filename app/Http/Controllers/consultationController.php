<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\Consultante;
use App\Models\InfoConsultation;
use App\Models\User;
use App\Notifications\ConsultationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ConsultationController extends Controller
{
    public function toggleConsultation($candidatId)
    {
        $candidat = Candidat::find($candidatId);

        if (!$candidat) {
            return response()->json(['message' => 'Candidat non trouvé'], 404);
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

    public function getConsultationWaitingList($consultationId)
    {
        // Récupérer la consultation par son ID
        $info_consultation = InfoConsultation::find($consultationId);
        return view('Consultation.waitingList', ['data_candidat' => $info_consultation->candidats]);
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
        // Predefined email addresses
        $emails = ['info@omondecanada.com', 'doh.tosseta@omondecanada.com', 'andreamelissaf@gmail.com'];

        // Users with role type 3
        $roleBasedUsers = $this->getUsersByRole(3);

        // Send email to predefined email addresses
        foreach ($emails as $email) {
            Mail::to($email)->send(new \App\Mail\ConsultationMail($consultation, $action));
        }

        // Notify users with role type 3
        foreach ($roleBasedUsers as $user) {
            Mail::to($user->email)->send(new \App\Mail\ConsultationMail($consultation, $action));
        }
    }

    public function getUsersByRole($roleId)
    {
        return User::where('id_role_utilisateur', $roleId)->get();
    }
}
