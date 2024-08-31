@extends('layouts.app')
@section('content')

<div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3">
                        <div class="bg-gradient-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                            <h3 class="text-white text-capitalize p-2">Fiche de renseignement de {{ $candidat->nom  }} {{ $candidat->prenom  }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="accordionExample">
                            @foreach ($categories as $category)
                                <div class="accordion-item">
                                    <h1 class="accordion-button collapsed text-lg" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $category->id }}" aria-expanded="false" aria-controls="collapse{{ $category->id }}">
                                        {{ $category->name }}
                                    </h1>     
                                    <div id="collapse{{ $category->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $category->id }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            @php $count = 0; @endphp
                                            @foreach ($category->questions as $question)
                                                @if ($count % 3 === 0)
                                                    <div class="row">
                                                @endif
                                                <div class="col-md-4">
                                                    <div class="response-item mb-3 p-3">
                                                        <strong class="question d-block mb-2">{{ $question->question }}</strong>
                                                        <span class="answer d-block">
                                                            {{ $responses[$category->id][$question->id] ?? '' }}
                                                        </span>
                                                    </div>
                                                </div>
                                                @php $count++; @endphp
                                                @if ($count % 3 === 0 || $loop->last)
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Ajouter un rectangle supplémentaire pour les remarques -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="response-item mb-3 p-3">
                                    <strong class="question d-block mb-2">Remarques</strong>
                                    <span class="answer d-block">
                                        {{ $consultationRecord->remarque_agent ?? '' }}
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Bouton pour afficher le CV -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
@endsection