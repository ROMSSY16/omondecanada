document.addEventListener('DOMContentLoaded', function() {
    // Récupérez la référence de l'élément de saisie
    var searchInput = document.getElementById('searchInput');

    // Récupérez toutes les lignes du tableau
    var rows = document.querySelectorAll('table tbody tr');

    // Ajoutez un gestionnaire d'événement pour la saisie
    searchInput.addEventListener('input', function() {
        var searchText = searchInput.value.toLowerCase();

        // Parcours de chaque ligne du tableau
        rows.forEach(function(row) {
            // Récupérez le texte de chaque cellule dans la ligne
            var rowData = row.textContent.toLowerCase();

            // Affiche ou masque la ligne en fonction de la correspondance de la recherche
            if (rowData.includes(searchText)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});