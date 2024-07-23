<?php
// app/Http/Controllers/FicheRenseignementController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ConsultationRecord;
use App\Models\ConsultationResponse;
use App\Models\Candidat;

class FicheRenseignementController extends Controller
{
    public function store(Request $request, $candidatId)
    {
        // Valider la requête
        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*.*' => 'required|string',
        ]);

        // Créer une fiche de consultation
        $consultationRecord = ConsultationRecord::create([
            'user_id' => $candidatId,
        ]);

        // Enregistrer les réponses
        foreach ($validated['answers'] as $categoryId => $questions) {
            foreach ($questions as $questionId => $answer) {
                ConsultationResponse::create([
                    'consultation_record_id' => $consultationRecord->id,
                    'question_id' => $questionId,
                    'response' => $answer,
                ]);
            }
        }

        return response()->json(['message' => 'Fiche de renseignement enregistrée avec succès.']);
    }


    public function view($candidatId)
    {
        $categories = Category::with('questions')->get();
        $consultationRecord = ConsultationRecord::where('user_id', $candidatId)->latest()->first();
        $responses = [];
        $candidat = Candidat::find($candidatId);

        if ($consultationRecord) {
            $consultationResponses = ConsultationResponse::where('consultation_record_id', $consultationRecord->id)->get();

            foreach ($consultationResponses as $response) {
                $responses[$response->question->category_id][$response->question_id] = $response->response;
            }
        }

        return view('Consultante.Views.FicheRenseignement', compact('categories', 'responses', 'candidat', 'consultationRecord'));
    }
}
