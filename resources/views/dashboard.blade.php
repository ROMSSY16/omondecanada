@extends('layouts.app')
@section('content')
    @php
        use Carbon\Carbon;
        use Illuminate\Support\Facades\Auth;
        use App\Models\Consultante;
        use App\Models\InfoConsultation;
        
        setlocale(LC_TIME, 'fr_FR.utf8'); // Définir la localisation en français
        $moisActuel = ucfirst(Carbon::now()->formatLocalized('%B'));
    @endphp

    @if (auth()->user()->role_as == 'direction')
        @include('Direction.Partials.VueEnsemble')
        @include('Direction.Partials.ChartEnsemble')
    @endif

    @if (auth()->user()->role_as == 'consultante')
        @php
            Carbon::setLocale('fr');
            $userId = Auth::id();
            $consultanteId = Consultante::where('id_utilisateur', $userId)->value('id');
            $consultations = InfoConsultation::with(['consultante', 'candidats'])
                ->where('id_consultante', $consultanteId)
                ->orderBy('date_heure', 'desc')
                ->get();
        @endphp
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3">
                        <div class="bg-gradient-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                            <div class="p-2 border-radius-lg w-40 bg-white">
                                <input type="text" id="searchInput" class="form-control text-dark text-lg bg-transparent border-0 p-1" placeholder="Recherche...">
                            </div>
                            <div class="d-flex align-items-center justify-content-around w-50">
                                <button id="all" class="btn btn-primary">Voir tout</button>
                                <button id="todayButton" class="btn btn-primary">Aujourd'hui</button>
                                <button id="thisWeekButton" class="btn btn-primary filter-btn">Cette semaine</button>
                                <button id="thisMonthButton" class="btn btn-primary filter-btn">Ce Mois</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive p-0" style="max-height: 700px; overflow-y: auto;">
                        <table class="table align-items-center justify-content-center mb-0" id="consultationTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DEMARRER</th>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2">LABEL</th>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2">DATE ET HEURE</th>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2">NOMBRE DE PARTICIPANTS</th>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2">PARTICIPANTS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($consultations as $consultation)
                                    <tr data-candidat-id="{{ $consultation->id }}" class="{{ Carbon::parse($consultation->date_heure)->isPast() ? 'table-danger' : '' }}" data-date="{{ Carbon::parse($consultation->date_heure)->format('Y-m-d') }}">
                                        <td>
                                            <h6 class="p-4 text-md">
                                                <a href="{{ $consultation->lien_zoom }}" target="_blank">
                                                    <i class="material-icons">videocam</i>
                                                </a>
                                            </h6>
                                        </td>
                                        <td>
                                            <h6 class="p-2 text-center text-md">{{ $consultation->label }}</h6>
                                        </td>
                                        <td>
                                            <p class="text-xl text-bold text-center mb-0">{{ ucwords(Carbon::parse($consultation->date_heure)->translatedFormat('j F Y / H:i')) }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xl text-bold text-center mb-0">{{ $consultation->candidats->count() }} / {{ $consultation->nombre_candidats }}</p>
                                        </td>
                                        <td class="text-center">
                                            @if ($consultation->candidats->isNotEmpty())
                                                <a href="{{ url('Consultation/' . $consultation->id) }}">
                                                    <button class="btn btn-dark text-white">Voir les candidat(s)</button>
                                                </a>
                                            @else
                                                <a href="#">
                                                    <button class="btn btn-dark text-white">Voir les candidat(s)</button>
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
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Sélectionnez le bouton "Voir tout"
                const allButton = document.querySelector('#all');
                // Sélectionnez toutes les lignes du tableau
                const rows = document.querySelectorAll('tbody tr');
                // Ajoutez un écouteur d'événements au bouton "Voir tout"
                allButton.addEventListener('click', function() {
                    // Parcourez toutes les lignes et affichez-les
                    rows.forEach(function(row) {
                        row.style.display = '';
                    });
                });
            });

            document.addEventListener("DOMContentLoaded", function() {
                // Sélectionnez les boutons de filtre
                const todayButton = document.querySelector('#todayButton');
                const thisWeekButton = document.querySelector('#thisWeekButton');
                const thisMonthButton = document.querySelector('#thisMonthButton');
                // Sélectionnez toutes les lignes du tableau
                const rows = document.querySelectorAll('tbody tr');
                // Fonction pour filtrer les rendez-vous en fonction de la date
                function filterAppointments(dateFilter) {
                    const currentDate = new Date();
                    // Définir la date de début de la semaine actuelle
                    const startOfWeek = new Date(currentDate);
                    startOfWeek.setDate(currentDate.getDate() - currentDate.getDay());
                    // Définir la date de fin de la semaine actuelle
                    const endOfWeek = new Date(currentDate);
                    endOfWeek.setDate(startOfWeek.getDate() + 6);
                    rows.forEach(function(row) {
                        const rowDate = new Date(row.getAttribute('data-date'));
                        if (dateFilter === 'today' && rowDate.toDateString() === currentDate.toDateString()) {
                            row.style.display = '';
                        } else if (dateFilter === 'thisWeek' && rowDate >= startOfWeek && rowDate <= endOfWeek) {
                            row.style.display = '';
                        } else if (dateFilter === 'thisMonth' && rowDate.getMonth() === currentDate.getMonth()) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                }
                // Ajoutez des écouteurs d'événements aux boutons de filtre
                todayButton.addEventListener('click', function() {
                    filterAppointments('today');
                });
                thisWeekButton.addEventListener('click', function() {
                    filterAppointments('thisWeek');
                });
                thisMonthButton.addEventListener('click', function() {
                    filterAppointments('thisMonth');
                });
            });
        </script>
    @endif

    @if (auth()->user()->role_as == 'commercial')
        <div class="row mt-4 d-flex justify-content-around">
            {{-- Nombre d'appels --}}
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header1 p-3 pt-2 d-flex justify-content-between">
                        <div class="icon icon-md icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4">
                            <i class="material-icons opacity-10">phone</i>
                        </div>
                        <p class="text-xl text-bold mb-0 text-capitalize">Appels - Aujourd'hui</p>
            
                    </div>
                    <div class="card-body">
                        <div class="text-end">
                            
                            <h3 class="mb-0 pt-2">{{ $totalAppelDeCeJour ?? '0' }}</h3>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <div class="progress mt-2">
                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{ ($totalAppelDeCeJour / 100) * 100 }}%; ; height:100%;" aria-valuenow="{{ $totalAppelDeCeJour }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
            {{-- Nombre de visites --}}
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header1 p-3 pt-2 d-flex justify-content-between">
                        <div class="icon icon-md icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4 ">
                            <i class="material-icons opacity-10">groups</i>
                        </div>
                        <p class="text-xl text-bold mb-0 text-capitalize">Rendez-vous conclus </br> Aujourd'hui </p>
                        
                    </div>
                    
                    <div class="card-body">
                        <div class="text-end">
                            <h3 class="mb-0 pt-2">{{ $totalVisiteAujourdhui ?? '0' }}</h3>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        {{-- Barre de progression --}}
                        <div class="progress mt-2">
                            <div class="progress-bar progress-bar-striped bg-dark" role="progressbar" style="width: {{ ($totalVisiteAujourdhui / 25) * 100 }}%; ; height:100%;"" aria-valuenow="{{ $totalVisiteAujourdhui }}" aria-valuemin="0" aria-valuemax="25"></div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Nombre de consultations --}}
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header1 p-3 pt-2 d-flex justify-content-between">
                        <div class="icon icon-md icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4">
                            <i class="material-icons opacity-10">handshake</i>
                        </div>
                        <p class="text-xl text-bold mb-0 text-capitalize">Consultations - {{ $moisActuel }}</p>
            
                    </div>
                    <div class="card-body">
                        <div class="text-end">
                          
                            <h3 class="mb-0 pt-2">{{  $totalConsultationsDeCeMois ?? '0' }}</h3>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <div class="progress mt-2">
                            <div class="progress-bar progress-bar bg-dark" role="progressbar" style="width: {{ ($totalConsultationsDeCeMois / 25) * 100 }}%; height:100%;" aria-valuenow="{{$totalConsultationsDeCeMois }}" aria-valuemin="0" aria-valuemax="25"></div>
                        </div>
                        
                        
                    </div>
                    
                </div>
            </div>
            {{-- Nombre de consultations --}}
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header1 p-3 pt-2 d-flex justify-content-between">
                        <div class="icon icon-md icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4">
                            <i class="material-icons opacity-10">trending_up</i>
                        </div>
                        <p class="text-xl text-bold mb-0 text-capitalize">Objectifs - {{ $moisActuel }}</p>
                    </div>
                    <div class="row card-body">
                        <div class="col-4 text-center ">
                            <i class="material-icons text-bold text-success ">phone</i>
                            <h5 class="text-bold">100</h5>
                        </div>
                        <div class="col-4 text-center">
                            <i class="material-icons text-bold text-success ">groups</i>
                            <h5 class="text-bold">25</h5>
                        </div>
                        <div class="col-4 text-center">
                            <i class="material-icons text-bold text-success ">handshake</i>
                            <h5 class="text-bold">25</h5>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row mt-4 d-flex justify-content-around">
            <div class="col-lg-5 col-md-6 mt-4 mb-4">
                <div class="card z-index-2 ">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-dark shadow-primary border-radius-lg py-3 pe-1">
                            <div class="chart">
                                <canvas id="chart-bars" class="chart-canvas" height="200px"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-0 ">Courbes des appels de la semaine</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 mt-4 mb-4">
                <div class="card z-index-2  ">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-dark shadow-success border-radius-lg py-3 pe-1">
                            <div class="chart">
                                <canvas id="chart-line" class="chart-canvas" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-0 "> Consultation Conclue par mois</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4 mb-3 d-flex justify-content-around">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3">
                        <div class="bg-gradient-dark shadow-primary border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                            <div class="p-2 border-radius-lg w-100 d-flex flex-direction-row justify-content-between ">
                                <h3 class="text-white">
                                    Rendez-vous du jour
                                </h3>
        
                                <a href="{{ route('commercial.rendez_vous') }}" class="btn btn-primary">
                                    Voir tout
                                </a>
                            </div>
                        </div>
        
                        <div class="card-body px-0 pb-2 ">
                            <div class="table-responsive p-0" style="max-height: 750px; overflow-y: auto;">
                                <table class="table align-items-center justify-content-between mb-0 bg-white">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-left text-secondary text-xxs font-weight-bolder opacity-7">
                                                NOM
                                            </th>
                                            <th
                                                class="text-uppercase  text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                NUMERO
                                            </th>
                                            <th
                                                class="text-uppercase  text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                PROFFESSION
                                            </th>
        
                                            <th
                                                class="text-uppercase  text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                DATE DE RDV
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rendezVous as $candidat)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2">
                                                        <h6 class="p-2 text-md">{{ $candidat->nom }} {{ $candidat->prenom }}
                                                        </h6>
                                                    </div>
                                                </td>
        
                                                <td>
                                                    <p class="text-md font-weight-bold mb-0">{{ $candidat->numero_telephone }}
                                                    </p>
                                                </td>
        
                                                <td>
                                                    <span class="text-md font-weight-bold">{{ $candidat->profession }}</span>
                                                </td>
                                                <td>
                                                    @php
                                                        $carbonDate = \Carbon\Carbon::parse($candidat->rendezVous->date_rdv);
                                                        $formattedDate = ucwords($carbonDate->translatedFormat('l j F Y'));
                                                    @endphp
                                                    <span class="text-md font-weight-bold">{{ $formattedDate ?? 'Pas de rdv' }}</span>
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
        </div>
    @endif

    @if (auth()->user()->role_as == 'administratif')
        <div class="row">
            {{-- Total caisse --}}
            @include('Administratif.Partials.Caisse')
            {{-- Nombre de Consultation --}}
            @include('Administratif.Partials.Consultation')
            {{-- Nombre de versements --}}
            @include('Administratif.Partials.Versement')
           
            @include('Administratif.Partials.Entree')
           
        </div>
        <div class="row d-flex justify-content-between flex-direction-column">
            @include('Administratif.Partials.ChartEntree')
            @include('Administratif.Partials.ProchaineConsultation')
        </div>
    @endif

    @if (auth()->user()->role_as == 'informaticien')
    @endif
@endsection
