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
                                 <a href="#" data-url="{{ route('DelFichierCandidat', ['id' => $document->id]) }}" class="text-danger ml-2 delete-document">
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
