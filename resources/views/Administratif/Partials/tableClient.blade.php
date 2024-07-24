<div class="card my-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3">
        <div class="bg-gradient-dark shadow-primary border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
            <div class="p-2 border-radius-lg w-40 bg-white">
                <input type="text" id="searchInput" class="form-control text-lg bg-transparent border-0 p-1" placeholder="Rechercher...">
            </div>

            <div class="p-2 d-flex align-items-center w-30 justify-content-around flex-direction-row">
                <div class="dropdown">
                    <button class="btn btn-secondary" type="button" id="dropdownTypeVisa" data-toggle="dropdown">
                        Type de visa
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownTypeVisa">
                        @foreach (\App\Models\TypeProcedure::all() as $typeVisa)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $typeVisa->label }}" id="typeVisa{{ $typeVisa->id }}" name="type_visa" checked>
                                <label class="form-check-label" for="typeVisa{{ $typeVisa->id }}">
                                    {{ $typeVisa->label }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="dropdown">
                    <button class="btn btn-secondary" type="button" id="dropdownConsultante" data-toggle="dropdown">
                        Consultante
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownConsultante">
                        @foreach (\App\Models\consultante::all() as $consultante)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $consultante->nom }} {{ $consultante->prenoms }}" id="consultante{{ $consultante->id }}" name="consultante" checked>
                                <label class="form-check-label" for="consultante{{ $consultante->id }}">
                                    {{ $consultante->nom }} {{ $consultante->prenoms }}
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="consultante{{ $consultante->id }}" name="consultante" checked>
                                <label class="form-check-label" for="consultante{{ $consultante->id }}">
                                    N / A
                                </label>
                            </div>
                        @endforeach
                        
                    </div>
                </div>

                <div class="dropdown">
                    <button class="btn btn-secondary" type="button" id="dropdownStatut" data-toggle="dropdown">
                        Statut
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownStatut">
                        @foreach (\App\Models\StatutProcedure::all() as $statut)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $statut->label }}" id="statut{{ $statut->id }}" name="statut" checked>
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
    <div class="card-body px-0 pb-2">
        <div class="table-responsive p-0" style="min-height: 700px; max-height: 700px; overflow-y: auto;">
            <table class="table align-items-center justify-content-center mb-0 dataTable">
                <thead>
                    <tr>
                        <th class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NOM</th>
                        <th class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">TYPE VISA</th>
                        <th class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">STATUT</th>
                        <th class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">CONSULTANTE</th>
                        <th class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">ACTIONS</th>
                        <th class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">IMPRIMER</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_client->sortByDesc('date') as $candidat)
                        <tr>

                            <td>
                                <div class="d-flex px-2">
                                    <h6 class="p-2 text-md">{{ $candidat->nom }} {{ $candidat->prenom }}</h6>
                                </div>
                            </td>
                            <td class="align-middle text-center">
                                <span class="text-md ">
                                    @if ($candidat->proceduresDemandees)
                                        {{ $candidat->proceduresDemandees->typeProcedure->label }}
                                    @else
                                        N / A
                                    @endif
                                </span>
                            </td>
                            <td class="align-middle text-center">
                                <span class="text-md ">
                                    @if ($candidat->proceduresDemandees)
                                        {{ $candidat->proceduresDemandees->statut->label ?? 'null' }}
                                    @else
                                        N / A
                                    @endif
                                </span>
                            </td>
                            <td class="align-middle text-center">
                                <span class="text-md ">
                                    @if ($candidat->proceduresDemandees)
                                        {{ $candidat->proceduresDemandees->consultante->nom ?? 'N /' }}
                                        {{ $candidat->proceduresDemandees->consultante->prenoms ?? 'A' }}
                                    @else
                                        N / A
                                    @endif
                                </span>
                            </td>

                            <td class="align-middle text-center">
                                <div class="dropdown">
                                    <button class="btn btn-dark" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                        <i class="material-icons">more_vert</i>
                                    </button>
                                    <div class="dropdown-menu d-flex flex-direction-column flex-wrap" aria-labelledby="dropdownMenuButton">
                                        <a class="btn btn-danger col-12 m-1" data-bs-toggle="modal" data-bs-target="#AjouterVisaModal{{ $candidat->id }}">
                                            Ajouter le Type de Visa
                                        </a>
                                        <a class="btn btn-danger col-12 m-1" data-bs-toggle="modal" data-bs-target="#ajouterFichierModal{{ $candidat->id }}">
                                            Ajouter des documents
                                        </a>
                                        <a class="btn btn-danger col-12 m-1" data-bs-toggle="modal" data-bs-target="#changeTagModal{{ $candidat->id }}">
                                            Ajouter / Changer un tag
                                        </a>
                                        <a class="btn btn-danger col-12 m-1" data-bs-toggle="modal" data-bs-target="#addFicheRens{{ $candidat->id }}">
                                            Fiche de renseignement
                                        </a>
                                        <a class="btn btn-danger col-12 m-1" data-bs-toggle="modal"  data-bs-target="#voirDossierModal{{ $candidat->id }}">
                                            Voir dossier
                                        </a>

                                        @include('Administratif.Partials.VoirDocuments')
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle text-center">
                                <div class="dropdown">
                                    <button class="btn btn-dark" type="button" id="dropdownPrintButton" data-bs-toggle="dropdown">
                                        <i class="material-icons">print</i>
                                    </button>
                                    <div class="dropdown-menu d-flex flex-direction-column flex-wrap" aria-labelledby="dropdownPrintButton">
                                        <a class="btn btn-secondary col-12 m-1" href="{{ route('print.devis', $candidat->id) }}">
                                            Devis
                                        </a>
                                        <a class="btn btn-secondary col-12 m-1" href="{{ route('print.serviceContract', $candidat->id) }}">
                                            Contrat de service
                                        </a>
                                        <a class="btn btn-secondary col-12 m-1" href="{{ route('print.professionalServiceContract', $candidat->id) }}">
                                            Contrat de service professionnel
                                        </a>

                                    </div>
                                </div>
                            </td>
                            @include('Administratif.Partials.AddVisa', ['candidat' => $candidat])
                            @include('Administratif.Partials.ajoutFichierClient')
                            @include('Administratif.Partials.AddTag', ['candidat' => $candidat])
                            @include('Administratif.Partials.AddFicheRens', ['candidat' => $candidat])
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        var table = $('.dataTable').DataTable({
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


        $('#searchInput').on('keyup', function() {
            table.search(this.value).draw();
        });
        // Filtre pour le type de visa
        $('input:checkbox[name="type_visa"]').on('change', function() {
            var types = $('input:checkbox[name="type_visa"]:checked').map(function() {
                return this.value; // Match partial value
            }).get().join('|'); // Join all values with OR operator
            console.log(types)
            table.column(2).search(types, true, false)
        .draw(); // Apply filter to column 1 (Type de visa)
        });

        $('input:checkbox[name="consultante"]').on('change', function() {
            console.log('Checkbox changed'); // Ajoutez cette ligne

            var consultante = $('input:checkbox[name="consultante"]:checked').map(function() {
                return this.value;
            }).get().join('|');

            console.log(consultante);
            table.column(4).search(consultante, true, false).draw();
        });

        $('input[name="statut"]').on('click', function() {
            // Récupérez tous les statuts cochés
            var statuts = [];
            $('input[name="statut"]:checked').each(function() {
                statuts.push(this.value);
            });

            // Joignez les statuts avec un pipe (|), qui est utilisé comme un opérateur OR dans la méthode `search` de DataTables
            var regex = statuts.join('|');

            // Filtrez votre table basée sur les statuts cochés
            // Ici, j'assume que le statut est dans la 3ème colonne de votre table (index 2)
            table.column(3).search(regex, true, false).draw();
        });



    });
</script>
