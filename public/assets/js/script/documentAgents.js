document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('searchInput').addEventListener('input', filterCards);
});
function filterCards() {
    var searchText = document.getElementById('searchInput').value.toLowerCase();
    var cards = document.querySelectorAll('.card');

    cards.forEach(function(card) {
        card.classList.remove('show');
        card.classList.add('hidden');
    });

    var displayedCards = 0;

    cards.forEach(function(card) {
        var usereName = card.querySelector('.text-xl').innerText.toLowerCase();

        if (usereName.includes(searchText) && displayedCards < 3) {
            card.classList.remove('hidden');
            card.classList.add('show');
            displayedCards++;
        }
    });
}


function ajouterFichiers(userId) {
    var form = $('#ajouterFichierForm' + userId)[0];
    var formData = new FormData(form);

    $.ajax({
        type: 'POST',
        url: '/ajouterFichiersAgent/' + userId,
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
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

        error: function(xhr, status, error) {
            console.error('Erreur AJAX: ' + status + ', ' + error);

            // Ajouter une gestion d'erreur supplémentaire si nécessaire
            alert('Erreur lors de la communication avec le serveur. Veuillez réessayer plus tard.');
        }
    });
}


    