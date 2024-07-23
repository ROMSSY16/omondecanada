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

    <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>

    <title>OMONDE CANADA - CRM</title>

    <!-- Inclure les polices Google -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
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

    <script src="{{ asset('assets/js/script/ConsultationAdmin.js') }}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body class="g-sidenav-show  bg-gray-200">
    @include('partials.navbar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('partials.header', ['page' => 'Consultante'])
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
                            <div class="d-flex align-items-center justify-content-around w-50">

                                <button id="all" class="btn btn-primary">Voir tout</button>
                                <button id="todayButton" class="btn btn-primary">Aujourd'hui</button>
                                <button id="thisWeekButton" class="btn btn-primary filter-btn">Cette semaine</button>
                                <button id="thisMonthButton" class="btn btn-primary filter-btn">Ce Mois</button>
                                <div class="dropdown">
                                    <button class="btn btn-primary" type="button" id="dropdownConsultante"
                                        data-toggle="dropdown">
                                        Consultante
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownConsultante">
                                        @foreach (\App\Models\consultante::all() as $consultante)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="{{ $consultante->nom }} {{ $consultante->prenoms }}"
                                                    id="consultante{{ $consultante->id }}" name="consultante" checked>
                                                <label class="form-check-label" for="consultante{{ $consultante->id }}">
                                                    {{ $consultante->nom }} {{ $consultante->prenoms }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="table-responsive p-0" style=" max-height: 700px; min-height: 700px; overflow-y: auto;">
                        <table class="table align-items-center justify-content-center mb-0" id="consultationTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary  text-xxs font-weight-bolder opacity-7">
                                        REJOINDRE
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
                                        NOMBRE DE CANDIDATS
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2">
                                        CONSULTANTE
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($consultations as $consultation)
                                    <tr data-candidat-id="{{ $consultation->id }}"
                                        class="{{ $consultation->datePassee ? 'table-danger' : '' }}"
                                        data-date="{{ Carbon\Carbon::parse($consultation->date_heure)->format('Y-m-d') }}">

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
                                            <p class="text-xl text-bold text-center text-capitalize mb-0">
                                                {{ $consultation->dateFormatee }}
                                            </p>

                                        </td>
                                        <td class="">
                                            <p class="text-xl text-bold text-center mb-0">
                                                {{ $consultation->candidats->count() }} /
                                                {{ $consultation->nombre_candidats }}
                                            </p>

                                        </td>
                                        <td>
                                            <p class="text-xl text-bold text-center  mb-0">
                                                {{ $consultation->consultante->nom . ' ' . $consultation->consultante->prenoms }}
                                            </p>

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
