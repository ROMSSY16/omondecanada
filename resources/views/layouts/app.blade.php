
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" type="image/png" href={{ asset('assets/img/logos/logo-icon.png') }}>
    <title>
        Omonde Canada - CRM
    </title>
    <!--     Fonts and icons     -->
         <!-- PWA  -->
    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <script src={{ asset('assets/js/script/dossierContact.js') }}></script>
    
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <style>
        /* Styles pour le formulaire d'ajout de prospect */
    
        .modal-content {
            border-radius: 20px;
        }
    
        .modal-header {
            border-bottom: none;
        }
    
        .modal-title {
            font-weight: bold;
            color: #333;
        }
    
        .modal-body {
            padding: 2rem;
        }
    
        .form-label {
            font-weight: bold;
        }
    
        .form-control {
            border-radius: 10px;
            color: #333; /* Changement de couleur du texte */
            background-color: #fff; /* Changement de couleur de fond */
            border: 1px solid #000; /* Bordure fine noire */
            padding: 12px; /* Padding dans le champ de texte */
        }
    
        .form-control:focus {
            border-color: #de3163; /* Changement de couleur de la bordure au focus */
        }
    
        .btn-primary {
            background-color: #de3163; /* Couleur rose */
            border: none;
            border-radius: 10px;
            transition: background-color 0.3s; /* Transition pour le changement de couleur au survol */
        }
    
        .btn-primary:hover {
            background-color: #111; /* Changement de couleur au survol */
        }
    
        .btn-primary:active {
            background-color: #1a2b3c; /* Changement de couleur au clic */
        }

        .card-header1 {
            height:5vw;
            background-color: #f5f5f5;
            border-bottom: 1px solid #e0e0e0;
            padding: 1.5rem 1rem;
            
            
        }

        .icon-shape {
            width: 60px;
            height: 60px;
            display: center;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: #4caf50; /* Couleur verte */
        }

        .icon-shape i {
            font-size: 30px;
            color: #fff; /* Couleur blanche */
        }

        .card-body {
            padding: 1.5rem 1rem;
        }

        .text-bold {
            font-weight: bold;
        }

        .progress {
            height: 10px;
            margin-top: 1rem;
            border-radius: 10px;
        }

        .progress-bar {
            border-radius: 10px;
        }
        .card {
            border-radius: 10px;
            border: none;
            background-color: #fff;
            box-shadow: 0px 4px 25px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            
        }

        .icon-shape {
            
            width: 60px;
            height: 60px;
            display: center;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: #4caf50; /* Couleur verte */
        }

        .icon-shape i {
            font-size: 30px;
            color: #fff; /* Couleur blanche */
        }

        .card-body {
            padding: 1.5rem 1rem;
        }

        .text-bold {
            font-weight: bold;
        }

        .progress {
            height: 10px;
            margin-top: 1rem;
            border-radius: 10px;
        }

        .progress-bar {
            border-radius: 10px;
        }
        .espace{
            height: 20vh;
        }
        
        .w-100 h6{
            color: #de3163;
        }
    </style>
</head>

<body class="g-sidenav-show  bg-gray-200">
    @include('partials.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('partials.header')
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            @yield('content')
            @include('partials.footer')
        </div>
        
    </main>
</body>
    
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/material-dashboard.min.js?v=3.0.0') }}"></script>
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
<script src="{{ asset('assets/js/script/homePage.js') }}"></script>
<script src="{{ asset('assets/js/script/DashboardCommercial.js') }}"></script>
<script src="{{ asset('assets/js/validate.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('/sw.js') }}"></script>
<script>
   if ("serviceWorker" in navigator) {
      // Register a service worker hosted at the root of the
      // site using the default scope.
      navigator.serviceWorker.register("/sw.js").then(
      (registration) => {
         console.log("Service worker registration succeeded:", registration);
      },
      (error) => {
         console.error(`Service worker registration failed: ${error}`);
      },
    );
  } else {
     console.error("Service workers are not supported.");
  }
</script>

<script>
    @if (session('success'))
        Swal.fire({
            title: "Succès",
            text: "{{ session('success') }}",
            icon: "success"
        });
    @endif
    @if (session('warning'))
    Swal.fire({
            title: "Désolé",
            html: "{{ session('warning') }}",
            icon: "warning"
        });
    @endif
    @if (session('error'))
        Swal.fire({
                title: "Erreur",
                text: "{{ session('error') }}",
                icon: "error"
        });
    @endif
    @if ($errors->any())
        Swal.fire({
                title: "Erreurs",
                text: "{{ $errors->first() }}",
                icon: "error"
        });
    @endif
</script>

</html>
