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
            @can('afficher-prospects')
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() === 'contact.index' ? 'active bg-gradient-primary' : '' }}" href="{{route('contact.index')}}">
                <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">contacts</i>
                </div>
                <span class="nav-link-text ms-1">Contacts</span>
                </a>
            </li>
            @endcan
            @can('afficher-rendez-vous')
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() === 'rendezvous.index' ? 'active bg-gradient-primary' : '' }}" href="{{route('rendezvous.index')}}">
                <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">handshake</i>
                </div>
                <span class="nav-link-text ms-1">Rendez Vous</span>
                </a>
            </li>
            @endcan
            @can('afficher-clients')
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() === 'client.index' ? 'active bg-gradient-primary' : '' }}" href="{{route('client.index')}}">
                <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <span class="nav-link-text ms-1">Clients</span>
                </a>
            </li>
            @endcan
            
            {{-- @can('afficher-tous-les-candidats')
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() === 'candidat.succursale' ? 'active bg-gradient-primary' : '' }}" href="{{route('candidat.succursale')}}">
                <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">groups</i>
                </div>
                <span class="nav-link-text ms-1">Liste des Candidats</span>
                </a>
            </li>
            @endcan --}}
            @can('voir-dossier-client')
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() === 'client.dossier' ? 'active bg-gradient-primary' : '' }}" href="{{route('client.dossier')}}">
                <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">folder</i>
                </div>
                <span class="nav-link-text ms-1">Dossier Client</span>
                </a>
            </li>
            @endcan
            @can('consultations-a-venir')
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() === 'consultation.programmee' ? 'active bg-gradient-primary' : '' }}" href="{{route('consultation.programmee')}}">
                <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                    <i class="large material-icons opacity-10">access_time</i>
                </div>
                <span class="nav-link-text ms-1">Consultations programmees</span>
                </a>
            </li>
            @endcan
            @can('afficher-consultations')
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() === 'consultation.index' ? 'active bg-gradient-primary' : '' }}" href="{{route('consultation.index')}}">
                <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                    <i class="large material-icons opacity-10">voice_chat</i>
                </div>
                <span class="nav-link-text ms-1">Consultations en cours</span>
                </a>
            </li>
            @endcan
            @can('historique-des-consultations')
                <li class="nav-item">
                    <a class="nav-link text-white {{ Route::currentRouteName() === 'consultation.historique' ? 'active bg-gradient-primary' : '' }}" href="{{route('consultation.historique')}}">
                    <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">date_range</i>
                    </div>
                    <span class="nav-link-text ms-1">Historique des Consultations</span>
                    </a>
                </li>
            @endcan
            
            @can('voir-personnels')
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() === 'equipes.index' ? 'active bg-gradient-primary' : '' }}" href="{{route('equipes.index')}}">
                <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">groups</i>
                </div>
                <span class="nav-link-text ms-1">Equipes</span>
                </a>
            </li>
            @endcan
            @can('voir-banque')
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::currentRouteName() === 'banque.index' ? 'active bg-gradient-primary' : '' }}" href="{{route('banque.index')}}">
                <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">account_balance</i>
                </div>
                <span class="nav-link-text ms-1">Banque</span>
                </a>
            </li>
            @endcan
            @can('lien-consultations')
                <li class="nav-item">
                    <a class="nav-link text-white {{ Route::currentRouteName() === 'consultation.lien' ? 'active bg-gradient-primary' : '' }}" href="{{route('consultation.lien')}}">
                    <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">attachment</i>
                    </div>
                    <span class="nav-link-text ms-1">Lien des Consultations</span>
                    </a>
                </li>
            @endcan
            @can('afficher-succursales')
                <li class="nav-item">
                    <a class="nav-link text-white {{ Route::currentRouteName() === 'succursale.index' ? 'active bg-gradient-primary' : '' }}" href="{{route('succursale.index')}}">
                    <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">flag</i>
                    </div>
                    <span class="nav-link-text ms-1">Les succursales</span>
                    </a>
                </li>
            @endcan
      </ul>
    </div>
    
  </aside>