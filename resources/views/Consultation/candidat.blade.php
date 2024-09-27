@extends('layouts.app')

@section('content')

    @php
        $sections = [
            //'Resumé du profil' => [31],
            'Identité du candidat' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
            'Statut professionnel' => [12, 13, 14, 15, 16, 17],
            'Informations supplémentaires' => [18, 19, 20, 21, 22, 23],
            'Informations sur le conjoint' => [24, 25, 26, 27, 28, 29, 30],
            'Question du candidat' => [34, 35, 36],
            'CV et remarques' => [32, 33],
        ];

        $questions = [
            1 => 'Nom et prenom(s)',
            2 => 'Age',
            3 => 'Pays',
            4 => 'Type de visa désiré',
            5 => 'Statut matrimonial',
            6 => 'Avez-vous un passeport valide ?',
            7 => 'Date d\'expiration du passeport',
            8 => 'Avez-vous un casier judiciaire ?',
            9 => 'Avez-vous des problèmes de santé ?',
            10 => 'Avez-vous des enfants ?',
            11 => 'Si oui, quel est l\'âge de vos enfants ?',
            12 => 'Quel est votre profession/domaine de travail ?',
            13 => 'Depuis combien de temps ?',
            14 => 'Avez-vous une attestation de travail, bulletin de salaire et tous les autres documents relatifs à votre emploi ?',
            15 => 'Avez-vous déjà entamé une procédure d\'immigration au Canada ?',
            16 => 'Depuis quand ?',
            17 => 'Quel programme ? Et quelle a été la décision ?',
            18 => 'Avez-vous un diplôme d\'études (secondaire, professionnel, universitaire) ?',
            19 => 'Quelle est le du dernier diplôme obtenu ?',
            20 => 'Avez-vous un membre de votre famille déjà au Canada ?',
            21 => 'Comptez-vous immigrer seul(e) ou en famille ?',
            22 => 'Parlez-vous d\'autres langues à part le français ?',
            23 => 'Avez-vous fait un test de connaissances linguistiques ?',
            24 => 'Quel est son niveau de scolarité ?',
            25 => 'Quel est votre domaine de formation ?',
            26 => 'Quel est votre âge ?',
            27 => 'Niveau en français',
            28 => 'Niveau en anglais',
            29 => 'Quel est l\'âge de vos enfants ?',
            30 => 'Quel est leur niveau de scolarité ?',
            31 => '',
            32 => 'Remarque consultante',
            33 => 'CV',
            34 => 'Question 1',
            35 => 'Question 2',
            36 => 'Question 3',
        ];
    @endphp

    <div class="row">
        <div class="col-12">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                    <h3 class="card-title text-white">Resumé du profil</h3>
                </div>
                <div class="card-body">
                    <p class="answer text-right fs-5">{{$consultation->ficheConsultation->remarque_agent}}</p>
                </div>
            </div>
            @foreach ($sections as $sectionTitle => $sectionQuestions)
                <div class="card my-4 mt-5 mb-1">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                            <h3 class="card-title text-white">{{ $sectionTitle }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($sectionQuestions as $index => $key)
                                @if ($index === 0 )
                                    <div class="col-md-4 mb-2">
                                @else
                                    <div class="col-md-4 mb-2">
                                @endif
                                        <strong class="question d-block fs-5 mb-1">{{ $questions[$key] }}</strong>
                                        @php
                                            $answer = '';
                                            switch ($key) {
                                                case 1:
                                                    $answer = $consultation->nom . ' ' . $consultation->prenom;
                                                    break;
                                                case 2:
                                                    $answer = $consultation->date_naissance ? now()->diffInYears($consultation->date_naissance) . ' An(s)' : '';
                                                    break;
                                                case 3:
                                                    $answer = $consultation->pays;
                                                    break;
                                                case 4:
                                                    $answer = $consultation->ficheConsultation->type_visa;
                                                    break;
                                                case 31:
                                                    $answer = $consultation->remarque_agent;
                                                    break;
                                                case 32:
                                                    $answer = $consultation->remarque_consultante;
                                                    break;
                                                case 33:
                                                    $answer = '<a href="' . asset($consultation->ficheConsultation->lien_cv) . '" class="btn btn-primary" target="_blank">Afficher le CV</a>';
                                                    break;
                                                case 34:
                                                    $answer = $consultation->ficheConsultation->reponse27 ?? 'Aucune question';
                                                    break;
                                                case 35:
                                                    $answer = $consultation->ficheConsultation->reponse28 ?? 'Aucune question';
                                                    break;
                                                case 36:
                                                    $answer = $consultation->ficheConsultation->reponse29 ?? 'Aucune question';
                                                    break;
                                                default:
                                                    $answer = $consultation->ficheConsultation->{'reponse' . ($key - 4)} ?? '';
                                            }
                                        @endphp
                                        <p class="answer text-right fs-5">{!! $answer !!}</p>
                                    </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <br/>
    <br/>
    @role('consultante')
    <div class="card">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                <h3 class="card-title text-white">Votre remarque</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="row pt-4">
                <div class="col-md-12">
                    <form action="{{ route('candidat.save_remarque', ['id' => $consultation->id]) }}" method="post">
                        @csrf
                        <div class="input-group mb-3 p-2">
                            <textarea class="form-control" name="remarque_consultante" id="remarque_consultante" style="height: 8rem; width: 20rem;">{{ $consultation->remarque_consultante ?? '' }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-warning float-end">SOUMETTRE ET TERMINER</button>
                    </form>
                </div>
            </div>                                
        </div>
    </div>
        
    @endrole

@endsection
