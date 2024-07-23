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
  <link rel="icon" type="image/png" href= {{ asset('assets/img/logos/logo-icon.png') }}>  <title>
    Omonde Canada Crm | CONSULATATIONS
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
   <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-200">
  @include('partials.navbar')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    @include('partials.header' , ['page' => 'CONSULTATIONS'])
    <!-- End Navbar -->
    <div class="row">
      <div class="col-12">
          <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                  <div
                      class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                      <h6 class="text-white text-capitalize ps-3 mb-0">LISTE DES CONSULTATIONS</h6>
                      <button class="btn bg-gradient-dark circle" data-bs-toggle="modal"
                          data-bs-target="#addConsultationModal">
                          <i class="material-icons text-white" style="font-size: 2rem;">add</i>

                      </button>

                      @include('partials.Consultation.addConsultation')
                  </div>
              </div>

              <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0"  style="max-height: 750px;">
                    <table class="table align-items-center justify-content-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    LABEL
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    DATE
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    CONSULTANTE
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                    NOMBRE DE PARTICIPANTS
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (\App\Models\InfoConsultation::all() as $consultation)
                            <tr>
                                <td>
                                    <div class="d-flex px-2">
                                        <h6 class="p-2 text-sm">{{ $consultation->label }}</h6>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{ $consultation->date_heure}}</p>
                                </td>
                                <td>
                                
                                        <span class="text-xs font-weight-bold">{{ $consultation->consultante->nom }} {{ $consultation->consultante->prenoms }}</span>
                                   
                                </td>
                                
                                <td class="align-middle text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="me-2 text-xs font-weight-bold">{{ $consultation->nombre_candidats }}</span>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <a href="{{ $consultation->lien_zoom}}" target="blank" class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-video text-xs"></i>
                                    </a>
                                </td>
                                <td class="align-middle">
                                    <a href="{{ url('/waiting-list/'.$consultation->id) }}" class="btn bg-dark text-white">
                                        Liste d'attente
                                    </a>
                                </td>
                                <td>
                                    @if ($consultation->candidats->isNotEmpty())
                                        <a href="Consultation/{{ $consultation->id }}">
                                            <button class="btn bg-gradient-dark">
                                                Voir les candidat(s)
                                            </button>
                                        </a>
                                    @else
                                        <a href="#">

                                            <button class="btn bg-gradient-dark">
                                                Voir les candidat(s)
                                            </button>

                                        </a>
                                    @endif
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
          </div>
      </div>
  </div>
    
    </div>
  </main>
  @include('partials.plugin')
</body>

</html>