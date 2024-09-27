@extends('layouts.app')
@section('content')
    <div class="row">
      <div class="col-12">
          <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                  <div
                      class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                      <h6 class="text-white text-capitalize ps-3 mb-0">LISTE DES CONSULTATIONS</h6>
                      <button class="btn bg-gradient-dark circle" data-bs-toggle="modal"
                          data-bs-target="#addConsultationModal">
                          <i class="material-icons text-white" style="font-size: 2rem;">add</i>

                      </button>

                      @include('partials.Consultation.addConsultation')
                  </div>
              </div>

              <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0"  style="max-height: 750px;">
                    <table class="table align-items-center justify-content-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    LABEL
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    DATE
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    CONSULTANTE
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                    NOMBRE DE PARTICIPANTS
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (\App\Models\InfoConsultation::all() as $consultation)
                            <tr>
                                <td>
                                    <div class="d-flex px-2">
                                        <h6 class="p-2 text-sm">{{ $consultation->label }}</h6>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{ $consultation->date_heure}}</p>
                                </td>
                                <td>
                                
                                        <span class="text-xs font-weight-bold">{{ $consultation->consultante->nom }} {{ $consultation->consultante->prenoms }}</span>
                                   
                                </td>
                                
                                <td class="align-middle text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="me-2 text-xs font-weight-bold">{{ $consultation->nombre_candidats }}</span>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <a href="{{ $consultation->lien_zoom}}" target="blank" class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-video text-xs"></i>
                                    </a>
                                </td>
                                <td class="align-middle">
                                    <a href="{{ route('listeattente', $consultation->id) }}" class="btn bg-dark text-white">
                                        Liste d'attente
                                    </a>
                                </td>
                                <td>
                                    @if ($consultation->candidats->isNotEmpty())
                                        <a href="Consultation/{{ $consultation->id }}">
                                            <button class="btn bg-gradient-dark">
                                                Voir les candidat(s)
                                            </button>
                                        </a>
                                    @else
                                        <a href="#">

                                            <button class="btn bg-gradient-dark">
                                                Voir les candidat(s)
                                            </button>

                                        </a>
                                    @endif
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
          </div>
      </div>
    </div>
@endsection