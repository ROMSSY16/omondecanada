<?php

namespace App\Models;

use App\Models\User;
use App\Models\Candidat;
use App\Models\ModePaiement;
use App\Models\TypePaiement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entree extends Model
{
    use HasFactory;

    protected $table = 'entree'; 

    protected $guarded = [];

     // Méthode pour obtenir la somme de tous les montants des entrées
    public static function sommeEntrees()
    {
        $totalEntrees = Entree::sum('montant');

        return view('partials.caisse', ['total' => $totalEntrees]);
    }

    // Méthode pour obtenir toutes les entrées payées
    public static function entreesPayees()
    {
        return self::where('paye', true)->get();
    }

    // Méthode pour ajouter une nouvelle entrée
    public static function ajouterEntree($montant, $autreColonne)
    {


        return self::create([
            'montant' => $montant,
            // 'date' => $date,
            // 'id_utilisateur' => $id_utilisateur,
            // 'id_candidat' => $id_candidat,
            // 'id_type_paiement'=> $id_type_paiement,
        ]);
    }

    // Méthode pour mettre à jour une entrée existante
    public static function mettreAJourEntree($id, $montant, $autreColonne)
    {
        $entree = self::find($id);

        if ($entree) {
            $entree->update([
                'montant' => $montant,
                'autre_colonne' => $autreColonne,
                // Ajoutez d'autres colonnes si nécessaire
            ]);

            return $entree;
        }

        return null; // Ou vous pouvez jeter une exception ou traiter d'une autre manière si l'entrée n'est pas trouvée
    }

    // Méthode pour supprimer une entrée
    public static function supprimerEntree($id)
    {
        return self::destroy($id);
    }

    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_utilisateur');
    }

    public function candidat(): BelongsTo
    {
        return $this->belongsTo(Candidat::class, 'id_candidat', 'id');
    }

    public function typePaiement(): BelongsTo
    {
        return $this->belongsTo(TypePaiement::class, 'id_type_paiement');
    }
    public function modePaiement(): BelongsTo
    {
        return $this->belongsTo(ModePaiement::class, 'id_moyen_paiement');
    }
}
