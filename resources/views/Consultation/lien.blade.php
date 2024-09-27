@extends('layouts.app')
@section('content')
    <div class="row">
      <div class="col-12">
          <div class="card my-4">
             
              <div class="card-header p-0 position-relative mt-n4 mx-3">
                    <div class="bg-gradient-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                        <div class="p-2 border-radius-lg w-40 bg-white">
                            <input type="text " id="searchInput"
                                class="form-control text-dark text-lg bg-transparent border-0 p-1"
                                placeholder="Recherche...">
                        </div>
                        <button class="btn bg-gradient-primary circle" data-bs-toggle="modal" data-bs-target="#addConsultationModal">
                          <i class="material-icons text-white" style="font-size: 2rem;">add</i>
                        </button>
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
                            @foreach ($consultations as $consultation)
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
                                
                                    <span class="text-xs font-weight-bold">{{ $consultation->consultante->name}} {{ $consultation->consultante->last_name }}</span>
                                   
                                </td>
                                
                                <td class="align-middle text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="me-2 text-xs font-weight-bold">{{ $consultation->candidats->count() }} / {{ $consultation->nombre_candidats }} </span>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <a href="{{ $consultation->lien_zoom}}" target="blank" class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-video text-xs"></i>
                                    </a>
                                </td>
                                <td class="align-middle">
                                    <a href="{{ route('consultation.listedattente',$consultation->id) }}" class="btn bg-dark text-white">
                                        Liste d'attente
                                    </a>
                                </td>
                                <td>
                                    @if ($consultation->candidats->isNotEmpty())
                                        <a href="{{ route('consultation.listcandidats',$consultation->id) }}">
                                            <button class="btn bg-gradient-dark">
                                                Voir les candidat(s)
                                            </button>
                                        </a>
                                    @else
                                        <a href="{{ route('consultation.listcandidats',$consultation->id) }}">

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

    <div class="modal z-index-1 fade" id="addConsultationModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter une consultation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('consultation.creer') }}" method="POST" class="text-start" id="consultationForm">
                    @csrf
                    <div class="input-group input-group-outline mb-3 p-2">
                        <label for="label" class="form-label">Label</label>
                        <input type="text" name="label" id="label" class="form-control" required>
                    </div>

                    <div class="input-group input-group-outline mb-3 p-2">
                        <label for="lien_zoom" class="form-label">Lien Zoom</label>
                        <input type="text" name="lien_zoom" id="lien_zoom" class="form-control" required>
                    </div>

                    <div class="input-group input-group-outline mb-3 p-2">
                        <label for="lien_zoom_demarrer" class="form-label">Lien démarrer</label>
                        <input type="text" name="lien_zoom_demarrer" id="lien_zoom_demarrer" class="form-control"
                            required>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group input-group-outline mb-3 p-2">
                                <label for="date_heure" class="form-label">Date et Heure</label>
                                <input type="datetime-local" name="date_heure" id="date_heure" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group input-group-outline mb-3 p-2">
                                <label for="nombre_candidats" class="form-label">Nombre de participants</label>
                                <input type="tel" name="nombre_candidats" id="nombre_candidats" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-select-group form-select-group-outline mb-3 p-2">
                                
                                <select name="id_consultante" id="id_consultante" class="form-select" placeholder="" required>
                                    @foreach ($consultantes as $consultante)
                                        <option value="{{ $consultante->id }}">{{ $consultante->name }}
                                            {{ $consultante->last_name }}</option>
                                    @endforeach
                                </select>
                                <label for="id_consultante" class="form-label">Consultante</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-primary my-4 mb-2" id="submitFormButton">AJOUTER</button>
                            
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

@endsection