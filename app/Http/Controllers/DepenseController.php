<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Depense;
use App\Models\Transaction; // Ajoutez cette ligne
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\DepenseNotification;

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



    public function storeDepense(Request $request)
    {
        $data = $request->validate([
            'type_depense' => 'required|string',
            'montant' => 'required|numeric',
            'recu' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'note' => 'nullable|string',
            'moyen_paiement' => 'required',
        ]);
        if ($request->hasFile('recu')) {
            $fileName = time() . '_' . $request->file('recu')->getClientOriginalName();
            $request->file('recu')->move(public_path('recus'), $fileName);
            $filePath = 'recus/' . $fileName;
        }
        
        $depenseCount = Depense::count();
        $depenseCode = 'V' . Carbon::now()->format('Y') . str_pad($depenseCount + 1, 4, '0', STR_PAD_LEFT);
        
        $depense = Depense::create([
            'code' => $depenseCode,
            'type_depense' => $data['type_depense'],
            'id_moyen_paiement' => $data['moyen_paiement'],
            'montant' => $data['montant'],
            'id_agent' => Auth::user()->id,
            'recu' => $filePath ?? null, 
            'note' => $data['note'],
            'date'=> now(),
        ]);

        if ($depense) {
            Transaction::create([
                'code' => $depenseCode,
                'motif'=> $data['type_depense'],
                'type'=> "sortie",
                'montant' => $data['montant'],
                'date' => now(),
                'id_agent' => Auth::user()->id,
                'id_moyen_paiement' => 2,
                'recu' => $filePath ?? null, 
                'note' => $data['note'],
                'id_succursale' => Auth::user()->succursale->id,
            ]);
        }

        return redirect()->back()->with('success', 'Dépense ajoutée avec succès');
    }
}
