

@extends('layouts.app')
@section('content')

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
                                            EMAIL
                                        </th>
                    
                                        <th class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            PROFFESSION
                                        </th>
                                        
                                        <th
                                            class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder text-left opacity-7 ps-2">
                                            DATE DE CONSULTATION
                                        </th>
                                        @role('consultante')
                                        <th
                                            class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder text-left opacity-7 ps-2">
                                           CONSULTANTE
                                        </th>
                                        @endrole
                                        @role('commercial')
                                        <th
                                            class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder text-left opacity-7 ps-2">
                                           COMMERCIAL
                                        </th>
                                        @endrole
                                        <th
                                            class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            STATUS
                                        </th>
                    
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                @role ('direction', 'informaticien', 'admimistratif')
                                    @foreach ($allcandidats as $candidat)
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
                                                <p class="text-lg font-weight-bold mb-0">{{ $candidat->email }}</p>
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
                                            @role('consultante')
                                                <td>
                                                    <span class="text-lg font-weight-bold">{{ $candidat->consultante->name }} {{ $candidat->consultante->last_name }}</span>
                                                </td>
                                            @endrole
                                            @role('commercial')
                                                <td>
                                                    <span class="text-lg font-weight-bold">{{ $candidat->utilisateur->name }} {{ $candidat->utilisateur->last_name }}</span>
                                                </td>
                                            @endrole
                                            <td class="align-middle text-center">
                                                @if ($candidat->status =='1')
                                                    <span class="text-lg font-weight-bold badge bg-gradient-success">éffectuée</span>
                                                @endif
                                            </td>
                                           
                                        </tr>
                                    @endforeach
                                @endrole
                                @role ('consultante', 'commercial')
                                    @foreach ($candidats as $candidat)
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
                                                <p class="text-lg font-weight-bold mb-0">{{ $candidat->email }}</p>
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
                                            @role('consultante')
                                                <td>
                                                    <span class="text-lg font-weight-bold">{{ $candidat->consultante->name }} {{ $candidat->consultante->last_name }}</span>
                                                </td>
                                            @endrole
                                            @role('commercial')
                                                <td>
                                                    <span class="text-lg font-weight-bold">{{ $candidat->utilisateur->name }} {{ $candidat->utilisateur->last_name }}</span>
                                                </td>
                                            @endrole
                                            <td class="align-middle text-center">
                                                @if ($candidat->status =='1')
                                                    <span class="text-lg font-weight-bold badge bg-gradient-success">éffectuée</span>
                                                @endif
                                            </td>
                                           
                                        </tr>
                                    @endforeach
                                @endrole
                                    
                    
                                </tbody>
                            </table>
                    
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const allButton = document.querySelector('#all');
                const rows = document.querySelectorAll('tbody tr');
                allButton.addEventListener('click', function() {
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
@endsection

