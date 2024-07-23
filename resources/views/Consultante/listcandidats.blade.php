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
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>LISTE DES CANDIDATS - Omonde Canada - CRM
    </title>
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <!-- Assurez-vous que le chemin est correct en fonction de votre structure de dossiers -->
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/logo-icon.png') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>

<body class="g-sidenav-show  bg-gray-200">
    @include('partials.navbar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('partials.header', ['page' => 'CANDIDATS'])
        <!-- End Navbar -->

        <div class="row">
            <div class="col-12">
                <div class="card my-4">

                    <div class="card-header p-0 position-relative mt-n4 mx-3">

                        <div
                            class="bg-gradient-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                            <div class="p-2 border-radius-lg w-40 bg-white">
                                <input type="text " id="searchInput"
                                    class="form-control text-dark text-lg bg-transparent border-0 p-1"
                                    placeholder="Recherche...">
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive p-0" style="max-height: 700px; min-height: 700px; overflow-y: auto;">
                        <table class="table align-items-center justify-content-center mb-0" id="candidatsTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                        N°
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        NOM
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        PRENOMS
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        PROFESSION
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        VOIR FICHE DE CONSULTATION
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        CONSULTATION EFFECTUÉE
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($info_consultation->candidats as $candidat)
                                    <tr data-candidat-id="{{ $candidat->id }}">
                                        <td class="text-md text-bold ps-4" style="width: 5%;">
                                            N° {{ $loop->iteration }}
                                        </td>
                                        <td class="text-md  ps-4" style="width: 15%;">
                                            {{ $candidat->nom }}
                                        </td>
                                        <td class="text-md  ps-4" style="width: 15%;">
                                            {{ $candidat->prenom }}
                                        </td>
                                        <td class="text-md  ps-4" style="width: 15%;">
                                            {{ $candidat->profession }}
                                        </td>
                                        <td style="width: 20%;">
                                            <a href="{{ $info_consultation->id }}/{{ $candidat->id }}">
                                                <button class="btn bg-dark text-white">
                                                    Voir fiche de consultation
                                                </button>
                                            </a>
                                        </td>
                                        <td class="text-center" style="width: 20%;">
                                            <div class="d-flex align-items-center justify-content-around">
                                                @if (!$candidat->consultation_effectuee)
                                                    <a href="{{ route('toggleConsultation', ['candidatId' => $candidat->id, 'status' => 'yes']) }}"
                                                        data-status="yes" data-candidat-id="{{ $candidat->id }}">
                                                        <i class="material-icons text-success text-bolder icon-large toggle-consultation"
                                                            style="font-size: 2rem;">check</i>
                                                    </a>

                                                    <a href="{{ route('toggleConsultation', ['candidatId' => $candidat->id, 'status' => 'no']) }}"
                                                        data-status="no" data-candidat-id="{{ $candidat->id }}">
                                                        <i class="material-icons text-danger icon-large text-bolder toggle-consultation"
                                                            style="font-size: 2rem">close</i>
                                                    </a>
                                                @else
                                                    <i class="material-icons text-success text-bolder icon-large"
                                                        style="font-size: 2rem;">check</i>
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
        </div>

        <script src="{{ asset('/assets/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('/assets/js/core/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
        <script src="{{ asset('/assets/js/plugins/chartjs.min.js') }}"></script>

    </main>

</body>


</html>
