<div class="card my-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3">
        <div class="bg-gradient-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
            <div class="p-2 border-radius-lg w-40 bg-white">
                <input type="text " id="searchInput" class="form-control text-dark  text-lg bg-transparent border-0 p-1"
                    placeholder="Recherche...">

            </div>

        </div>

        <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0" style="min-height: 700px; max-height: 700px; overflow-y: auto;">
                <table class="table align-items-center justify-content-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Date
                            </th>
        
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-left opacity-7 ps-2">
                                Heure
                            </th>
        
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                Consultante
                            </th>
        
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                Nombre de Participants
                            </th>
        
                           
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7">
                                Liste d'Attente
                            </th>
        
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7">
                                Voir les Candidats
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        @foreach ($consultations as $consultation)
                        <tr>
                            <td>
                                <div class="d-flex px-2">
                                    <h5 class="p-2 text-md">{{ $consultation->date_heure_formatee }}</h5>
                                </div>
                            </td>
                            <td>
                                <p class="text-md font-weight-bold text-success mb-0">
                                    {{ Carbon\Carbon::parse($consultation->date_heure)->translatedFormat('H:i') }}
                                </p>
                            </td>
                            <td class="text-center">
                                <span class="text-md font-weight-normal">{{ $consultation->consultante->nom }}
                                    {{ $consultation->consultante->prenoms }}</span>
                            </td>
                            <td class="align-middle text-center">
                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="me-2 text-md"> {{$consultation->candidats->count()}} / {{ $consultation->nombre_candidats }}</span>
                                </div>
                            </td>
                            <td class="align-middle d-flex align-items-center justify-content-center">
                                @if (now()->isSameDay(Carbon\Carbon::parse($consultation->date_heure)))
                                    <a href="{{ url('/waiting-list/' . $consultation->id) }}" class="btn btn-dark">
                                        <i class="material-icons">list</i> Liste d'Attente
                                    </a>
                                @else
                                <a href="{{ url('/waiting-list/' . $consultation->id) }}" class="btn btn-dark @if (!now()->isSameDay(Carbon\Carbon::parse($consultation->date_heure))) disabled @endif">
                                    <i class="material-icons">list</i> Liste d'Attente
                                </a>
                                
                                @endif
                            </td>
                            
                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    @if ($consultation->candidats->isNotEmpty())
                                        <a href="{{ url('/Consultation/' . $consultation->id) }}" class="btn btn-dark">
                                            <i class="material-icons">visibility</i> Voir les Candidat(s)
                                        </a>
                                    @else
                                        <button class="btn btn-dark" disabled>
                                            <i class="material-icons">visibility_off</i> Voir les Candidat(s)
                                        </button>
                                    @endif
                                </div>
                            </td>
                            
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        

    </div>
</div>
