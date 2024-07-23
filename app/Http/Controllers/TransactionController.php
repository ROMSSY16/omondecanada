<?php

// app/Http/Controllers/TransactionController.php

namespace App\Http\Controllers;

use App\Models\Entree;
use Carbon\Carbon;
use PDF; // Utilisez l'alias PDF défini dans config/app.php
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function print($id)
    {
        Carbon::setLocale('fr');
        $transaction = Entree::findOrFail($id);
        $typePaiement = \App\Models\TypePaiement::where('id', $transaction->id_type_paiement)->value('label');
        $candidatNom = $transaction->candidat->nom . '_' . $transaction->candidat->prenom;
        $fileName = 'Recu_' . $typePaiement . '_' . $candidatNom . '.pdf';

        $pdf = PDF::loadView('Documents.Recu', compact('transaction'));
        return $pdf->download($fileName);
    }
}
