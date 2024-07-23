function ajouterFichiers(userId) {
    var form = $('#ajouterFichierForm' + userId)[0];
    var formData = new FormData(form);

    $.ajax({
        type: 'POST',
        url: '/ajouterFichiersAgent/' + userId,
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response && response.message) {
                alert(response.message);

                // Fermer le modal après un ajout réussi
                $('#ajouterFichierModal' + userId).modal('hide');

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
        }
    });
}
function submitConsultationForm(consultationId) {
    var formId = '#consultationForm' + consultationId;

    $(formId).on('submit', function (e) {
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
            success: function (response) {
                // La requête a réussi, afficher une alerte ou effectuer d'autres actions
                alert('Enregistrement effectué avec succès !');
                // Par exemple, vous pouvez rediriger l'utilisateur vers une autre page
                location.reload();
            },
            error: function (error) {
                // La requête a échoué, afficher une alerte ou effectuer d'autres actions
                console.error('Erreur lors de la soumission du formulaire: ', error);
            },
            complete: function () {
                $('#loading').removeClass('show');
            }
        });
    });
}





$(document).ready(function () {
    $('.delete-consultation').on('click', function (e) {
        e.preventDefault();
        var consultationId = $(this).data('id');
        var formId = '#deleteForm' + consultationId;

        if (confirm('Êtes-vous sûr de vouloir supprimer cette consultation ?')) {

            $('#loading').addClass('show'); // Ajoutez la classe 'show' pour afficher le chargement

            $.ajax({
                url: $(formId).attr('action'),
                type: 'DELETE',
                data: $(formId).serialize(),
                success: function (response) {
                    // Affichez le message de succès retourné dans la réponse JSON
                    alert(response.message);
                    location.reload();
                },
                error: function (error) {
                    console.error('Erreur lors de la suppression de la consultation : ', error);
                },
                complete: function () {
                    $('#loading').removeClass('show'); // Retirez la classe 'show' pour masquer le chargement une fois la requête terminée
                }
            });
        }
    });



});

function filterConsultations(filter) {
    const rows = document.querySelectorAll('table tbody tr');
    const today = new Date().toISOString().split('T')[0]; // Format YYYY-MM-DD

    rows.forEach(row => {
        const date = row.getAttribute('data-date');
        if (filter === 'upcoming' && date >= today) {
            row.style.display = '';
        } else if (filter === 'past' && date < today) {
            row.style.display = '';
        } else if (filter === 'all') {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}