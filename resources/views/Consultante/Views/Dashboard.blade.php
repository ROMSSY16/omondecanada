
        @php

            use Illuminate\Support\Facades\Auth;
            use Illuminate\Support\Carbon;
            Carbon::setLocale('fr');

            $userId = Auth::id();
            $consultanteId = App\Models\consultante::where('id_utilisateur', $userId)->value('id');

            $consultations = App\Models\InfoConsultation::with(['consultante', 'candidats'])
                ->where('id_consultante', $consultanteId)
                ->orderBy('date_heure', 'desc')
                ->get();
        @endphp
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3">

                        <div
                            class="bg-gradient-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                            <div class="p-2 border-radius-lg w-40 bg-white">
                                <input type="text " id="searchInput"
                                    class="form-control text-dark  text-lg bg-transparent border-0 p-1"
                                    placeholder="Recherche...">



                            </div>
                            <div class="d-flex align-items-center justify-content-around w-50">

                                <button id="all" class="btn btn-primary">Voir tout</button>
                                <button id="todayButton" class="btn btn-primary">Aujourd'hui</button>
                                <button id="thisWeekButton" class="btn btn-primary filter-btn">Cette semaine</button>
                                <button id="thisMonthButton" class="btn btn-primary filter-btn">Ce Mois</button>
                            </div>
                             </div>
                    </div>
                    <div class="table-responsive p-0" style=" max-height: 700px; overflow-y: auto;">
                        <table class="table align-items-center justify-content-center mb-0" id="consultationTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary  text-xxs font-weight-bolder opacity-7">
                                        DEMARRER
                                    </th>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2"
                                        style=>
                                        LABEL
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2">
                                        DATE ET HEURE
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2">
                                        NOMBRE DE PARTICIPANTS
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary  text-center text-xxs font-weight-bolder opacity-7 ps-2">
                                        PARTICIPANTS
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($consultations as $consultation)
                                    <tr data-candidat-id="{{ $consultation->id }}  "
                                        class="{{ Carbon::parse($consultation->date_heure)->isPast() ? 'table-danger' : '' }}"   data-date="{{ Carbon::parse($consultation->date_heure)->format('Y-m-d') }}">
                                        
                                        <td>
                                            <h6 class="p-4 text-md"> <a href="{{ $consultation->lien_zoom }}"
                                                    target="_blank">
                                                    <i class="material-icons">videocam</i>

                                                </a></h6>
                                        </td>
                                        <td>
                                            <h6 class="p-2 text-center text-md">{{ $consultation->label }}</h6>
                                        </td>
                                        <td>
                                            <p class="text-xl text-bold text-center  mb-0">
                                                {{ ucwords(Carbon::parse($consultation->date_heure)->translatedFormat('j F Y / H:i')) }}
                                            </p>

                                        </td>
                                        <td class="">
                                            <p class="text-xl text-bold text-center mb-0">
                                                {{ $consultation->candidats->count() }} /
                                                {{ $consultation->nombre_candidats }}
                                            </p>

                                        </td>
                                        <td class="text-center">
                                            @if ($consultation->candidats->isNotEmpty())
                                                <a href="{{ url('Consultation/' . $consultation->id) }}">
                                                    <button class="btn btn-dark text-white">
                                                        Voir les candidat(s)
                                                    </button>
                                                </a>
                                            @else
                                                <a href="#">

                                                    <button class="btn btn-dark text-white">
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
                            } else if (dateFilter === 'thisWeek' && rowDate >= startOfWeek && rowDate <=
                                endOfWeek) {
                                row.style.display = '';
                            } else if (dateFilter === 'thisMonth' && rowDate.getMonth() === currentDate
                                .getMonth()) {
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
        