<div class="modal fade z-index-2" id="voirDossierModal{{ $user->id }}" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Documents de {{ $user->name }} {{ $user->last_name }}
                </h5>
            </div>
            <div class="modal-body">
                @php
                    $dossierPath = storage_path('app/public/dossierAgent/' . substr($user->name, 0, 2) . substr($user->last_name, 0, 1) . $user->id);
                    $files = glob($dossierPath . '/*');
                @endphp
                @if (!empty($files))
                    <div class="list-group">
                        @foreach ($files as $file)
                            <div class="d-flex justify-content-between align-items-center row">
                                <div class="d-flex align-items-center col-11 mb-1">
                                    <a href="{{ asset('storage/' . str_replace(storage_path('app/public'), '', $file)) }}"
                                        target="_blank"
                                        class="list-group-item list-group-item-action d-flex justify-content-between rounded align-items-center">
                                        <span>
                                            {{ basename($file) }}
                                        </span>
                                        <span class="badge bg-secondary rounded-pill">Document</span>
                                    </a>
                                </div>
                                <div class="d-flex align-items-center col-1">
                                    <!-- Icône de suppression -->
                                    <a href="#" data-url="{{ route('supprimerFichierAgent', ['userId' => $user->id, 'fileName' => basename($file)]) }}" class="text-danger ml-2 delete-document">
                                        <i class="material-icons">delete</i>
                                        </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>Aucun fichier trouvé.</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
