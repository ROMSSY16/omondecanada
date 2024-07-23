<div class="card my-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3">
        <div class="bg-gradient-dark border-radius-lg pt-4 pb-2 d-flex align-items-center justify-content-between p-4">
            <div class="p-2 border-radius-lg w-40 bg-white">
                <input type="text" id="searchInput" class="form-control text-dark text-lg bg-transparent border-0 p-1"
                    placeholder="Rechercher...">
            </div>

            <div class="p-2 d-flex align-items-center w-40 justify-content-around flex-direction-row">
                <div class="dropdown">
                    <button class="btn btn-secondary" type="button" id="dropdownTypeVisa" data-toggle="dropdown">
                        Type de visa
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownTypeVisa">
                        @foreach (\App\Models\TypeProcedure::all() as $typeVisa)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $typeVisa->label }}"
                                    id="typeVisa{{ $typeVisa->id }}" name="type_visa" checked>
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
                                <input class="form-check-input" type="checkbox"
                                    value="{{ $consultante->nom }} {{ $consultante->prenoms }}"
                                    id="consultante{{ $consultante->id }}" name="consultante" checked>
                                <label class="form-check-label" for="consultante{{ $consultante->id }}">
                                    {{ $consultante->nom }} {{ $consultante->prenoms }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="dropdown">
                    <button class="btn btn-secondary" type="button" id="dropdownSuccursales" data-toggle="dropdown">
                        Pays
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownSuccursales">
                        @foreach (\App\Models\Succursale::all() as $succursale)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $succursale->label }}"
                                    id="typePaiement{{ $succursale->id }}" name="pays" checked>
                                <label class="form-check-label" for="typePaiement{{ $succursale->id }}">
                                    {{ $succursale->label }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="card-body px-0 pb-2">
        <div class="table-responsive p-0" style="max-height: 700px; overflow-y: auto;">
            <table class="table align-items-center justify-content-center mb-0 dataTable">
                <thead>
                    <tr>
                        <th
                            class=" col-md-2 text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                            NOM
                        </th>
                        <th
                            class=" col-md-2 text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                            TYPE VISA
                        </th>

                        <th
                            class=" col-md-2 text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                            CONSULTANTE
                        </th>
                        <th
                            class="col-md-3 text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                            AGENT / SUCCURSALE
                        </th>
                        <th
                            class="col-md-3 text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                            MONTANT VERSÉ
                        </th>

                        <th
                            class=" col-md-2 text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                            VOIR DOSSIER
                        </th>
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
                                <span class="text-md consultante-name">
                                    @if ($candidat->proceduresDemandees)
                                        {{ $candidat->proceduresDemandees->consultante->nom ?? 'null' }}
                                        {{ $candidat->proceduresDemandees->consultante->prenoms ?? 'null' }}
                                    @else
                                        N / A
                                    @endif
                                </span>
                            </td>

                            <td>
                                <div class="d-flex justify-content-center  px-2">
                                    <span class="p-2 text-md text-center">{{ $candidat->utilisateur->name }}
                                        {{ $candidat->utilisateur->last_name }} /
                                        {{ $candidat->utilisateur->succursale->label }} </span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center  px-2">
                                    {{-- <span class="p-2 text-md text-center">{{ $candidat->utilisateur->name }} {{ $candidat->utilisateur->last_name }} / {{ $candidat->utilisateur->succursale->label }} </span> --}}

                                    <span class="p-2 text-md text-center">

                                        {{ isset($candidat->entrees) ? number_format($candidat->entrees->sum('montant'), 0, ',', ' ') . ' FCFA ' : 'Aucun versement' }}

                                    </span>
                                </div>
                            </td>

                            <td class="align-middle text-center">
                                <button class="btn btn-dark" data-bs-toggle="modal"
                                    data-bs-target="#voirDossierModal{{ $candidat->id }}">
                                    Voir Le Dossier
                                </button>

                                @include('Administratif.Partials.VoirDocuments')
                            </td>
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

        $('input:checkbox[name="consultante"]').on('change', function() {
            var consultantes = $('input:checkbox[name="consultante"]:checked').map(function() {
                return this.value; // Match partial value
            }).get().join('|'); // Join all values with OR operator
            console.log(consultantes)
            table.column(2).search(consultantes, true, false, true)
        .draw(); // Apply filter to column 2 (Consultante)
        });

        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var pays = $('input:checkbox[name="pays"]:checked').map(function() {
                    return this.value;
                }).get();

                var succursale = data[3]; // Utilisez l'index de la colonne de la succursale

                return pays.some(function(value) {
                    return succursale.includes(value);
                });
            }
        );

        $('input:checkbox[name="pays"]').on('change', function() {
            table.draw();
        });
    });
</script>
<style>

</style>
