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
        OMONDE CANADA - CRM
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


</head>

<body class="g-sidenav-show  bg-gray-200">
    @include('partials.navbar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('partials.header', ['page' => "L'ÉQUIPE"])
        <!-- End Navbar -->
        <div class="container-fluid py-4">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card my-2">
                        <div class="card-header p-0 position-relative mt-n3 mx-3">
                            <div
                                class="bg-gradient-dark border-radius-lg pt-4 pb-2 d-flex align-items-center justify-content-between p-4">
                                <div class="p-2 border-radius-lg w-40 bg-white">
                                    <input type="text" id="searchInput"
                                        class="form-control text-dark text-lg bg-transparent border-0 p-1"
                                        placeholder="Rechercher...">
                                </div>

                                <div class="dropdown">
                                    <button class="btn btn-secondary" type="button" id="dropdownSuccursales"
                                        data-toggle="dropdown">
                                        Pays
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownSuccursales">
                                        @foreach (\App\Models\Succursale::all() as $succursale)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="{{ $succursale->label }}"
                                                    id="typePaiement{{ $succursale->id }}" name="pays" checked>
                                                <label class="form-check-label" for="typePaiement{{ $succursale->id }}">
                                                    {{ $succursale->label }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0" style="max-height: 700px; overflow-y: auto;">
                                <table class="table align-items-center justify-content-center mb-0 dataTable">
                                    <thead>
                                        <tr>
                                            <th
                                                class="col-md-2  text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                NOM
                                            </th>
                                            <th
                                                class="col-md-2 text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                                POSTE
                                            </th>
                                            <th
                                                class="col-md-2 text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                                SUCCURSALE
                                            </th>
                                            <th
                                                class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                                INDICE PERFORMANCE (MOIS/ANNEES)
                                            </th>
                                            <th
                                                class="col-md-2 text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                                DOCUMENT
                                            </th>
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
                                                    <h6 class="p-2 text-xl">{{ $user->posteOccupe->label }} </h6>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <h6 class="p-2 text-xl">{{ $user->succursale->label }} </h6>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <h6 class="p-2 text-xl">
                                                        {{ $user->rendezVous()->where('date_rdv', today())->count() }}
                                                        /
                                                        {{ $user->rendezVous()->whereMonth('date_rdv', date('m'))->whereYear('date_rdv', date('Y'))->count() }}
                                                  
                                                    </h6>
                                                </td>


                                                <td class="align-middle text-center">
                                                    <button class="btn bg-gradient-dark" data-bs-toggle="modal"
                                                        data-bs-target="#voirDossierModal{{ $user->id }}">
                                                        Voir Dossier

                                                    </button>
                                                    @include('Direction.Partials.VoirDocAgent')

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
                    "first": "Premier",
                    "last": "Dernier",
                    "next": "Suivant",
                    "previous": "Précédent"
                },
                "search": "" // Supprime le texte "Search"
            },
            "lengthMenu": [10, 25, 50, 100], // Supprime les options "Show entries" par défaut
            "dom": '<"top"i>rt<"bottom"flp><"clear">', // Supprime la barre de recherche et "Show entries" en haut
            "columnDefs": [{
                    "targets": [2], // Indice de la colonne sur laquelle vous souhaitez ajouter un filtre
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": [2], // Indice d'une autre colonne sur laquelle vous souhaitez ajouter un filtre
                    "searchable": true,
                    "orderable": true
                }
                // Ajoutez des blocs comme celui-ci pour chaque colonne que vous souhaitez filtrer
            ]
        });
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

</body>

</html>
