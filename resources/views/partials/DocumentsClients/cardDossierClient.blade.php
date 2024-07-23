@php
    $candidatsVersementEffectue = App\Models\Candidat::where('versement_effectuee', true)->get();
@endphp

<div class="row">
    @foreach ($candidatsVersementEffectue as $candidat)
        <div class="col-xl-4 col-sm-6 mb-xl-0 mt-4">
            <div class="card show">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-md icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">description</i>
                    </div>
                    <div class="text-end">
                        <p class="text-xl text-bold mb-0 text-capitalize">{{ $candidat->nom }} {{ $candidat->prenom }}
                        </p>
                        <h3 class="mb-0 pt-2"></h3>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    {{-- Afficher les icônes des fichiers dans le dossier du client --}}
                    @php
                        $dossierPath = storage_path('app/public/dossierClient/' . substr($candidat->nom, 0, 2) . substr($candidat->prenom, 0, 1) . $candidat->id);
                        $files = glob($dossierPath . '/*');
                    @endphp

                    @if (!empty($files))
                        <div class="row">
                            <div class="col-md-6">
                                <ul style="list-style-type: none;">
                                    @foreach ($files as $index => $file)
                                        @if ($index % 2 == 0)
                                            <li>
                                                <i class="material-icons">insert_drive_file</i>
                                                <a href="{{ asset('storage/' . str_replace(storage_path('app/public'), '', $file)) }}"
                                                    target="_blank">
                                                    {{ basename($file) }}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>

                            <div class="col-md-6">
                                <ul style="list-style-type: none;">
                                    @foreach ($files as $index => $file)
                                        @if ($index % 2 == 1)
                                            <li>
                                                <i class="material-icons">insert_drive_file</i>
                                                <a href="{{ asset('storage/' . str_replace(storage_path('app/public'), '', $file)) }}"
                                                    target="_blank">
                                                    {{ basename($file) }}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @else
                        <p>Aucun fichier trouvé.</p>
                    @endif


                    {{-- Bouton pour ajouter un nouveau fichier --}}
                    <div class="text-left d-flex align-items-center justify-content-around">
                        <p class="mb-0">Ici on doit avoir une barre pour l'évolution</p>

                        <a class="btn btn-success btn-sm" data-bs-toggle="modal"
                            data-bs-target="#ajouterFichierModal{{ $candidat->id }}">
                            <i class="material-icons opacity-10" style="font-size: 24px;">add</i>
                        </a>

                        @include('partials.DocumentsClients.ajoutFichierClient')
                    </div>
                </div>
            </div>
        </div>

        {{-- Ajoutez une nouvelle ligne après chaque troisième carte --}}
        @if ($loop->iteration % 3 == 0)
</div>
<div class="row">
    @endif
    @endforeach
</div>

<!-- Style pour la classe .show et .hidden -->
<style>
    .card.show {
        display: block;
    }

    .card.hidden {
        display: none;
    }
</style>

