@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3">
                    <div class="bg-gradient-dark shadow-primary border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                        <div class="p-2 border-radius-lg w-40 ">
                            <h3 class="text-white">
                                Vos Rendez-Vous
                            </h3>
                        </div>

                        <div class="d-flex align-items-center justify-content-around w-50">

                            <button id="all" class="btn btn-primary">Voir tout</button>
                            <button id="todayButton" class="btn btn-primary">Aujourd'hui</button>
                            <button id="thisWeekButton" class="btn btn-primary filter-btn">Cette semaine</button>
                            <button id="thisMonthButton" class="btn btn-primary filter-btn">Ce Mois</button>
                        </div>

                    </div>

                    <div class="card-body px-0 pb-2 ">
                        <div class="table-responsive p-0  "
                            style="max-height: 700px; min-height: 700px; overflow-y: auto;">
                            <table class="table align-items-center justify-content-center mb-0 bg-white">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            NOM
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            NUMERO
                                        </th>


                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center ">
                                            RDV EFFECTUÉE
                                        </th>

                                        <th class="text-uppercase text-secondary  text-center text-xxs font-weight-bolder opacity-7 ">
                                            CONSULTATION CONCLUE
                                        </th>


                                        <th class="text-uppercase text-secondary text-left text-xxs font-weight-bolder opacity-7 ps-2 ">
                                            MODIFIER
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($candidats as $candidat)
                                        <tr
                                            data-date="{{ Carbon\Carbon::parse($candidat->date_rdv)->format('Y-m-d') }}">

                                            <td>
                                                <div class="d-flex px-2">
                                                    <h6 class="p-2 text-md">{{ $candidat->nom }}
                                                        {{ $candidat->prenom }}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-md font-weight-bold mb-0">
                                                    {{ $candidat->numero_telephone }}</p>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-around">
                                                    @if ($candidat->consultation_effectue == 0)
                                                        <button
                                                            onclick="toggleStatutRendezVous('{{ $candidat->id }}', 'yes');"
                                                            data-candidat-id="{{ $candidat->id }}"
                                                            class="btn btn-primary">
                                                            <i class="material-icons text-bolder icon-large toggle-consultation"
                                                                style="font-size: 2rem;">check</i>
                                                        </button>

                                                        <button
                                                            onclick="toggleStatutRendezVous('{{ $candidat->id }}', 'no');"
                                                            data-candidat-id="{{ $candidat->id }}"
                                                            class="btn btn-primary">
                                                            <i class="material-icons text-bolder icon-large toggle-consultation"
                                                                style="font-size: 2rem;">close</i>
                                                        </button>
                                                    @elseif ($candidat->consultation_effectue == 1)
                                                        <i class="material-icons text-success text-bolder icon-large"
                                                            style="font-size: 2rem;">check</i>
                                                    @endif

                                                </div>

                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center justify-content-around ">
                                                    @if ($candidat->consultation_payee == 0)
                                                        <button onclick="toggleConsultationPayee('{{ $candidat->id }}', 'yes');" data-candidat-id="{{ $candidat->id }}" class="btn btn-primary">
                                                            <i class="material-icons text-bolder icon-large toggle-consultation" style="font-size: 2rem;">check</i>
                                                        </button>

                                                        <button onclick="toggleConsultationPayee('{{ $candidat->id }}', 'no');" data-candidat-id="{{ $candidat->id }}" class="btn btn-primary">
                                                            <i class="material-icons text-bolder icon-large toggle-consultation" style="font-size: 2rem;">close</i>
                                                        </button>
                                                    @elseif ($candidat->rendezVous && $candidat->consultation_payee === 1)
                                                        <i class="material-icons text-success text-bolder icon-large"
                                                            style="font-size: 2rem;">check</i>
                                                    @endif

                                                </div>
                                            </td>



                                            <td>
                                                <a class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modifierContactModal{{ $candidat->id }}">
                                                    <i class="material-icons text-xl"
                                                        style="font-size: 1rem;">edit</i>
                                            </td>

                                        </tr>
                                        {{-- Modal modifier prospect --}}
                                        <div class="modal z-index-1 fade" id="modifierContactModal{{ $candidat->id }}" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modifier Contact</h5>
                                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('contact.update', $candidat->id) }}" method="POST" class="text-start"
                                                            id="modifierContactForm{{ $candidat->id }}" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <!-- Champs Nom et Prénoms sur la même ligne -->
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="nom" class="form-label">Nom</label>
                                                                    <input type="text" name="nom" id="nom" class="form-control"
                                                                            value="{{ $candidat->nom }}" required>
                                                                
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="prenoms" class="form-label">Prénoms</label>
                                                                    <input type="text" name="prenoms" id="prenoms" class="form-control"
                                                                        value="{{ $candidat->prenom }}" required>
                                                                </div>
                                                            </div>
                                        
                                                            <div class="row">
                                                                <!-- Champ Pays -->
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="pays" class="form-label">Pays</label>
                                                                    <input type="text" name="pays" id="pays" class="form-control"
                                                                        value="{{ $candidat->pays }}" required>
                                                                </div>
                                        
                                                                <!-- Champ Ville -->
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="ville" class="form-label">Ville</label>
                                                                    <input type="text" name="ville" id="ville" class="form-control"
                                                                        value="{{ $candidat->ville }}" required>
                                                                </div>
                                                            </div>
                                        
                                                            <!-- Champ Téléphone -->
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="numero_telephone" class="form-label">Téléphone</label>
                                                                    <input type="tel" name="numero_telephone" id="numero_telephone" class="form-control"
                                                                        value="{{ $candidat->numero_telephone }}" required>
                                                                </div>
                                        
                                                                <!-- Champ Email -->
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="email" class="form-label">Email</label>
                                                                    <input type="email" name="email" id="email" class="form-control"
                                                                        value="{{ $candidat->email }}" required>
                                                                </div>
                                                            </div>
                                        
                                                            <div class="row">
                                                                <!-- Champ Profession -->
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="profession" class="form-label">Profession</label>
                                                                    <input type="text" name="profession" id="profession" class="form-control"
                                                                        value="{{ $candidat->profession }}" required>
                                                                </div>
                                        
                                        
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="date_rdv" class="form-label">Date Rendez Vous</label>
                                                                    <input type="date" name="date_rdv" id="date_rdv" class="form-control"
                                                                        value="{{ $candidat->date_rdv }}">
                                                                </div>
                                                            </div>
                                                    </div>
                                        
                                                    <div class="text-center d-flex justify-content-around">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                                                        <button type="button" class="btn btn-success"
                                                            onclick="$('#modifierContactForm{{ $candidat->id }}').submit()">Enregistrer les
                                                            modifications</button>
                                                    </div>
                                        
                                                </div>
                                        
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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

        function toggleConsultationPayee(id, statut) {

            fetch(`/Commercial/RendezVous/ConsultationPayee/${id}/${statut}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                })
                .then(response => {
                   
                    if (!response.ok) {
                        throw new Error(`Network response was not ok (${response.status})`);
                    }
                    return response.json(); 
                })
                .then(data => {
                    console.log(data); 
                    location.reload(); 
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function toggleStatutRendezVous(id, statut) {
            fetch(`/Commercial/RendezVous/RendezVousEffectue/${id}/${statut}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                })
                .then(response => {
                    // Check if the response status is OK (status code 200-299)
                    if (!response.ok) {
                        throw new Error(`Network response was not ok (${response.status})`);
                    }
                    return response.json(); // Parse the response as JSON
                })
                .then(data => {
                    console.log(data); // Log the parsed JSON data
                    // Your code to handle jsonData
                    location.reload(); // Reload the page
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
  
@endsection
