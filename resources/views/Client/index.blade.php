@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3">
                    <div
                        class="bg-gradient-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                        <div class="p-2 border-radius-lg w-40 bg-white">
                            <input type="text " id="searchInput"
                                class="form-control text-dark  text-lg bg-transparent border-0 p-1"
                                placeholder="Rechercher un candidat...">
                        </div>

                    </div>


                    <div class="card-body px-0 pb-2 bg-white">
                        <div class="table-responsive p-0" style="max-height: 700px; min-height: 700px; overflow-y: auto;">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class=" col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            NOM
                                        </th>
                    
                                        <th class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            NUMERO
                                        </th>
                    
                                        <th class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            PROFFESSION
                                        </th>
                                        
                                        <th
                                            class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder text-left opacity-7 ps-2">
                                            DATE DE CONSULTATION
                                        </th>
                    
                                        <th
                                            class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            ACTIONS
                                        </th>
                    
                                    
                                    </tr>
                                </thead>
                                <tbody>
                    
                                    @foreach ($clients as $candidat)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2">
                                                    <h6 class="p-2 text-lg">{{ $candidat->nom }} {{ $candidat->prenom }}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-lg font-weight-bold mb-0">{{ $candidat->numero_telephone }}</p>
                                            </td>
                                            <td>
                                                <span class="text-lg font-weight-bold">{{ $candidat->profession }}</span>
                                            </td>
                    
                                            <td class="align-middle text-left">
                                                @if ($candidat->consultation_payee && $candidat->infoConsultation)
                                                    <span class="text-lg font-weigh-normal">{{ $candidat->dateFormatee }}</span>
                                                @else
                                                <span class="text-lg text-success font-weigh-normal">N / A</span>
                                           
                                                @endif
                    
                                            </td>
                    
                                            <td class="align-middle text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-dark" type="button" id="dropdownMenuButton"
                                                        data-bs-toggle="dropdown">
                                                        <i class="material-icons">more_vert</i>
                                                    </button>
                                                    <div class="dropdown-menu d-flex flex-direction-column flex-wrap"
                                                        aria-labelledby="dropdownMenuButton">
                                                        <a class="btn btn-danger col-12 m-1" data-bs-toggle="modal"
                                                            data-bs-target="#ModifierFicheModal{{ $candidat->id }}">Ajouter ou modifier
                                                            Fiche de Consultation</a>
                    
                                                        <a class="btn btn-danger col-12 m-1" data-bs-toggle="modal"
                                                            data-bs-target="#AjouterOuModifierConsultationModal{{ $candidat->id }}">Ajouter
                                                            ou Modifier Consultation</a>
                    
                    
                                                    </div>
                                                </div>
                                            </td>
                                            @include('components.ficheclient')
                                            @include('components.ficheconsultation')
                    
                                        </tr>
                                    @endforeach
                    
                                </tbody>
                            </table>
                    
                        </div>
                    
                    </div>
                    

                </div>

                <div id="loading" class="loading-overlay">
                    <div class="loading-spinner"></div>
                </div>
                
            </div>
        </div>
    </div>
@endsection    

