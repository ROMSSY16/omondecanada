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
        Omonde Canada - CRM | DOSSIER CONTACTS
    </title>
    <link rel="icon" type="image/png" href={{ asset('assets/img/logos/logo-icon.png') }}>
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
    <script src={{ asset('assets/js/script/dossierContact.js') }}></script>
    <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>

</head>

<body class="g-sidenav-show  bg-gray-200">
    @include('partials.navbar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('partials.header', ['page' => 'CONTACTS'])
        <!-- End Navbar -->
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3">
                        <div
                            class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                            <div class="p-2 border-radius-lg w-40 bg-gradient-dark">
                                <input type="text" id="searchInput"
                                    class="form-control text-white  text-lg bg-transparent border-0 p-1"
                                    placeholder="Rechercher...">
                            </div>
                            <button class="btn bg-gradient-dark circle" data-bs-toggle="modal"
                                data-bs-target="#addContactModal">
                                <i class="material-icons">add</i> Ajouter un candidat
                            </button>
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ajouterEntreeModal">
                                <i class="material-icons">add</i> Ajouter une entrée
                            </button>
                            @include('partials.Banque.addEntree')
                            @include('partials.Contact.addContact')
                        </div>


                        @include('partials.Contact.tableCandidat')

                    </div>
                </div>
            </div>
        </div>

    </main>
    @include('partials.plugin')
</body>


</html>
