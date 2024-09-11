<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Entree;
use App\Models\Dossier;
use App\Models\Candidat;
use App\Models\Document;
use App\Models\RendezVous;
use Illuminate\Http\Request;
use App\Models\TypeProcedure;
use App\Models\InfoConsultation;

class ClientController extends Controller
{
    public function index()
    {
        $pageTitle = 'Liste des Clients';

        Carbon::setLocale('fr');
        $idSuccursaleUtilisateur = auth()->user()->id_succursale;
        $now = Carbon::yesterday();

        $clients = Candidat::whereHas('rendezVous', function ($query) use ($idSuccursaleUtilisateur) {
                $query->where('consultation_payee', '1')
                    ->whereHas('commercial', function ($q) use ($idSuccursaleUtilisateur) {
                        $q->where('id_succursale', $idSuccursaleUtilisateur);
                    });
            })
            ->orderByDesc('date_enregistrement')
            ->get()
            ->each(function ($client) {
                $client->dateFormatee = $client->infoConsultation
                    ? ucwords(Carbon::parse($client->infoConsultation->date_heure)->translatedFormat('l j F Y H:i'))
                    : 'N / A';
            });

        $consultations = InfoConsultation::where('nombre_candidats', '>', function ($query) {
                $query->selectRaw('count(*)')
                    ->from('candidat')
                    ->whereColumn('info_consultation.id', 'candidat.id_info_consultation');
            })
            ->where('date_heure', '>', $now)
            ->get()
            ->each(function ($consultation) {
                $consultation->dateFormatee = ucwords(Carbon::parse($consultation->date_heure)->translatedFormat('l j F Y H:i'));
            });

       

        return view('client.index', [
            'pageTitle' => $pageTitle, 
            'clients' => $clients, 
            'consultationsDisponible' => $consultations,
            ]);
    }


    public function succursaleClients(){
        $pays = auth()->user()->succursale->label;
        $pageTitle = 'Clients'.' '.$pays;
        $idSuccursaleUtilisateur = auth()->user()->id_succursale;
        $candidatsSuccursalle = Candidat::whereHas('utilisateur', function ($query) use ($idSuccursaleUtilisateur) {
            $query->where('id_succursale', $idSuccursaleUtilisateur);
        })->orderBy('date_enregistrement', 'desc')->paginate(10);

        return view('contact.succursale', [
            'data_candidat' => $candidatsSuccursalle,
            'pageTitle' => $pageTitle,
            'pays' => $pays,
        ]);
    }

    public function voirDossierClient(){
        $pageTitle = 'Dossiers Clients';
        $dossierClients = Dossier::get();
        $typeProcedures = TypeProcedure::get();
        return view('client.dossier', [
            'pageTitle' => $pageTitle,
            'dossier_clients'=> $dossierClients,
            'typeProcedures'=> $typeProcedures
        ]);
    }

    public function detailDossierClient($id){
        $candidat = Candidat::findOrFail($id);
        $pageTitle = 'Dossier de : ' . $candidat->nom . ' ' . $candidat->prenom;
        $dossierClient = Dossier::where('id_candidat', $candidat->id)->first();
        $documents = Document::where('id_dossier', $dossierClient->id)->get();
      
        return view('client.dossier_view', [
            'pageTitle' => $pageTitle,
            'documents'=> $documents,
            'candidat'=> $candidat
        ]);
    }

    public function addDocument(Request $request, $id){
        $candidat = Candidat::findOrFail($id);
        $dossier = Dossier::where('id_candidat', $candidat->id)->first();

        if ($request->hasFile('document_url')) {
            $filename = time() . '-' . $request->file('document_url')->getClientOriginalName();
            $documentPath = 'documents/' . $candidat->nom .'/'. $request->nom . '/';
            $documentUrl = $documentPath . $filename;
            if (!file_exists(public_path($documentPath))) {
                mkdir(public_path($documentPath), 0777, true);
            }
            $request->file('document_url')->move(public_path($documentPath), $filename);
        } else {
            return redirect()->back()->with('error', 'Aucun fichier sélectionné.');
        }
        $document = Document::create([
            'nom' => $request->nom,
            'url' => $documentUrl,
            'id_dossier' => $dossier->id,
            
        ]);
        return redirect()->back()->with('success','Document ajoute avec succes.');
    }

    public function deleteDocument($id)
    {
        $document = Document::findOrFail($id);
        if (file_exists(public_path($document->url))) {
            unlink(public_path($document->url));
        }
        $document->delete();

        return redirect()->back()->with('success', 'Document supprimé avec succès.');
    }

}
