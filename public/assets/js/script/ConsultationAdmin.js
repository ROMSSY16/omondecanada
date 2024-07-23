
document.addEventListener("DOMContentLoaded", function() {
    // Sélectionnez le bouton "Voir tout"
    const allButton = document.querySelector('#all');

    // Sélectionnez toutes les lignes du tableau
    const rows = document.querySelectorAll('tbody tr');

    // Ajoutez un écouteur d'événements au bouton "Voir tout"
    allButton.addEventListener('click', function() {
        // Parcourez toutes les lignes et affichez-les
        rows.forEach(function(row) {
            row.style.display = '';
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    // Sélectionnez les boutons de filtre
    const todayButton = document.querySelector('#todayButton');
    const thisWeekButton = document.querySelector('#thisWeekButton');
    const thisMonthButton = document.querySelector('#thisMonthButton');

    // Sélectionnez toutes les lignes du tableau
    const rows = document.querySelectorAll('tbody tr');

    // Fonction pour filtrer les rendez-vous en fonction de la date
    function filterAppointments(dateFilter) {
        const currentDate = new Date();

        // Définir la date de début de la semaine actuelle
        const startOfWeek = new Date(currentDate);
        startOfWeek.setDate(currentDate.getDate() - currentDate.getDay());

        // Définir la date de fin de la semaine actuelle
        const endOfWeek = new Date(currentDate);
        endOfWeek.setDate(startOfWeek.getDate() + 6);

        rows.forEach(function(row) {
            const rowDate = new Date(row.getAttribute('data-date'));

            if (dateFilter === 'today' && rowDate.toDateString() === currentDate.toDateString()) {
                row.style.display = '';
            } else if (dateFilter === 'thisWeek' && rowDate >= startOfWeek && rowDate <=
                endOfWeek) {
                row.style.display = '';
            } else if (dateFilter === 'thisMonth' && rowDate.getMonth() === currentDate
                .getMonth()) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Ajoutez des écouteurs d'événements aux boutons de filtre
    todayButton.addEventListener('click', function() {
        filterAppointments('today');
    });

    thisWeekButton.addEventListener('click', function() {
        filterAppointments('thisWeek');
    });

    thisMonthButton.addEventListener('click', function() {
        filterAppointments('thisMonth');
    });
});

$(document).ready(function() {
    var table = $('#consultationTable').DataTable({
        "language": {
            "search": "",
            "lengthMenu": "",
            "zeroRecords": "",
            "info": "",
            "infoEmpty": "",
            "infoFiltered": "",
            "paginate": {
                "first": '<i class="material-icons">first_page</i>',
                "last": '<i class="material-icons">last_page</i>',
                "next": '<i class="material-icons">chevron_right</i>',
                "previous": '<i class="material-icons">chevron_left</i>'
            }
        },
        "dom": '<"top"i>rt<"bottom"lp><"clear">',
        "drawCallback": function() {
            // Ajouter les classes de Bootstrap pour centrer horizontalement
            $('.dataTables_paginate.paging_simple_numbers').addClass(
                'd-flex justify-content-center');
            $('.bottom').addClass('d-flex justify-content-center');
        }
    });

    // Utilisez votre barre de recherche personnalisée pour filtrer le tableau
    $('#searchInput').on('input', function() {
        table.search(this.value).draw();
    });


    $('input:checkbox[name="consultante"]').on('change', function() {
        var consultantes = $('input:checkbox[name="consultante"]:checked').map(function() {
            return this.value; // Match partial value
        }).get().join('|'); // Join all values with OR operator
        console.log(consultantes)
        table.column(4).search(consultantes, true, false, true)
            .draw(); // Apply filter to column 2 (Consultante)
    });


});