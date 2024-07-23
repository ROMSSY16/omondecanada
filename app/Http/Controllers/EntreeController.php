<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Entree;
use App\Models\Candidat;
use App\Models\User;
use App\Notifications\VersementNotification;

class EntreeController extends Controller


{
    public function ajoutEntree(Request $request)
    {
        $request->validate([
            'montant' => 'required|numeric',
            'datetime' => 'required|date_format:Y-m-d\TH:i',
            'modePaiement' => 'required|numeric',
            'candidat' => 'required|exists:candidat,id',

        ]);

        try {

            info('Validation des données du formulaire réussie.');

            $candidatId = $request->input('candidat');
            $formattedDateTime = date('Y-m-d H:i:s', strtotime($request->input('datetime')));
            $utilisateurId = auth()->user()->id;

            info('Données récupérées : Candidat ID = ' . $candidatId . ', Date formatée = ' . $formattedDateTime);

            $entree = Entree::create([
                'montant' => $request->input('montant'),
                'date' => $formattedDateTime,
                'id_utilisateur' => $utilisateurId,
                'id_candidat' => $candidatId,
                'id_moyen_paiement' => $request->input('modePaiement'),
                'id_type_paiement' => 1, // Vous pouvez ajuster cette valeur selon votre logique d'application
            ]);

            info('Entrée créée avec succès : ID = ' . $entree->id);

            // Mise à jour de la colonne 'versement_effectue' du candidat si nécessaire
            if ($request->input('type') == 1) {
                $candidat = Candidat::find($candidatId);
                if ($candidat && !$candidat->versement_effectue) {
                    $candidat->update(['versement_effectue' => true]);
                    info('Versement effectué pour le candidat : ' . $candidat->id);
                }
            }

            $montant = number_format($request->input('montant'), 0, '.', ' ');
            $agent = auth()->user()->name . ' ' . auth()->user()->last_name;

            info('Notification envoyée pour le montant : ' . $montant);

            // Récupération des utilisateurs à notifier (exemple : utilisateurs avec un rôle spécifique)
            $utilisateursNotifies = $this->getUsersByRole(4);

            foreach ($utilisateursNotifies as $utilisateur) {
                $utilisateur->notify(new VersementNotification($montant, $agent));
                info('Notification envoyée à : ' . $utilisateur->email);
            }


            info('Transaction terminée avec succès.');

            return redirect()->back()->with('success', 'Entrée enregistrée avec succès.');

        } catch (\Exception $e) {
            DB::rollback();
            info('Erreur lors de l\'enregistrement de l\'entrée : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }


    // Méthode pour récupérer les utilisateurs par rôle
    private function getUsersByRole($roleId)
    {
        return User::where('id_role_utilisateur', $roleId)->get();
    }
}
