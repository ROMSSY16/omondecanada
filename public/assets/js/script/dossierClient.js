$(document).ready(function() {
    //Supprimer document
    $('.delete-document').on('click', function(e) {
        e.preventDefault();

        var url = $(this).data('url');
         
        if (confirm('Êtes-vous sûr de vouloir supprimer ce document ?')) {
            $('#loading').addClass('show');
            $.ajax({
                url: url,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // La requête a réussi, afficher une alerte
                    alert('Le document a été supprimé avec succès!');
                },
                error: function(error) {
                    // La requête a échoué, afficher une alerte ou effectuer d'autres actions
                    console.error('Erreur lors de la suppression du document:', error);
                },
                complete: function() {
                    // La soumission du formulaire est terminée - masquer la page de chargement
                    $('#loading').removeClass('show');
                }
            });
        }
    });
    //AJouter nouvelle ligne
    $('.nouvelleLigne').on('click', function() {
        // Récupère l'ID du candidat à partir des données de l'élément
        var candidatId = $(this).data('candidat-id');
        // Sélectionnez le formulaire
        var formulaire = document.getElementById("ajouterFichierForm" + candidatId);
    
        // Vérifiez si le formulaire existe
        if (formulaire) {
            // Sélectionnez les boutons dans le formulaire
            var premiereLigne = document.getElementsByClassName("doc")[0];

            // Créez une nouvelle ligne à insérer avant les boutons
            var nouvelleLigne = premiereLigne.cloneNode(true)
            
            var boutons = formulaire.getElementsByClassName("text-end")[0];
    
            // Insérez la nouvelle ligne avant les boutons
            formulaire.insertBefore(nouvelleLigne, boutons);
    
            // Effacez le formulaire ou effectuez d'autres actions nécessaires après l'ajout des fichiers
            formulaire.reset();
        } else {
            console.error("Error: Form with ID 'ajouterFichierForm" + candidatId + "' not found.");
        }
    });

    $('.procedureCandidat').submit(function(e) {
        e.preventDefault(); // Empêcher le comportement par défaut du formulaire
        $('#loading').addClass('show');
        var formData = $(this).serialize(); // Rassembler les données du formulaire

        // Envoyer une requête AJAX au serveur
        $.ajax({
            url: $(this).attr('action'), // URL définie dans l'attribut action du formulaire
            type: $(this).attr('method'), // Méthode définie dans l'attribut method du formulaire
            data: formData, // Données du formulaire sérialisées
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
            },
            success: function(response) {
                // La requête a réussi, afficher une alerte ou effectuer d'autres actions
                alert('Enregistrement effectué avec succes !');

                // Mettre à jour l'interface utilisateur si nécessaire
            },
            error: function(error) {
                // La requête a échoué, afficher une alerte ou effectuer d'autres actions
                console.error('Erreur lors de la soumission du formulaire: ', error , 'Si le probleme persiste , contacter un agent IT');
            },
            complete: function() {
                $('#loading').removeClass('show');
            }
        });
    });
});

//Fonction pour ajouter les ficher CHez consultante
function ajouterFichiersConsultante(candidatId) {
    var form = $('#ajouterFichierForm' + candidatId)[0];
    var formData = new FormData(form);
      // Afficher la page de chargement
      $('#loading').addClass('show');
    $.ajax({
        type: 'POST',
        url: '/Consultante/DossierClient/AjouterFichiersCandidat/' + candidatId,
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response && response.message) {
                alert(response.message);

                // Fermer le modal après un ajout réussi
                $('#ajouterFichierModal' + candidatId).modal('hide');

                // Actualiser la page pour afficher les changements
                location.reload();
            } else {
                console.error('Erreur lors de l\'ajout des fichiers: ' + (response ? response.message :
                    'Réponse non valide'));
            }
        },

        error: function (xhr, status, error) {
            console.error('Erreur AJAX: ' + status + ', ' + error);

            // Ajouter une gestion d'erreur supplémentaire si nécessaire
            alert('Erreur lors de la communication avec le serveur. Veuillez réessayer plus tard.');
        },
        complete: function() {
            // La soumission du formulaire est terminée - masquer la page de chargement
            $('#loading').removeClass('show');
        }
    });
}

//FOnction ajouter fichier pour les administratif
function ajouterFichiers(candidatId) {
    var form = $('#ajouterFichierForm' + candidatId)[0];
    var formData = new FormData(form);

    $('#loading').addClass('show');

    $.ajax({
        type: 'POST',
        url: '/ajouterFichiersCandidat/' + candidatId,
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response && response.message) {
                alert(response.message);

                // Fermer le modal après un ajout réussi
                $('#ajouterFichierModal' + candidatId).modal('hide');

                // Actualiser la page pour afficher les changements
                location.reload();
            } else {
                console.error('Erreur lors de l\'ajout des fichiers: ' + (response ? response.message :
                    'Réponse non valide'));
            }
        },

        error: function (xhr, status, error) {
            console.error('Erreur AJAX: ' + status + ', ' + error);

            // Ajouter une gestion d'erreur supplémentaire si nécessaire
            alert('Erreur lors de la communication avec le serveur. Veuillez réessayer plus tard.');
        },
        complete: function() {
            // La soumission du formulaire est terminée - masquer la page de chargement
            $('#loading').removeClass('show');
        }
    });
}
