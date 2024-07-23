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
  <link rel="icon" type="image/png" href={{ asset('assets/img/logos/logo-icon.png') }}>
   <title>
    Omonde Canada - CRM
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
   <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src={{ asset('assets/js/script/documentAgents.js') }}></script>
    <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>

  
</head>


<body class="g-sidenav-show  bg-gray-200">
  @include('partials.navbar')

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
   
    

    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl w-200" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3 d-flex justify-content-between xl-12">
        <nav aria-label="breadcrumb">
            <h2 class="font-weight-bolder mb-0">DOCUMENT AGENT </h2>
        </nav>
        <div class="p-2 border-radius-lg w-40 bg-gradient-dark">
            <input type="text" id="searchInput" class="form-control text-white  text-lg bg-transparent border-0 p-1" placeholder="Rechercher...">
        </div>
    
        <ul class="navbar-nav d-flex  justify-content-between w-auto">
            @include('partials.user')
    
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center fs-4">
                <a href="javascript:;" class="nav-link text-body p-0 fs-4 " id="iconNavbarSidenav">
                    <div class="sidenav-toggler-inner fs-4">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </a>
            </li>
        </ul>
    </div>
    
    </div>
</nav>

<div class="container-fluid py-4">
    <div class="row">
        @include('partials.DocumentsAgents.cardDossierAgent')
    </div>
    

</div>
    
  </main>

   <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.0.0"></script>

</body>
@include('partials.plugin')

</html>