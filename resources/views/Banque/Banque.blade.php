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
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />

    <!-- jQuery -->
    <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>

</head>

<body class="g-sidenav-show  bg-gray-200">
    @include('partials.navbar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('partials.header', ['page' => 'BANQUE'])
        <!-- End Navbar -->
        <div class="container-fluid py-4">

            <div class="row">
                <div class="col-lg-12">


                    @php
                        use Carbon\Carbon;
                        use Illuminate\Support\Facades\Auth;

                        $moisActuel = Carbon::now()->format('m');

                        $utilisateurConnecte = Auth::user();

                        $totalCaisseMoisActuel = \App\Models\Entree::whereMonth('date', $moisActuel)
                            ->whereHas('utilisateur', function ($query) use ($utilisateurConnecte) {
                                $query->where('id_succursale', $utilisateurConnecte->id_succursale);
                            })
                            ->sum('montant');

                        $totalDepenseMoisActuel = \App\Models\Depense::whereMonth('date', $moisActuel)
                            ->whereHas('utilisateur', function ($query) use ($utilisateurConnecte) {
                                $query->where('id_succursale', $utilisateurConnecte->id_succursale);
                            })
                            ->sum('montant');
                    @endphp
                    @php

                        $moisActuel = Carbon::now()->format('m');

                        $totalDepenseMoisActuel = \App\Models\Depense::whereMonth('date', $moisActuel)->sum('montant');

                        // Date de début et de fin de la période
                        $dateDebut = Carbon::now();
                        $dateFin = Carbon::now();

                        // Date de début et de fin de semaine
                        $dateDebutSemaine = $dateDebut->startOfWeek();
                        $dateFinSemaine = $dateFin->endOfWeek();

                    @endphp

                    <div class="row">
                        <div class="col-xl-6 mb-4">
                            <div class="card">
                                <div class="card-header mx-4 p-3 text-center">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                        <i class="material-icons opacity-10">account_balance</i>
                                    </div>
                                </div>
                                <div class="card-body pt-0 p-3 text-center">
                                    <h5 class="text-center mb-0">Paiements</h5>
                                    <span class="text-xs">{{ Carbon::now()->format('F') }}</span>
                                    <hr class="horizontal dark my-3">
                                    <h4 class="mb-5 text-center text-success">
                                        {{ number_format($totalCaisseMoisActuel, 0, '.', ' ') }} FCFA</h4>
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header mx-4 p-3 text-center">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                        <i class="material-icons opacity-10">wallet</i>
                                    </div>
                                </div>
                                <div class="card-body pt-0 p-3 text-center">
                                    <h5 class="text-center mb-0">Dépenses</h5>
                                    <span class="text-xs">{{ Carbon::now()->format('F') }}</span>
                                    <hr class="horizontal dark my-3">
                                    <h4 class="mb-5 text-center text-danger">
                                        {{ number_format($totalDepenseMoisActuel, 0, '.', ' ') }} FCFA</h4>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('partials.Banque.tableauTransactionParSemaine')
        </div>

    </main>
    @include('partials.plugin')
</body>

</html>
