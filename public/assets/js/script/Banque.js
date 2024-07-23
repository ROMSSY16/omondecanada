$(document).ready(function () {

    // Capturer l'événement de soumission du formulaire
    $('#ajouterDepenseModal form').submit(function (e) {
        e.preventDefault(); // Empêcher le comportement par défaut du formulaire
        $('#loading').addClass('show');
        var formData = $(this).serialize(); // Rassembler les données du formulaire

        // Envoyer une requête AJAX au serveur
        $.ajax({
            url: $(this).attr('action'), // URL définie dans l'attribut action du formulaire
            type: $(this).attr('method'), // Méthode définie dans l'attribut method du formulaire
            data: formData, // Données du formulaire sérialisées
            success: function (response) {
                // La requête a réussi, afficher une alerte ou effectuer d'autres actions
                alert('Dépense ajoutée avec succès!');

                // Réinitialiser le formulaire si nécessaire
                $('#ajouterDepenseModal form')[0].reset();

                // Fermer le modal
                $('#ajouterDepenseModal').modal('hide');
            },
            error: function (error) {
                // La requête a échoué, afficher une alerte ou effectuer d'autres actions
                console.error('Erreur lors de l\'ajout de la dépense:', error);
            },
            complete: function () {
                $('#loading').removeClass('show');
            }
        });
    });

    $('#ajouterEntreeModal form').submit(function(e) {
        e.preventDefault(); // Empêcher le comportement par défaut du formulaire
        $('#loading').addClass('show');

        var formData = $(this).serialize(); // Rassembler les données du formulaire

        // Envoyer une requête AJAX au serveur
        $.ajax({
            url: $(this).attr('action'), // URL définie dans l'attribut action du formulaire
            type: $(this).attr('method'), // Méthode définie dans l'attribut method du formulaire
            data: formData, // Données du formulaire sérialisées
            success: function(response) {
                // La requête a réussi, afficher une alerte ou effectuer d'autres actions
                alert('Paiement ajouté avec succès!');

                // Réinitialiser le formulaire si nécessaire
                $('#ajouterEntreeModal form')[0].reset();

               location.reload()
            },
            error: function(error) {
                // La requête a échoué, afficher une alerte ou effectuer d'autres actions
                console.error('Erreur lors de l\'ajout du paiement:', error);
            },
            complete: function() {
                $('#loading').removeClass('show');
            }
        });
    });

});
