<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Candidat;
use App\Models\RendezVous;
use Illuminate\Http\Request;
use App\Models\TypeProcedure;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index(){
        $pageTitle = 'Contacts';
        $pays = auth()->user()->succursale->label;
        $consultants = Role::where('name', 'Consultante')->orderBy('created_at', 'desc')->get();
        $candidatsAgents = Candidat::where('id_utilisateur', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        $type_procedures = TypeProcedure::get();

        return view('contact.index', [
            'data_candidat' => $candidatsAgents,
            'pageTitle' => $pageTitle,
            'pays' => $pays,
            'consultants' => $consultants,
            'type_procedures'=> $type_procedures
        ]);
    }
    public function succursaleContacts(){
        $pays = auth()->user()->succursale->label;
        $pageTitle = 'Contacts'.' '.$pays;
        $type_procedures = TypeProcedure::get();
        $idSuccursaleUtilisateur = auth()->user()->id_succursale;
        $candidatsSuccursalle = Candidat::whereHas('utilisateur', function ($query) use ($idSuccursaleUtilisateur) {
            $query->where('id_succursale', $idSuccursaleUtilisateur);
        })->orderBy('date_enregistrement', 'desc')->paginate(10);

        return view('contact.succursale', [
            'data_candidat' => $candidatsSuccursalle,
            'pageTitle' => $pageTitle,
            'pays' => $pays,
            'type_procedures'=> $type_procedures
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'numero_telephone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'profession' => 'required|string|max:255',
            'date_rdv' => 'required|date',
        ]);
       
        $candidat = Candidat::create([
            'nom' => ucwords(strtolower($validated['nom'])),
            'prenom' => ucwords(strtolower($validated['prenoms'])),
            'pays' => ucwords(strtolower($validated['pays'])),
            'ville' => ucwords(strtolower($validated['ville'])),
            'numero_telephone' => $validated['numero_telephone'],
            'email' => $validated['email'],
            'profession' => ucwords(strtolower($validated['profession'])),
            'consultation_payee' => '0',
            'id_utilisateur' => Auth::user()->id,
            'date_rdv' => $request->date_rdv,
            'id_type_procedure' => $request->type_procedure,
        ]);
        if($candidat){
            RendezVous::create([
                'date_rdv' => $request->date_rdv,
                'candidat_id' => $candidat->id,
                'commercial_id' => Auth::user()->id,
            ]);
        }
        

        $message = 'Prospect enregistré avec succès.';
        return redirect()->back()->with('success', $message);
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'numero_telephone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'profession' => 'required|string|max:255',
            'date_rdv' => 'required|date',
        ]);

        $candidat = Candidat::findOrFail($id);

        $candidat->update([
            'nom' => ucwords(strtolower($validated['nom'])),
            'prenom' => ucwords(strtolower($validated['prenoms'])),
            'pays' => ucwords(strtolower($validated['pays'])),
            'ville' => ucwords(strtolower($validated['ville'])),
            'numero_telephone' => $validated['numero_telephone'],
            'email' => $validated['email'],
            'profession' => ucwords(strtolower($validated['profession'])),
            'date_rdv' => $request->date_rdv,
            'id_type_procedure' => $request->type_procedure,
        ]);

        $rendezVous = $candidat->rendezVous()->first();
        if ($rendezVous) {
            $rendezVous->update([
                'date_rdv' => $request->date_rdv,
                //'commercial_id' => Auth::user()->id,
            ]);
        }

        $message = 'Prospect mis à jour avec succès.';
        return redirect()->back()->with('success', $message);
    }

}
