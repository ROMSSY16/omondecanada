<!-- Modal -->
<div class="modal z-index-2 fade" id="ajouterFichierModal{{ $candidat->id }}"
    aria-labelledby="ajouterFichierModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ajouterFichierModalLabel">Ajouter des fichiers au
                    dossier de {{ $candidat->nom }} {{ $candidat->prenom }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="ajouterFichierForm{{ $candidat->id }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="fichiers" class="form-label">Sélectionner des
                            fichiers</label>
                        <div class="input-group">
                            <input type="file" class="form-control border rounded-3 p-2"
                                id="fichiers{{ $candidat->id }}" name="fichiers[]" multiple
                                style="height: 3rem;">
                            <label class="input-group-text"
                                for="fichiers{{ $candidat->id }}">Parcourir</label>
                        </div>
                    </div>


                    <div class="text-end d-flex justify-content-around">
                        <button type="button" class="btn btn-dark"
                            data-bs-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-success w-30"
                            onclick="ajouterFichiers({{ $candidat->id }})">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>