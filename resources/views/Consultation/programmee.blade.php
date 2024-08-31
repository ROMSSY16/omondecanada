@extends('layouts.app')
@section('content')
<div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3">

                        <div
                            class="bg-gradient-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                            <div class="p-2 border-radius-lg w-40 bg-white">
                                <input type="text " id="searchInput"
                                    class="form-control text-dark  text-lg bg-transparent border-0 p-1"
                                    placeholder="Recherche...">

                            </div>

                            <div class="d-flex align-items-center justify-content-around col-4">
                                <div
                                    class="p-2 d-flex align-items-center w-30 justify-content-around flex-direction-row">
                                    <div class="dropdown">
                                        <div class="btn btn-secondary" type="button" id="dropdownTypeVisa"
                                            data-toggle="dropdown">
                                            Type de visa
                                        </div>
                                        <div class="dropdown-menu" aria-labelledby="dropdownTypeVisa">
                                            @foreach (\App\Models\TypeProcedure::all() as $typeVisa)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $typeVisa->label }}" id="typeVisa{{ $typeVisa->id }}"
                                                        name="type_visa" checked>
                                                    <label class="form-check-label" for="typeVisa{{ $typeVisa->id }}">
                                                        {{ $typeVisa->label }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                                <div
                                    class="p-2 d-flex align-items-center w-30 justify-content-around flex-direction-row">

                                    <div class="dropdown">

                                        <div class="btn btn-secondary" type="button" id="dropdownStatut"
                                            data-toggle="dropdown">

                                            Statut

                                        </div>

                                        <div class="dropdown-menu" aria-labelledby="dropdownStatut">

                                            @foreach (\App\Models\StatutProcedure::all() as $statut)
                                                <div class="form-check">

                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $statut->label }}" id="statut{{ $statut->id }}"
                                                        name="statut" checked>

                                                    <label class="form-check-label" for="statut{{ $statut->id }}">

                                                        {{ $statut->label }}

                                                    </label>

                                                </div>
                                            @endforeach

                                        </div>

                                    </div>

                                </div>


                            </div>



                        </div>
                        <div class="table-responsive p-0"
                            style="min-height: 700px; max-height: 700px; overflow-y: auto;">
                            <table class="table align-left text-center mb-0" id="candidatsTable">
                                <thead>
                                    <tr>
                                        <th
                                            class="col-md-2 text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                            NOM & PRENOM(S)
                                        </th>
                                        <th
                                            class="col-md-2 text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                            TYPE DE VISA
                                        </th>
                                        <th
                                            class="col-md-3 text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                            STATUT
                                        </th>
                                        <th
                                            class="col-md-3 text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                            VOIR DOCUMENTS
                                        </th>

                                        <th
                                            class="col-md-3 text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                            ACTIONS
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($candidats as $candidat)
                                        <tr>
                                            <td class="align-middle text-start">
                                                <h6 class="p-2 text-md">{{ $candidat->nom }} {{ $candidat->prenom }}
                                                </h6>
                                            </td>

                                            <td class="align-middle p-2">
                                                <span class="text-md">
                                                    @if ($candidat->proceduresDemandees)
                                                        {{ $candidat->proceduresDemandees->typeProcedure->label }}
                                                    @else
                                                        N / A
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-md">
                                                    @if ($candidat->proceduresDemandees)
                                                        {{ $candidat->proceduresDemandees->statut->label ?? 'null' }}
                                                    @else
                                                        N / A
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <button class="btn bg-dark text-white" data-bs-toggle="modal"
                                                    data-bs-target="#voirDossierModal{{ $candidat->id }}">
                                                    Voir Le Dossier
                                                </button>
                                                <!-- Modal pour afficher les détails du dossier -->
                                                <div class="modal fade z-index-2" id="voirDossierModal{{ $candidat->id }}" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Documents de {{ $candidat->nom }} {{ $candidat->prenom }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @if ($candidat->dossier && $candidat->dossier->documents->isNotEmpty())
                                                                    {{-- Le dossier a des documents --}}
                                                                    <div class="list-group">
                                                                        @foreach ($candidat->dossier->documents as $document)
                                                                        <div class="d-flex justify-content-between align-items-center row">
                                                                            <div class="d-flex align-items-center col-11 mb-1">
                                                                                <a href="{{ asset('storage/'. $document->url) }}" target="_blank" class="list-group-item list-group-item-action d-flex justify-content-between rounded align-items-center">
                                                                                    <span>
                                                                                        {{ $document->nom }}
                                                                                    </span>
                                                                                    <span class="badge bg-secondary rounded-pill">Document</span>
                                                                    
                                                                                </a>
                                                                                
                                                                            </div>
                                                                        <div class="d-flex align-items-center col-1">
                                                                                <!-- Icône de suppression -->
                                                                                <a href="#" data-url="{{'#'}}" class="text-danger ml-2 delete-document">
                                                                                    <i class="material-icons">delete</i>
                                                                                </a>
                                                                        </div>
                                                                        </div>
                                                                        
                                                                        @endforeach
                                                                    </div>
                                                                @else
                                                                    {{-- Le dossier est null ou n'a pas de documents --}}
                                                                    <p class="text-muted">Aucun fichier trouvé.</p>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="align-middle text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-primary" type="button"
                                                        id="dropdownMenuButton" data-bs-toggle="dropdown">
                                                        <i class="material-icons">more_vert</i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                        <a class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#AjouterVisaModal{{ $candidat->id }}">
                                                            Changer le statut
                                                        </a>

                                                        <a class="dropdown-item"data-bs-toggle="modal"
                                                            data-bs-target="#ajouterFichierModal{{ $candidat->id }}">
                                                            Ajouter des documents
                                                        </a>

                                                        <a class="dropdown-item" href="{{ route('consultation.fiche_renseignement', $candidat->id) }}">
                                                            Fiche de renseignement
                                                        </a>


                                                    </div>
                                                </div>
                                                <div class="modal fade z-index-2 procedureCandidat" id="AjouterVisaModal{{ $candidat->id }}" tabindex="-1" role="dialog" aria-labelledby="ajouterEntreeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="ajouterEntreeModalLabel">Ajouter le Type de Procedure</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form id="procedureForm{{ $candidat->id }}" action="" method="POST">
                                                                    @csrf
                                                                    <!-- Champs Candidat -->
                                                                    <input type="hidden" name="candidat_id" value="{{ $candidat->id }}">

                                                                    <!-- Autres champs -->
                                                                    <!-- Champs Statut -->
                                                                    <div class="mb-3">
                                                                        <label for="statut">Statut</label>
                                                                        <select class="form-select ps-2" name="statut_id" id="statut" required>
                                                                            @foreach (App\Models\StatutProcedure::all() as $statut)
                                                                                <option value="{{ $statut->id }}">{{ $statut->label }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <!-- Champs Type de Procédure et Consultante seulement si l'utilisateur n'est pas une consultante -->
                                                                    @if (Auth::user()->id_role_utilisateur != 0)
                                                                        <div class="mb-3">
                                                                            <label for="type_procedure">Type de Procédure</label>
                                                                            <select class="form-select ps-2" name="type_procedure" id="type_procedure" required>
                                                                                @foreach (App\Models\TypeProcedure::all() as $procedure)
                                                                                    <option value="{{ $procedure->id }}">{{ $procedure->label }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="consultante_id">Consultante</label>
                                                                            <select class="form-select ps-2" name="consultante_id" id="consultante_id">
                                                                                <option value="" selected>Non défini</option>
                                                                                @foreach (App\Models\Consultante::all() as $consultante)
                                                                                    <option value="{{ $consultante->id }}">{{ $consultante->nom }} {{ $consultante->prenoms }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    @endif

                                                                    <!-- Bouton Enregistrer -->
                                                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal -->
                                                <div class="modal z-index-2 fade" id="ajouterFichierModal{{ $candidat->id }}" aria-labelledby="ajouterFichierModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="ajouterFichierModalLabel">Ajouter des fichiers au
                                                                    dossier de {{ $candidat->nom }} {{ $candidat->prenom }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form id="ajouterFichierForm{{ $candidat->id }}" method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="mb-3 d-flex align-items-center">
                                                                        
                                                                        <!-- Ajoutez le champ de fichier -->
                                                                        <div class="input-group me-3">
                                                                            <input type="file" class="form-control border rounded-3 p-2"
                                                                                id="fichiers{{ $candidat->id }}" name="fichiers[]" multiple style="height: 3rem;">
                                                                            <label class="input-group-text" for="fichiers{{ $candidat->id }}">Parcourir</label>
                                                                        </div>

                                                                        <!-- Bouton pour ajouter une nouvelle ligne -->
                                                                        <button type="button" class="btn btn-primary"
                                                                            onclick="ajouterNouvelleLigne({{ $candidat->id }})">+</button>
                                                                    </div>

                                                                    <div class="text-end d-flex justify-content-around">
                                                                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Annuler</button>
                                                                        <button type="button" class="btn btn-success w-30"
                                                                            onclick="ajouterFichiersConsultante({{ $candidat->id }})">Ajouter</button>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
        <script>
            $(document).ready(function() {
                var table = $('#candidatsTable').DataTable({
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

                // Filtre pour le type de visa
                $('input:checkbox[name="type_visa"]').on('change', function() {
                    var types = $('input:checkbox[name="type_visa"]:checked').map(function() {
                        return this.value; // Match partial value
                    }).get().join('|'); // Join all values with OR operator
                    console.log(types)
                    table.column(1).search(types, true, false)
                        .draw(); // Apply filter to column 1 (Type de visa)
                });


                $('input:checkbox[name="statut"]').on('change', function() {
                    var statuts = $('input:checkbox[name="statut"]:checked').map(function() {
                        return this.value; // Match partial value
                    }).get().join('|'); // Join all values with OR operator

                    console.log(statuts)
                    table.column(2).search(statuts, true, false).draw(); // Apply filter to column 2 (Statut)
                });

            });
       
            $(document).ready(function() {
                $('.delete-document').on('click', function(e) {
                    e.preventDefault();

                    var url = $(this).data('url');

                    if (confirm('Êtes-vous sûr de vouloir supprimer ce document ?')) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                // La requête a réussi, afficher une alerte
                                alert('Le document a été supprimé avec succès!');

                                // Recharger la page
                                window.location.reload();
                            },
                            error: function(error) {
                                // La requête a échoué, afficher une alerte ou effectuer d'autres actions
                                console.error('Erreur lors de la suppression du document:', error);
                            }
                        });
                    }
                });
            });

            function ajouterFichiersConsultante(candidatId) {
        var form = $('#ajouterFichierForm' + candidatId)[0];
        var formData = new FormData(form);

        // Log the form data to the console
        console.log("Form Data:", formData);

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
            }
        });
    }
        </script>
@endsection