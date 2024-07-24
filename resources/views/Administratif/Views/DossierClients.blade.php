@extends('layouts.app')
@section('content')
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
@endsection
    

