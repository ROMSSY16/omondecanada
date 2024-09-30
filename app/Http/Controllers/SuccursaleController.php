<?php

namespace App\Http\Controllers;

use App\Models\Succursale;
use App\Models\ExchangeRate;
use Illuminate\Http\Request;

class SuccursaleController extends Controller
{
    public function index(){
        $pageTitle = 'Les succursales';
        $succursales = Succursale::get();
        $exchangeRateUsdToFcfa = ExchangeRate::select('rate_fcfa')->first()->rate_fcfa;

        return view('succursale.index', [
            'pageTitle' => $pageTitle,
            'succursales'=> $succursales,
            'exchangeRateUsdToFcfa' => $exchangeRateUsdToFcfa,
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|unique:succursale,label,',
            'montant' => 'required',
            'devis' => 'required',
        ]);
        $succursale = Succursale::create([
            'label' => $request->label,
            'montant' => $request->montant,
            'devis' => $request->devis,
        ]);
        if ($succursale) {
            return redirect()->route('succursale.index')->with('success', 'Succursale créee avec succès !');
        }
    }
    public function update(Request $request, $id)
    {
        $succursale = Succursale::findOrFail($id);

        $request->validate([
            'label' => 'required|unique:succursale,label,' . $succursale->id,
        ]);

        $succursale->update([
            'label' => $request->label,
            'montant' => $request->montant,
            'devis' => $request->devis,
        ]);

        return redirect()->route('succursale.index')->with('success', 'Succursale mise à jour avec succès.');
    }
    
}
