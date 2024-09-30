<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use Illuminate\Http\Request;

class ExchangeRateController extends Controller
{
    public function update(Request $request)
    {
        // Validation des données entrées
        $request->validate([
            'rate_fcfa' => 'required|numeric',
        ]);
        $exchangeRate = ExchangeRate::findOrFail(1);
        $exchangeRate->rate_fcfa = $request->input('rate_fcfa');
        $exchangeRate->save();

        // Redirection ou message de succès
        return redirect()->back()->with('success', 'Taux FCFA mis à jour avec succès !');
    }
}
