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
        OMONDE CANADA CRM | CONSULATATIONS
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
    <script src={{ asset('assets/js/script/equipe.js') }}></script>

</head>

<body class="g-sidenav-show  bg-gray-200">
    @include('partials.navbar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('partials.header', ['page' => 'CONSULTATIONS'])
        <!-- End Navbar -->
        <div class="row">
            <div class="col-12 ">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3">
                        <div
                            class="bg-gradient-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                            <div class="p-2 border-radius-lg w-40 bg-white">
                                <input type="text " id="searchInput"
                                    class="form-control text-dark  text-lg bg-transparent border-0 p-1"
                                    placeholder="Recherche...">

                            </div>
                            <div
                                class="col-md-3 col-sm-5 d-flex flex-column flex-sm-row align-items-center justify-content-between">
                                <button class="btn btn-secondary" onclick="filterConsultations('past')">Passé</button>
                                <button class="btn btn-secondary" onclick="filterConsultations('upcoming')">A
                                    venir</button>
                                <button class="btn btn-secondary" onclick="filterConsultations('all')">Voir
                                    tout</button>
                            </div>

                            <button class="btn bg-gradient-primary circle" data-bs-toggle="modal"
                                data-bs-target="#addConsultationModal">
                                <i class="material-icons text-gradient-dark" style="font-size: 2rem;">add</i>

                            </button>

                            @include('Informatique.Partials.AddConsultation')
                        </div>
                    </div>

                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0 " style="max-height: 700px; min-height: 700px;">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead class="col-xs-12">
                                    <tr>
                                        <th
                                            class="text-uppercase col-2 text-secondary  text-xxs font-weight-bolder opacity-7">
                                            LABEL
                                        </th>
                                        <th
                                            class="text-uppercase col-2 text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2">
                                            DATE
                                        </th>
                                        
                                        <th
                                            class="text-uppercase col-2 text-secondary  text-center text-xxs font-weight-bolder opacity-7 ps-2">
                                            CONSULTANTE
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            NOMBRE DE PARTICIPANTS
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            ACTIONS
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($consultations as $consultation)
                                        <tr data-date="{{ $consultation->date_heure }}">
                                            <td>
                                                <div class="d-flex px-2">
                                                    <h6 class="text-lg">{{ $consultation->label }}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-lg font-weight-bold mb-0 text-success">
                                                    {{ $consultation->dateFormatee }}</p>
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="font-weight-bold text-lg text-center text-danger">{{ $consultation->consultante->nom }}
                                                    {{ $consultation->consultante->prenoms }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <span
                                                        class="me-2 text-lg font-weight-bold">{{ $consultation->candidats->count() }}
                                                        / {{ $consultation->nombre_candidats }}</span>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="dropdown">
                                                    <div class="btn btn-dark" type="button" id="dropdownMenuButton"
                                                        data-bs-toggle="dropdown">
                                                        <i class="material-icons">more_vert</i>
                                                    </div>
                                                    <div class="dropdown-menu d-flex flex-direction-column flex-wrap"
                                                        aria-labelledby="dropdownMenuButton">
                                                        <!-- Lien pour la salle d'attente -->
                                                        <a class="btn btn-dark col-12 m-1"
                                                            href="{{ url('/waiting-list/' . $consultation->id) }}">SALLE
                                                            D'ATTENTE</a>
                                                        <!-- Lien pour voir les candidats -->
                                                        <a class="btn btn-dark col-12 m-1"
                                                            href="{{ $consultation->candidats->isNotEmpty() ? '/Consultation/' . $consultation->id : '#' }}">VOIR
                                                            LES CANDIDATS</a>
                                                        <!-- Lien pour accéder à la consultation -->
                                                        <a class="btn btn-dark col-12 m-1"
                                                            href="{{ $consultation->lien_zoom_demarrer }}">ACCEDER A LA
                                                            CONSULTATION</a>
                                                        <!-- Lien pour modifier la consultation (ouvre le modal) -->
                                                        <a class="btn btn-dark col-12 m-1 modifier-consultation"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#mdfConsultation{{ $consultation->id }}">MODIFIER
                                                            CONSULTATION</a>
                                                        <!-- Lien pour accéder à la consultation -->
                                                        <form id="deleteForm{{ $consultation->id }}"
                                                            action="{{ route('supprimerConsultation', ['id' => $consultation->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <!-- Ajoutez d'autres champs du formulaire si nécessaire -->
                                                        </form>
                                                        <a class="btn btn-dark col-12 m-1 delete-consultation"
                                                            href="#" data-id="{{ $consultation->id }}">SUPPRIMER
                                                            LA CONSULTATION</a>

                                                    </div>


                                                </div>
                                            </td>
                                        </tr>
                                        @include('Informatique.Partials.mdfConsultation')
                                    @endforeach

                                </tbody>



                            </table>
                        </div>
                    </div>
                    <div id="loading" class="loading-overlay">
                        <div class="loading-spinner"></div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </main>


    @include('partials.plugin')

</body>

</html>
