@php
$users = \App\Models\User::whereNotIn('id_role_utilisateur', [0, 3])->get();

@endphp

<div class="row">
    @foreach ($users as $user)
        <div class="col-xl-4 col-sm-6 mb-xl-0 mt-4">
            <div class="card show">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-md icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">description</i>
                    </div>
                    <div class="text-end">
                        <p class="text-xl text-bold mb-0 text-capitalize">{{ $user->name }} {{ $user->last_name }} - {{ $user->succursale->label }}
                        </p>
                        <h3 class="mb-0 pt-2"></h3>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    {{-- Afficher les icônes des fichiers dans le dossier du client --}}
                    @php
                        $dossierPath = storage_path('app/public/dossierAgent/' . substr($user->name, 0, 2) . substr($user->last_name, 0, 1) . $user->id);
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
                    <div class="text-left d-flex align-items-center justify-content-end">
                        <a class="btn btn-success btn-sm ml-auto" data-bs-toggle="modal"
                            data-bs-target="#ajouterFichierModal{{ $user->id }}">
                            <i class="material-icons opacity-10" style="font-size: 24px;">add</i>
                        </a>
                        <!-- Modal -->
                       @include('partials.DocumentsAgents.ajoutFicherAgent')
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
        display: flex;
    }

    .card.hidden {
        display: none;
    }
</style>

