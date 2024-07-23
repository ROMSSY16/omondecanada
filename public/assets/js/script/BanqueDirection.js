$(document).ready(function() {
        // Configuration de DataTables avec la barre de recherche personnalisée
        const tableWithSearch = $('.dataTable').DataTable({
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
            tableWithSearch.search(this.value).draw();
        });
        $('input:checkbox').on('change', function() {
    // Build a regex filter string with an or(|) condition
    var typesPaiement = $('input:checkbox[name="type_paiement"]:checked').map(function() {
        return '^' + this.value + '$';
    }).get().join('|');
    var pays = $('input:checkbox[name="pays"]:checked').map(function() {
        return '.*' + this.value + '$';
    }).get().join('|');
    // Filter in column 1 (index 0), with a regex, no smart filtering, case insensitive
    tableWithSearch.column(1).search(typesPaiement, true, false, true).draw(false);
    // Filter in column 2 (index 1), with a regex, no smart filtering, case insensitive
    tableWithSearch.column(2).search(pays, true, false, true).draw(false);
});   });
