@extends('layouts.app')
@section('content')
        
    @php
    $questions = [
        1 => 'Statut Matrimonial',
        2 => 'Avez-vous un passeport valide ?',
        3 => 'Date d\'expiration du passeport',
        4 => 'Avez-vous un casier judiciaire ?',
        5 => 'Avez-vous un des soucis de santé ?',
        6 => 'Avez-vous des enfants ?',
        7 => 'Si oui, quel est l\'âge de vos enfants ?',
        8 => 'Quel est votre profession/domaine de travail ?',
        9 => 'Depuis combien de temps ?',
        10 => 'Avez-vous une attestation de travail, bulletin de salaire et tous les autres documents relatifs à votre emploi ?',
        11 => 'Avez-vous déjà entamé une procédure d\'immigration au Canada ?',
        12 => 'Depuis quand ?',
        13 => 'Quel programme ? et quelle a été la décision ?',
        14 => 'Avez-vous un diplôme d\'études (secondaire, professionnel, universitaire) ?',
        15 => 'Avez-vous un membre de votre famille déjà au Canada ?',
        16 => 'Comptez-vous immigrer seul(e) ou en famille ?',
        17 => 'Parlez-vous d\'autres langues à part le français ?',
        18 => 'Avez-vous fait un test de connaissances linguistiques ?',
        19 => 'Quel est son niveau de scolarité ?',
        20 => 'Quel est votre domaine de formation ?',
        21 => 'Quel est votre âge ?',
        22 => 'Niveau en français',
        23 => 'Niveau en anglais',
        24 => 'Quel est l\'âge de vos enfants ?',
        25 => 'Quel est leur niveau de scolarité ?',
    ];
    @endphp
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3">
                       
                    <div class="bg-gradient-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                        <h3 class="text-white text-capitalize p-2">Consultation du
                            {{ ucfirst(\Carbon\Carbon::parse($info_consultation->date_heure)->translatedFormat('d F Y')) }}
                                
                       </h3>
                    </div>
                </div>
                <div class="card-body">
                    @php $count = 0; @endphp
                    @foreach ($questions as $key => $question)
                        @if ($count % 3 === 0)
                            <div class="row">
                        @endif
                        <div class="col-md-4">
                            <div class="response-item mb-3 border rounded p-3">
                                <strong class="question d-block mb-2">{{ $question }}</strong>
                                <span class="answer d-block">
                                    {{ $consultation->ficheConsultation->{'reponse'.$key} ?? '' }}
                                </span>
                            </div>
                        </div>
                        @php $count++; @endphp
                        @if ($count % 3 === 0 || $loop->last)
                            </div>
                        @endif
                    @endforeach
    
                    <!-- Ajouter un rectangle supplémentaire pour les remarques -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="response-item mb-3 border rounded p-3">
                                <strong class="question d-block mb-2">Remarques</strong>
                                <span class="answer d-block">
                                    {{ $consultation->remarque_agent ?? '' }}
                                </span>
                            </div>
                        </div>
    
                        <div class="col-md-4">
                            <a href="{{ asset('storage/' .$consultation->ficheConsultation->lien_cv) }}" class="btn btn-primary" target="_blank">Afficher le CV</a>
                        
                            <!-- Form for consultant's opinion -->
                        
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection