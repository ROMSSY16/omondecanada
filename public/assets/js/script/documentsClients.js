// function ajouterFichiers(candidatId) {
//     var form = $('#ajouterFichierForm' + candidatId)[0];
//     var formData = new FormData(form);

//     $.ajax({
//         type: 'POST',
//         url: '/ajouterFichiersCandidat/' + candidatId,
//         data: formData,
//         processData: false,
//         contentType: false,
//         success: function (response) {
//             console.log('Ajax Success Response:', response);  // Log the response

//             if (response && response.message) {
//                 alert(formData);
               
//                 // Fermer le modal après un ajout réussi
//                 $('#ajouterFichierModal' + candidatId).modal('hide');

//                 // Actualiser la page pour afficher les changements
//                 location.reload();
//             } else {
//                 console.error('Erreur lors de l\'ajout des fichiers: ' + (response ? response.message : 'Réponse non valide'));
//             }
//         },

//         error: function (xhr, status, error) {
//             console.error('Erreur AJAX: ' + status + ', ' + error);

//             // Ajouter une gestion d'erreur supplémentaire si nécessaire
//             alert('Erreur lors de la communication avec le serveur. Veuillez réessayer plus tard.');
//         }
//     });
// }

function filterCards() {
    var searchText = document.getElementById('searchInput').value.toLowerCase();
    var cards = document.querySelectorAll('.card');

    cards.forEach(function (card) {
        card.classList.remove('show');
        card.classList.add('hidden');
    });

    var displayedCards = 0;

    cards.forEach(function (card) {
        var candidateName = card.querySelector('.text-xl').innerText.toLowerCase();

        if (candidateName.includes(searchText) && displayedCards < 3) {
            card.classList.remove('hidden');
            card.classList.add('show');
            displayedCards++;
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    // Récupérer l'élément de champ de recherche
    document.getElementById('searchInput').addEventListener('input', filterCards);
});
