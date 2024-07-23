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

    <link rel="icon" type="image/png" href={{ asset('assets/img/logos/logo-icon.png') }}>
    <title>
        Omonde Canada - CRM
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
    <script src={{ asset('assets/js/script/equipe.js') }}></script>
    <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />

    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>

<body class="g-sidenav-show  bg-gray-200">
    @include('partials.navbar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('partials.header', ['page' => "L'ÉQUIPE"])
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-2">
                        <div class="card-header p-0 position-relative mt-n3 mx-3">
                            <div
                                class="bg-gradient-dark border-radius-lg pt-4 pb-2 d-flex flex-column flex-sm-row align-items-center justify-content-between p-4">
                                <div class="p-2 border-radius-lg w-100 w-sm-40 bg-white mb-2">
                                    <input type="text" id="searchInput"
                                        class="form-control text-dark text-lg bg-transparent border-0 p-1"
                                        placeholder="Rechercher...">
                                </div>
                                <div
                                    class="col-12 col-sm-3 d-flex flex-column flex-sm-row align-items-center justify-content-between">
                                    <div class="dropdown">
                                        <div class="btn btn-secondary" type="button" id="dropdownSuccursales"
                                            data-toggle="dropdown">Pays</div>
                                        <div class="dropdown-menu" aria-labelledby="dropdownSuccursales">
                                            @foreach (\App\Models\Succursale::all() as $succursale)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $succursale->label }}"
                                                        id="typePaiement{{ $succursale->id }}" name="pays" checked>
                                                    <label class="form-check-label"
                                                        for="typePaiement{{ $succursale->id }}">{{ $succursale->label }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#creerUtilisateurModal">Créer un utilisateur</div>
                                    @include('Informatique.Partials.CreerUser')
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0" style="max-height: 700px; min-height: 700px; overflow-y: auto;">
                                <table class="table align-items-center justify-content-center mb-0 dataTable">
                                    <thead >
                                        <tr class="mb-4">
                                            <th
                                                class="col-4 col-md-1 text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                                NOM</th>
                                            <th
                                                class="col-4 col-md-1 text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2">
                                                POSTE</th>
                                            <th
                                                class="col-4 col-md-2 text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2">
                                                SUCCURSALE</th>
                                            <th
                                                class="col-4 col-md-1 text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2">
                                                ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2">
                                                        <h6 class="p-2 text-xl">{{ $user->name }}
                                                            {{ $user->last_name }}</h6>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-left">
                                                    <h6 class="p-2 text-xl">{{ $user->posteOccupe->label }}</h6>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <h6 class="p-2 text-xl">{{ $user->succursale->label }}</h6>
                                                </td>
                                                <td class="d-flex align-items-center justify-content-center">
                                                    <div class="dropdown">
                                                        <div class="btn btn-dark" type="button" id="dropdownMenuButton"
                                                            data-bs-toggle="dropdown"><i
                                                                class="material-icons">more_vert</i></div>
                                                        <div class="dropdown-menu d-flex flex-direction-column flex-wrap"
                                                            aria-labelledby="dropdownMenuButton">
                                                            <a class="btn btn-danger col-12 m-1" data-bs-toggle="modal"
                                                                data-bs-target="#ajouterFichierModal{{ $user->id }}">Ajout
                                                                Documents</a>
                                                            <a class="btn btn-danger col-12 m-1" data-bs-toggle="modal"
                                                                data-bs-target="#voirDossierModal{{ $user->id }}">Voir
                                                                Dossier</a>
                                                            <a class="btn btn-danger col-12 m-1" data-bs-toggle="modal"
                                                                data-bs-target="#modifierUtilisateurModal{{ $user->id }}">Modifier
                                                                utilisateur</a>
                                                        </div>
                                                        @include('Direction.Partials.VoirDocAgent')
                                                        @include('Informatique.Partials.ModifierUser')
                                                        @include('Informatique.Partials.AjouterFichierAgent')
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
            </div>
        </div>


    </main>
    @include('partials.plugin')
    <script>
        const table = $('.dataTable').DataTable({
            "language": {
                "lengthMenu": "",
                "zeroRecords": "Aucun résultat trouvé",
                "info": "", // Supprime l'information sur le nombre de pages
                "infoEmpty": "",
                "infoFiltered": "",
                "paginate": {
            
                    "first": '<i class="material-icons">first_page</i>',
                    "last": '<i class="material-icons">last_page</i>',
                    "next": '<i class="material-icons">chevron_right</i>',
                    "previous": '<i class="material-icons">chevron_left</i>'
                },
                "search": "" // Supprime le texte "Search"
            },
            "lengthMenu": [10, 25, 50, 100], // Supprime les options "Show entries" par défaut
            "dom": '<"top"i>rt<"bottom"lp><"clear">',
            "columnDefs": [{
                    "targets": [2], // Indice de la colonne sur laquelle vous souhaitez ajouter un filtre
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": [3], // Indice d'une autre colonne sur laquelle vous souhaitez ajouter un filtre
                    "searchable": true,
                    "orderable": true
                }
                // Ajoutez des blocs comme celui-ci pour chaque colonne que vous souhaitez filtrer
            ]
        });

        // Ajouter les classes de Bootstrap pour centrer horizontalement
        $('.dataTables_paginate.paging_simple_numbers').addClass('d-flex justify-content-center');
        $('.bottom').addClass('d-flex justify-content-center');

        // Utilisez votre barre de recherche personnalisée pour filtrer le tableau
        $('#searchInput').on('input', function() {
            table.search(this.value).draw();
        });

        $('input:checkbox').on('change', function() {
            // Build a regex filter string with an or(|) condition
            var pays = $('input:checkbox[name="pays"]:checked').map(function() {
                return this.value;
            }).get().join('|');
            // Filter in column 1 (index 0), with a regex, no smart filtering, case insensitive
            table.column(2).search(pays, true, false, true).draw(false);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.delete-document').click(function(e) {
                e.preventDefault();
                var url = $(this).attr('data-url');
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(result) {
                        // Affichez un message de succès et rechargez la page ou faites quelque chose d'autre ici
                        alert(result.message);
                        location.reload();
                    },
                    error: function(xhr) {
                        // Affichez un message d'erreur ici
                        alert(xhr.responseJSON.message);
                    }
                });
            });
        });
    </script>


</body>

</html>
