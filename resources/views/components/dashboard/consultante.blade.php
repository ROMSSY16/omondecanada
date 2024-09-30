
<h2 class="title mb-4 text-end">Mois en cours : <span class="text-primary">{{ $moisActuel }}</span></h2>
<div class="row mt-4 d-flex justify-content-around">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header1 p-3 pt-2 d-flex justify-content-between">
                <div class="icon icon-md icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4">
                    <i class="material-icons opacity-10">groups</i>
                </div>
                <h3 class="text-xl text-bold mb-0 text-capitalize">CONSULTATIONS </h3>

            </div>
            <div class="card-body">
                <div class="text-end">
                    <h3 class="mb-0 pt-2">{{  $consultationsCount ?? '0' }}</h3>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <div class="progress mt-2">
                    <div class="progress-bar progress-bar bg-dark" role="progressbar" style="width: {{ ($consultationsCount / 25) * 100 }}%; height:100%;" aria-valuenow="{{$consultationsCount }}" aria-valuemin="0" aria-valuemax="25"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-9 col-sm-6 mb-xl-0 mb-4">
    <div class="card my-4">
                    <div class="table-responsive p-0" style="max-height: 700px; overflow-y: auto;">
                        <table class="table align-items-center justify-content-center mb-0" id="consultationTable">
                            <thead class="bg-dark">
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
                                    <tr data-candidat-id="{{ $consultation->id }}" class="{{  Carbon\Carbon::parse($consultation->date_heure)->isPast() ? 'table-danger' : '' }}" data-date="{{ Carbon\Carbon::parse($consultation->date_heure)->format('Y-m-d') }}">
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
                                            <p class="text-xl text-bold text-center mb-0">{{ ucwords(Carbon\Carbon::parse($consultation->date_heure)->translatedFormat('j F Y / H:i')) }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xl text-bold text-center mb-0">{{ $consultation->candidats->count() }} / {{ $consultation->nombre_candidats }}</p>
                                        </td>
                                        <td class="text-center">
                                            @if ($consultation->candidats->isNotEmpty())
                                                <a href="{{ route('consultation.listcandidats',$consultation->id) }}">
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

<div class="row mt-4 d-flex justify-content-around">
    <div class="col-lg-8 col-md-8 mt-4 mb-4">
        <div class="card z-index-2">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-dark shadow-success border-radius-lg py-3 pe-1">
                    <div class="chart">
                        <canvas id="consultationsChart" class="chart-canvas" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="mb-0">Consultations Conclues du mois</h6>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data for consultations chart
    var consultationsCtx = document.getElementById('consultationsChart').getContext('2d');
    var consultationsChart = new Chart(consultationsCtx, {
        type: 'line', // Line chart for consultations
        data: {
            labels: @json($days),
            datasets: [{
                label: 'Consultations Conclues',
                data: @json($consultationsData),
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>