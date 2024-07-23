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
<html lang="FR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        Omonde Canada - CRM | BANQUE
    </title>
    <link rel="icon" type="image/png" href={{ asset('assets/img/logos/logo-icon.png') }}>

     <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
  
    <script src={{ asset('assets/js/script/dossierContact.js') }}></script>
    <script src={{ asset('assets/js/script/Banque.js') }}></script>
     <link  href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
 

</head>

<body class="g-sidenav-show  bg-gray-200">
    @include('partials.navbar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('partials.header', ['page' => 'BANQUE'])
        <!-- End Navbar -->
        <div class="row">
           @if ($hasPoste)
           <div class="col-lg-12">

            <div class="row d-flex justify-content-around mb-4 p-3">
                <div class="col-xl-4 mb-4 ">
                    <div class="card">
                        <div class="card-header  p-3 text-center d-flex align-items-center justify-content-between">
                            <div
                                class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                <i class="material-icons opacity-10">payments</i>
                            </div>
                            <div>
                                <h3 class="text-center mb-0">Paiements</h3>
                                <span class="text-md">{{ ucfirst($moisEnCours)}}</span>
                               
                            </div>
                        </div>
                        <div class="card-body pt-0 p-3 text-center">
                            <hr class="horizontal dark my-3">
                            <h2 class="mb-5 text-center text-success">
                                {{ number_format($entreeMensuelSuccursale, 0, '.', ' ') }} {{$devise}}</h2>
                        </div>
                        
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header  p-3 text-center d-flex align-items-center justify-content-between">
                            <div
                                class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                <i class="material-icons opacity-10">wallet</i>
                            </div>

                            <div>
                                <h3 class="text-center mb-0">Dépenses</h3>
                            <span class="text-md">{{ ucfirst($moisEnCours)}}
                        </span>
                          
                            </div>
                        </div>
                        <div class="card-body pt-0 p-3 text-center">
                              <hr class="horizontal dark my-3">
                            <h2 class="mb-5 text-center text-danger">
                                {{ number_format($depenseMensuelSuccursale, 0, '.', ' ') }} {{$devise}}</h2>
                        </div>

                        
                    </div>
                </div>


                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header  p-3 text-center d-flex align-items-center justify-content-between">
                            <div
                                class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                <i class="material-icons opacity-10">account_balance</i>
                            </div>

                            <div>
                                <h3 class="text-center mb-0">Caisse</h3>
                            <span class="text-md">{{ ucfirst($moisEnCours)}}
                        </span>
                          
                            </div>
                        </div>
                        <div class="card-body pt-0 p-3 text-center">
                              <hr class="horizontal dark my-3">
                            <h2 class="mb-5 text-center text-dark">
                                {{ number_format(($entreeMensuelSuccursale - $depenseMensuelSuccursale), 0, '.', ' ') }} {{$devise}}</h2>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
           @endif
            <div class="col-12">
                @include('Administratif.Partials.TablePaiement')
            </div>
        </div>
        <div id="loading" class="loading-overlay">
            <div class="loading-spinner"></div>
        </div>
        

    </main>
    @include('partials.plugin')
</body>


</html>
