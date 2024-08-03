@extends('layouts.app')
@section('content')

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

@endsection
 