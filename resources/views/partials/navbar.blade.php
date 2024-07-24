<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header center">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ url('home') }}" target="_blank">
            <img src="{{ asset('assets/img/logos/logo-omonde.png') }}" class="navbar-brand-img h-200 mx-auto d-block"
                alt="main_logo">
        </a>
    </div>

    <hr class="horizontal light mt-0 mb-2">
    <div class="w-auto max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @php
                $pages = [
                    // Pages Consultante
                    'consultante.dashboard' => 'Dashboard',
                    'consultante.dossier_client' => 'Dossier Client',

                    // Pages Commerciaux
                    'commercial.dashboard' => 'Dashboard',
                    'commercial.contact' => 'Contacts',
                    'commercial.rendez_vous' => 'Rendez-Vous',
                    'administratif.clients' => 'Clients',
                    'administratif.consultation' => 'Consultation',


                    // Pages Administratif
                    'administratif.dashboard' => 'Dashboard',
                    'administratif.clients' => 'Clients',
                    'administratif.dossier_clients' => 'Dossier Client',
                    'administratif.banque' => 'Banque',
                    'administratif.consultation' => 'Consultation',

                    //Pages Direction
                    'direction.dashboard' => 'Dashboard',
                    'direction.dossier_client' => 'Dossier Client',
                    'direction.banque' => 'Banque',
                    'direction.consultation' => 'Consultation',
                    'direction.equipe' => 'L\'equipe',
                    

                    //Pages IT
                    'informatique.dashboard' => 'Dashboard',
                    'informatique.client' => 'Clients',
                    'informatique.equipe' => 'L\'equipe',


                    // Other Pages
                    'dossier_contacts' => 'Contacts',
                    'dossier_clients' => 'Dossier Clients',
                    'banque' => 'Banque',
                    'dashboard_consultante' => 'Consultante',
                    'consultation' => 'Consultations',
                    'admin_dashboard' => "Vue d'ensemble",
                    'dossier' => 'Document Clients',
                    'equipe_view' => "L'equipe",
                    'document_agent' => 'Document Agent',
                ];

                $currentRoute = \Request::route()->getName();
                $currentUserRole = auth()->user()->getRole() ;
      
     @endphp

    @foreach ($pages as $page => $pageTitle)
        @if (
            ($currentUserRole == 0 && in_array($page, ['consultante.dashboard' , 'consultante.dossier_client'])) ||

            ($currentUserRole == 1 && in_array($page, array_merge(['commercial.dashboard', 'commercial.contact', 'commercial.rendez_vous',  'administratif.clients', 'administratif.consultation' ], in_array(auth()->user()->id_poste_occupe, [3,5]) ? ['administratif.banque'] : []))) ||
    ($currentUserRole == 2 &&
        in_array($page, [
            'administratif.dashboard',
            'administratif.clients',
            'administratif.dossier_clients',
            'administratif.banque',
            'administratif.consultation',
        ])) ||
    ($currentUserRole == 3 &&
        in_array($page, [
            'informatique.dashboard',
            'informatique.client',
            'informatique.equipe'
        ])) ||
    ($currentUserRole == 4 &&
        in_array($page, [
            'direction.dashboard',
            'direction.consultation',
            'direction.dossier_client',
            'direction.banque',
            'direction.equipe',
        ]))
)
                    <li class="nav-item">
                        <a class="nav-link text-white {{ $currentRoute === $page ? 'active bg-gradient-primary' : '' }}"
                            href="{{ route($page) }}">
                            <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">
                                    @switch($page)
                                        @case('admin_dashboard')
                                        @case('administratif.dashboard')

                                        @case('direction.dashboard')
                                        @case('commercial.dashboard')
                                        @case('informatique.dashboard')
                                        
                                            dashboard
                                        @break

                                        @case('administratif.Clients')
                                        @case('dossier_contacts')
                                        @case('direction.dossier_client')
                                        @case('commercial.contact')
                                            contacts
                                        @break

                                        @case('administratif.dossier_clients')
                                        @case('informatique.client')
                                        @case('dossier_clients')
                                        @case('consultante.dossier_client')
                                   
                                        @case('dossier')
                                        @case('document_agent')
                                            folder
                                        @break

                                        @case('administratif.consultation')
                                        @case('equipe_view')
                                        @case('direction.equipe')
                                        @case('informatique.equipe')
                                            groups
                                        @break

                                        @case('consultante.dashboard')
                                        @case('consultation')

                                        @case('direction.consultation')
                                            videocam
                                        @break

                                        @case('administratif.banque')
                                        @case('banque')

                                        @case('Direction.Banque')
                                            account_balance
                                        @break

                                        @case('commercial.rendez_vous')
                                            handshake
                                        @break

                                        @default
                                            {{ $page }}
                                    @endswitch

                                </i>
                            </div>
                            <span class="nav-link-text ms-1">{{ $pageTitle }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</aside>
