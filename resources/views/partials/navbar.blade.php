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
                    'Consultante.Dashboard' => 'Dashboard',
                    'Consultante.DossierClient' => 'Dossier Client',

                    // Pages Commerciaux
                    'Commercial.Dashboard' => 'Dashboard',
                    'Commercial.Contact' => 'Contacts',
                    'Commercial.RendezVous' => 'Rendez-Vous',
                    'Administratif.Clients' => 'Clients',
                    'Administratif.Consultation' => 'Consultation',


                    // Pages Administratif
                    'Administratif.Dashboard' => 'Dashboard',
                    'Administratif.Clients' => 'Clients',
                    'Administratif.DossierClients' => 'Dossier Client',
                    'Administratif.Banque' => 'Banque',
                    'Administratif.Consultation' => 'Consultation',

                    //Pages Direction
                    'Direction.Dashboard' => 'Dashboard',
                    'Direction.DossierClient' => 'Dossier Client',
                    'Direction.Banque' => 'Banque',
                    'Direction.Consultation' => 'Consultation',
                    'Direction.Equipe' => 'L\'equipe',
                    

                    //Pages IT
                    'Informatique.Dashboard' => 'Dashboard',
                    'Informatique.Client' => 'Clients',
                    'Informatique.Equipe' => 'L\'equipe',


                    // Other Pages
                    'DossierContacts' => 'Contacts',
                    'DossierClients' => 'Dossier Clients',
                    'Banque' => 'Banque',
                    'dashBoardConsultante' => 'Consultante',
                    'Consultation' => 'Consultations',
                    'adminDashboard' => "Vue d'ensemble",
                    'dossier' => 'Document Clients',
                    'equipeView' => "L'equipe",
                    'documentAgent' => 'Document Agent',
                ];

                $currentRoute = \Request::route()->getName();
                $currentUserRole = auth()->user()->getRole() ;
      
     @endphp

    @foreach ($pages as $page => $pageTitle)
        @if (
            ($currentUserRole == 0 && in_array($page, ['Consultante.Dashboard' , 'Consultante.DossierClient'])) ||

            ($currentUserRole == 1 && in_array($page, array_merge(['Commercial.Dashboard', 'Commercial.Contact', 'Commercial.RendezVous',  'Administratif.Clients', 'Administratif.Consultation' ], in_array(auth()->user()->id_poste_occupe, [3,5]) ? ['Administratif.Banque'] : []))) ||
    ($currentUserRole == 2 &&
        in_array($page, [
            'Administratif.Dashboard',
            'Administratif.Clients',
            'Administratif.DossierClients',
            'Administratif.Banque',
            'Administratif.Consultation',
        ])) ||
    ($currentUserRole == 3 &&
        in_array($page, [
            'Informatique.Dashboard',
            'Informatique.Client',
            'Informatique.Equipe'
        ])) ||
    ($currentUserRole == 4 &&
        in_array($page, [
            'Direction.Dashboard',
            'Direction.Consultation',
            'Direction.DossierClient',
            'Direction.Banque',
            'Direction.Equipe',
        ]))
)
                    <li class="nav-item">
                        <a class="nav-link text-white {{ $currentRoute === $page ? 'active bg-gradient-primary' : '' }}"
                            href="{{ route($page) }}">
                            <div class="text-white text-left me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">
                                    @switch($page)
                                        @case('adminDashboard')
                                        @case('Administratif.Dashboard')

                                        @case('Direction.Dashboard')
                                        @case('Commercial.Dashboard')
                                        @case('Informatique.Dashboard')
                                        
                                            dashboard
                                        @break

                                        @case('Administratif.Clients')
                                        @case('DossierContacts')
                                        @case('Direction.DossierClient')
                                        @case('Commercial.Contact')
                                            contacts
                                        @break

                                        @case('Administratif.DossierClients')
                                        @case('Informatique.Client')
                                        @case('DossierClients')
                                        @case('Consultante.DossierClient')
                                   
                                        @case('dossier')
                                        @case('documentAgent')
                                            folder
                                        @break

                                        @case('Administratif.Consultation')
                                        @case('equipeView')
                                        @case('Direction.Equipe')
                                        @case('Informatique.Equipe')
                                            groups
                                        @break

                                        @case('Consultante.Dashboard')
                                        @case('Consultation')

                                        @case('Direction.Consultation')
                                            videocam
                                        @break

                                        @case('Administratif.Banque')
                                        @case('Banque')

                                        @case('Direction.Banque')
                                            account_balance
                                        @break

                                        @case('Commercial.RendezVous')
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
