<!--
=========================================================
* Material Dashboard 2 - v3.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/logo-icon.png') }}">



    <title>Omonde Canada - CRM</title>

    <!-- Inclure les polices Google -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

    <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>


    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <script src={{ asset('assets/js/script/dossierClient.js') }}></script>

    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="https://kit.fontawesome.com/bf8b55f4b1.js" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>

<body class="g-sidenav-show  bg-gray-200">
    @include('partials.navbar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('partials.header', ['page' => 'Vos clients'])
        <!-- End Navbar -->

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

                            <div class="d-flex align-items-center justify-content-around col-4">
                                <div
                                    class="p-2 d-flex align-items-center w-30 justify-content-around flex-direction-row">
                                    <div class="dropdown">
                                        <div class="btn btn-secondary" type="button" id="dropdownTypeVisa"
                                            data-toggle="dropdown">
                                            Type de visa
                                        </div>
                                        <div class="dropdown-menu" aria-labelledby="dropdownTypeVisa">
                                            @foreach (\App\Models\TypeProcedure::all() as $typeVisa)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $typeVisa->label }}" id="typeVisa{{ $typeVisa->id }}"
                                                        name="type_visa" checked>
                                                    <label class="form-check-label" for="typeVisa{{ $typeVisa->id }}">
                                                        {{ $typeVisa->label }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                                <div
                                    class="p-2 d-flex align-items-center w-30 justify-content-around flex-direction-row">

                                    <div class="dropdown">

                                        <div class="btn btn-secondary" type="button" id="dropdownStatut"
                                            data-toggle="dropdown">

                                            Statut

                                        </div>

                                        <div class="dropdown-menu" aria-labelledby="dropdownStatut">

                                            @foreach (\App\Models\StatutProcedure::all() as $statut)
                                                <div class="form-check">

                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $statut->label }}" id="statut{{ $statut->id }}"
                                                        name="statut" checked>

                                                    <label class="form-check-label" for="statut{{ $statut->id }}">

                                                        {{ $statut->label }}

                                                    </label>

                                                </div>
                                            @endforeach

                                        </div>

                                    </div>

                                </div>


                            </div>



                        </div>
                        <div class="table-responsive p-0"
                            style="min-height: 700px; max-height: 700px; overflow-y: auto;">
                            <table class="table align-left text-center mb-0" id="candidatsTable">
                                <thead>
                                    <tr>
                                        <th
                                            class="col-md-2 text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                            NOM & PRENOM(S)
                                        </th>
                                        <th
                                            class="col-md-2 text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                            TYPE DE VISA
                                        </th>
                                        <th
                                            class="col-md-3 text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                            STATUT
                                        </th>
                                        <th
                                            class="col-md-3 text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                            VOIR DOCUMENTS
                                        </th>

                                        <th
                                            class="col-md-3 text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                            ACTIONS
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($candidats as $candidat)
                                        <tr>
                                            <td class="align-middle text-start">
                                                <h6 class="p-2 text-md">{{ $candidat->nom }} {{ $candidat->prenom }}
                                                </h6>
                                            </td>

                                            <td class="align-middle p-2">
                                                <span class="text-md">
                                                    @if ($candidat->proceduresDemandees)
                                                        {{ $candidat->proceduresDemandees->typeProcedure->label }}
                                                    @else
                                                        N / A
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-md">
                                                    @if ($candidat->proceduresDemandees)
                                                        {{ $candidat->proceduresDemandees->statut->label ?? 'null' }}
                                                    @else
                                                        N / A
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <button class="btn bg-dark text-white" data-bs-toggle="modal"
                                                    data-bs-target="#voirDossierModal{{ $candidat->id }}">
                                                    Voir Le Dossier
                                                </button>
                                                @include('Administratif.Partials.VoirDocuments')
                                            </td>

                                            <td class="align-middle text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-primary" type="button"
                                                        id="dropdownMenuButton" data-bs-toggle="dropdown">
                                                        <i class="material-icons">more_vert</i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                        <a class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#AjouterVisaModal{{ $candidat->id }}">
                                                            Changer le statut
                                                        </a>

                                                        <a class="dropdown-item"data-bs-toggle="modal"
                                                            data-bs-target="#ajouterFichierModal{{ $candidat->id }}">
                                                            Ajouter des documents
                                                        </a>

                                                        <a class="dropdown-item" href="{{ route('fiche.renseignement.view', ['candidatId' => $candidat->id]) }}">
                                                            Fiche de renseignement
                                                        </a>


                                                    </div>
                                                </div>
                                                @include('Administratif.Partials.AddVisa', [
                                                    'candidat' => $candidat,
                                                ])
                                                @include('Consultante.Partials.AddFichierConsultante')

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
        
        <script>
            $(document).ready(function() {
                var table = $('#candidatsTable').DataTable({
                    "language": {
                        "search": "",
                        "lengthMenu": "",
                        "zeroRecords": "",
                        "info": "",
                        "infoEmpty": "",
                        "infoFiltered": "",
                        "paginate": {
                            "first": '<i class="material-icons">first_page</i>',
                            "last": '<i class="material-icons">last_page</i>',
                            "next": '<i class="material-icons">chevron_right</i>',
                            "previous": '<i class="material-icons">chevron_left</i>'
                        }
                    },
                    "dom": '<"top"i>rt<"bottom"lp><"clear">',
                    "drawCallback": function() {
                        // Ajouter les classes de Bootstrap pour centrer horizontalement
                        $('.dataTables_paginate.paging_simple_numbers').addClass(
                            'd-flex justify-content-center');
                        $('.bottom').addClass('d-flex justify-content-center');
                    }
                });

                // Utilisez votre barre de recherche personnalisée pour filtrer le tableau
                $('#searchInput').on('input', function() {
                    table.search(this.value).draw();
                });

                // Filtre pour le type de visa
                $('input:checkbox[name="type_visa"]').on('change', function() {
                    var types = $('input:checkbox[name="type_visa"]:checked').map(function() {
                        return this.value; // Match partial value
                    }).get().join('|'); // Join all values with OR operator
                    console.log(types)
                    table.column(1).search(types, true, false)
                        .draw(); // Apply filter to column 1 (Type de visa)
                });


                $('input:checkbox[name="statut"]').on('change', function() {
                    var statuts = $('input:checkbox[name="statut"]:checked').map(function() {
                        return this.value; // Match partial value
                    }).get().join('|'); // Join all values with OR operator

                    console.log(statuts)
                    table.column(2).search(statuts, true, false).draw(); // Apply filter to column 2 (Statut)
                });

            });
       
            $(document).ready(function() {
                $('.delete-document').on('click', function(e) {
                    e.preventDefault();

                    var url = $(this).data('url');

                    if (confirm('Êtes-vous sûr de vouloir supprimer ce document ?')) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                // La requête a réussi, afficher une alerte
                                alert('Le document a été supprimé avec succès!');

                                // Recharger la page
                                window.location.reload();
                            },
                            error: function(error) {
                                // La requête a échoué, afficher une alerte ou effectuer d'autres actions
                                console.error('Erreur lors de la suppression du document:', error);
                            }
                        });
                    }
                });
            });

            function ajouterFichiersConsultante(candidatId) {
        var form = $('#ajouterFichierForm' + candidatId)[0];
        var formData = new FormData(form);

        // Log the form data to the console
        console.log("Form Data:", formData);

        $.ajax({
            type: 'POST',
            url: '/Consultante/DossierClient/AjouterFichiersCandidat/' + candidatId,
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response && response.message) {
                    alert(response.message);

                    // Fermer le modal après un ajout réussi
                    $('#ajouterFichierModal' + candidatId).modal('hide');

                    // Actualiser la page pour afficher les changements
                    location.reload();
                } else {
                    console.error('Erreur lors de l\'ajout des fichiers: ' + (response ? response.message :
                        'Réponse non valide'));
                }
            },

            error: function (xhr, status, error) {
                console.error('Erreur AJAX: ' + status + ', ' + error);

                // Ajouter une gestion d'erreur supplémentaire si nécessaire
                alert('Erreur lors de la communication avec le serveur. Veuillez réessayer plus tard.');
            }
        });
    }
        </script>

        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->


        <!-- Inclure le script material-dashboard.min.js -->
        <script src="{{ asset('/assets/js/material-dashboard.min.js?v=3.0.0') }}"></script>
        <script src="{{ asset('/assets/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('/assets/js/core/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
        <script src="{{ asset('/assets/js/plugins/chartjs.min.js') }}"></script>


    </main>

</body>



</html>
z
