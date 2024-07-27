<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header center">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/img/logos/logo-omonde.png') }}" class="navbar-brand-img h-200 mx-auto d-block"
                alt="main_logo">
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() === 'dashboard' ? 'active bg-gradient-primary' : '' }}" href="{{route('dashboard')}}">
                <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">dashboard</i>
                </div>
                <span class="nav-link-text ms-1">Tableau de bord</span>
                </a>
            </li>

        @if (auth()->user()->role_as == 'direction')
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() === 'direction.dossier_client' ? 'active bg-gradient-primary' : '' }}" href="{{route('direction.dossier_client')}}">
                <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">folder</i>
                </div>
                <span class="nav-link-text ms-1">Dossier Client</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() === 'direction.banque' ? 'active bg-gradient-primary' : '' }}" href="{{route('direction.banque')}}">
                <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">account_balance</i>
                </div>
                <span class="nav-link-text ms-1">Banque</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() === 'direction.consultation' ? 'active bg-gradient-primary' : '' }}" href="{{route('direction.consultation')}}">
                <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">videocam</i>
                </div>
                <span class="nav-link-text ms-1">Consultations</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() === 'direction.equipe' ? 'active bg-gradient-primary' : '' }}" href="{{route('direction.equipe')}}">
                <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">groups</i>
                </div>
                <span class="nav-link-text ms-1">Equipes</span>
                </a>
            </li>
        @endif

        @if (auth()->user()->role_as == 'consultante')
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() === 'consultante.my_candidat' ? 'active bg-gradient-primary' : '' }}" href="{{route('consultante.my_candidat')}}">
                <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <span class="nav-link-text ms-1">Candidat</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() === 'consultante.all_candidats' ? 'active bg-gradient-primary' : '' }}" href="{{route('consultante.all_candidats')}}">
                <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">groups</i>
                </div>
                <span class="nav-link-text ms-1">Liste des Candidats</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() === 'consultante.dossier_client' ? 'active bg-gradient-primary' : '' }}" href="{{route('consultante.dossier_client')}}">
                <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">folder</i>
                </div>
                <span class="nav-link-text ms-1">Dossier Client</span>
                </a>
            </li>
        @endif

        @if (auth()->user()->role_as == 'commercial')
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() === 'commercial.contact' ? 'active bg-gradient-primary' : '' }}" href="{{route('commercial.contact')}}">
                <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">contacts</i>
                </div>
                <span class="nav-link-text ms-1">Contacts</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() === 'commercial.rendez_vous' ? 'active bg-gradient-primary' : '' }}" href="{{route('commercial.rendez_vous')}}">
                <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">handshake</i>
                </div>
                <span class="nav-link-text ms-1">Rendez Vous</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() === 'dossier_clients' ? 'active bg-gradient-primary' : '' }}" href="{{route('dossier_clients')}}">
                <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">folder</i>
                </div>
                <span class="nav-link-text ms-1">Dossier Client</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() === 'commercial.consultation' ? 'active bg-gradient-primary' : '' }}" href="{{route('commercial.consultation')}}">
                <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">videocam</i>
                </div>
                <span class="nav-link-text ms-1">Consultations</span>
                </a>
            </li>
        
        @endif

        @if (auth()->user()->role_as == 'administratif')
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() === 'administratif.clients' ? 'active bg-gradient-primary' : '' }}" href="{{route('administratif.clients')}}">
                <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <span class="nav-link-text ms-1">Clients</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() === 'administratif.consultation' ? 'active bg-gradient-primary' : '' }}" href="{{route('administratif.consultation')}}">
                <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">videocam</i>
                </div>
                <span class="nav-link-text ms-1">Consultations</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() === 'administratif.dossier_clients' ? 'active bg-gradient-primary' : '' }}" href="{{route('administratif.dossier_clients')}}">
                <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">folder</i>
                </div>
                <span class="nav-link-text ms-1">Dossier Client</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() === 'administratif.banque' ? 'active bg-gradient-primary' : '' }}" href="{{route('administratif.banque')}}">
                <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">account_balance</i>
                </div>
                <span class="nav-link-text ms-1">Banque</span>
                </a>
            </li> 
        @endif

        @if (auth()->user()->role_as == 'informaticien')
           
        @endif

      </ul>
    </div>
    
  </aside>