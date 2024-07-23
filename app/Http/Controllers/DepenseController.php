<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use App\Models\User;
use App\Notifications\DepenseNotification;
use Illuminate\Http\Request; // Ajoutez cette ligne
use Illuminate\Support\Facades\DB;

class DepenseController extends Controller
{
    public function ajoutDepense(Request $request)
    {
        // Validez les données du formulaire
        $request->validate([
            'montant' => 'required|numeric',
            'date' => 'required|date',
            'raison' => 'required|string',
        ]);

        // Récupérez l'ID de l'utilisateur
        $utilisateurId = auth()->user()->id;

        // Créez une nouvelle dépense avec l'ID de l'utilisateur
        $depense = Depense::create([
            'montant' => $request->input('montant'),
            'date' => $request->input('date'),
            'raison' => $request->input('raison'),
            'id_utilisateur' => $utilisateurId,
            // Ajoutez d'autres champs selon vos besoins
        ]);

        $agent = auth()->user()->name . ' ' . auth()->user()->last_name;
        $montant = number_format($request->input('montant'), 0, '.', ' ');
        $raison = $request->input('raison');

        // Utilisez la fonction pour récupérer les utilisateurs par rôle
        $utilisateursNotifies = $this->getUsersByRole(4); // Remplacez $roleId par l'ID du rôle que vous souhaitez

        DB::transaction(function () use ($utilisateursNotifies, $montant, $agent, $raison) {
            foreach ($utilisateursNotifies as $utilisateur) {
                $utilisateur->notify(new DepenseNotification($montant, $agent, $raison));
            }
        });

        return redirect()->back(); // Redirigez après la création (ajustez la route selon votre besoin)
    }

    public function getUsersByRole($roleId)
    {
        // Utilisez Eloquent pour récupérer les utilisateurs ayant le rôle spécifié
        $utilisateurs = User::where('id_role_utilisateur', $roleId)->get();

        return $utilisateurs;
    }
}
