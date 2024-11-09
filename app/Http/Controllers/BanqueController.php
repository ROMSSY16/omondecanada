<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Entree;
use App\Models\Procedure;
use App\Models\Versement;
use App\Models\Transaction;
use App\Models\ModePaiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BanqueController extends Controller
{
    public function index(){
        $pageTitle = 'Banque';
        $moyen_paiements = ModePaiement::get();
        $clients = Procedure::where('solde',"0")->orderBy('created_at','desc')->get();
        $transactions = Transaction::where('status','1')->orderBy('created_at','desc')->get();
        return view("banque.index", [
            'pageTitle' => $pageTitle,
            'clients'=> $clients,
            'transactions'=> $transactions,
            'moyen_paiements'=> $moyen_paiements
        ]);
    }
    public function storeNewVersement(Request $request)
    {
        $data = $request->validate([
            'type_versement' => 'required|string',
            'client' => 'required|exists:users,id',
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
        
        $procedure = Procedure::where('id_candidat', $data['client'])->first();
        
        $entreeCount = Entree::count();
        $entreeCode = 'E' . Carbon::now()->format('Y') . str_pad($entreeCount + 1, 4, '0', STR_PAD_LEFT);
        
        $versement = Versement::create([
            'code'=> $entreeCode,
            'type' => "Nouveau",
            'id_procedure'=> $procedure->id,
            'type_versement' => $data['type_versement'],
            'id_moyen_paiement' => $data['moyen_paiement'],
            'client_id' => $data['client'], 
            'montant' => $data['montant'],
            'recu' => $filePath ?? null, 
            'note' => $data['note'],
            'date'=> now(),
        ]);

        if ($versement) {
           
            Transaction::create([
                'code' => $entreeCode,
                'motif'=> $data['type_versement'],
                'versement' => "Nouveau",
                'type'=> "entree",
                'id_candidat' => $data['client'],
                'montant' => $data['montant'],
                'date' => now(),
                'id_agent' => Auth::user()->id,
                'id_moyen_paiement' => 2,
                'id_type_procedure'=> $procedure->typeProcedure->id,
                'recu' => $filePath ?? null,
                'note' => $data['note'],
                'id_succursale' => Auth::user()->succursale->id,
            ]);
        }

        return redirect()->back()->with('success', 'Versement ajouté avec succès');
    }

    public function storeLastVersement(Request $request)
    {
        $data = $request->validate([
            'type_versement' => 'required|string',
            'client' => 'required',
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
        
        $procedure = Procedure::where('id_candidat', $data['client'])->first();
        
        $entreeCount = Entree::count();
        $entreeCode = 'E' . Carbon::now()->format('Y') . str_pad($entreeCount + 1, 4, '0', STR_PAD_LEFT);
        
        $versement = Versement::create([
            'code'=> $entreeCode,
            'type' => "Ancien", 
            'type_versement' => $data['type_versement'],
            'id_moyen_paiement' => $data['moyen_paiement'],
            'client' => $data['client'], 
            'montant' => $data['montant'],
            'recu' => $filePath ?? null, 
            'note' => $data['note'],
            'date'=> now(),
        ]);

        if ($versement) {
           
            Transaction::create([
                'code' => $entreeCode,
                'motif'=> $data['type_versement'],
                'versement' => "Ancien",
                'type'=> "entree",
                'client' => $data['client'], 
                'montant' => $data['montant'],
                'date' => now(),
                'id_agent' => Auth::user()->id,
                'id_moyen_paiement' => 2,
                'recu' => $filePath ?? null,
                'note' => $data['note'],
                'id_succursale' => Auth::user()->succursale->id,
            ]);
        }

        return redirect()->back()->with('success', 'Versement ajouté avec succès');
    }
}
