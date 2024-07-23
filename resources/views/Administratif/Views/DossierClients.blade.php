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
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/logo-icon.png') }}">
    <title>
        Omonde Canada - CRM | DOSSIER CLIENTS
    </title>
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/bf8b55f4b1.js" crossorigin="anonymous"></script>
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>

<body class="g-sidenav-show  bg-gray-200">

    @include('partials.navbar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('partials.header', ['page' => 'CLIENTS'])
        <!-- End Navbar -->
        <div class="row">
            <div class="col-12">
                @include('Administratif.Partials.tableClient')
            </div>
        </div>

        <div id="loading" class="loading-overlay">
                        <div class="loading-spinner"></div>
                    </div>
        @include('partials.plugin')

        <script src="{{ asset('assets/js/script/dossierClient.js') }}"></script>
   
</body>
<script>
    $(document).ready(function () {
        $('#tagChangeForm').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission
    
            var candidatId = $(this).data('candidat-id'); // Assuming candidatId is stored as a data attribute on the form
            var tagId = $('#tagSelect').val(); // Get the selected tag's ID
    
            $.ajax({
                url: '/Administratif/UpdateTag/' + candidatId + '/' + tagId,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token for Laravel
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message); // Display success message
                        window.location.reload(); // Reload the page to reflect changes
                    } else {
                        alert(response.message); // Display error message if not successful
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error); // Alert the error if the AJAX call fails
                }
            });
        });
    });
    $(document).ready(function() {
    $('.procedureCandidat form').submit(function(e) {
        e.preventDefault(); // Empêcher le comportement par défaut du formulaire

        var form = $(this);
        var formData = form.serialize(); // Rassembler les données du formulaire

        console.log('Form data:', formData); // Log des données du formulaire pour le débogage

        $('#loading').addClass('show');

        // Envoyer une requête AJAX au serveur
        $.ajax({
            url: form.attr('action'), // URL définie dans l'attribut action du formulaire
            type: form.attr('method'), // Méthode définie dans l'attribut method du formulaire
            data: formData, // Données du formulaire sérialisées
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
            },
            success: function(response) {
                // La requête a réussi, afficher une alerte ou effectuer d'autres actions
                alert('Enregistrement effectué avec succès !');
                location.reload(); // Recharger la page après succès

                // Mettre à jour l'interface utilisateur si nécessaire
            },
            error: function(error) {
                // La requête a échoué, afficher une alerte ou effectuer d'autres actions
                console.error('Erreur lors de la soumission du formulaire: ', error, 'Si le problème persiste, contactez un agent IT');
            },
            complete: function() {
                $('#loading').removeClass('show');
            }
        });
    });
});


    </script>
    

  </script>
</html>
