<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/logo-icon.png') }}">

    <title>Candidat - Omonde Canada - CRM</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
    <!-- Ajoutez ces liens CDN à la section head de votre fichier Blade -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</head>

<body class="g-sidenav-show bg-gray-200">
    @include('partials.navbar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        @include('partials.header', ['page' => 'Consultante'])
        <!-- End Navbar -->

        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3">
                        <div class="bg-gradient-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                            <h3 class="text-white text-capitalize p-2">Fiche de renseignement de {{ $candidat->nom  }} {{ $candidat->prenom  }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="accordionExample">
                            @foreach ($categories as $category)
                                <div class="accordion-item">
                                    <h1 class="accordion-button collapsed text-lg" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $category->id }}" aria-expanded="false" aria-controls="collapse{{ $category->id }}">
                                        {{ $category->name }}
                                    </h1>     
                                    <div id="collapse{{ $category->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $category->id }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            @php $count = 0; @endphp
                                            @foreach ($category->questions as $question)
                                                @if ($count % 3 === 0)
                                                    <div class="row">
                                                @endif
                                                <div class="col-md-4">
                                                    <div class="response-item mb-3 p-3">
                                                        <strong class="question d-block mb-2">{{ $question->question }}</strong>
                                                        <span class="answer d-block">
                                                            {{ $responses[$category->id][$question->id] ?? '' }}
                                                        </span>
                                                    </div>
                                                </div>
                                                @php $count++; @endphp
                                                @if ($count % 3 === 0 || $loop->last)
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Ajouter un rectangle supplémentaire pour les remarques -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="response-item mb-3 p-3">
                                    <strong class="question d-block mb-2">Remarques</strong>
                                    <span class="answer d-block">
                                        {{ $consultationRecord->remarque_agent ?? '' }}
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Bouton pour afficher le CV -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('assets/js/material-dashboard.min.js?v=3.0.0') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
</body>

</html>
