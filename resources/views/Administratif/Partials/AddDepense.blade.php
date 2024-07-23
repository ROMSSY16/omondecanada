<!-- Modal pour ajouter une dépense -->
<div class="modal fade z-index-1" id="ajouterDepenseModal" tabindex="-1" role="dialog"
    aria-labelledby="ajouterDepenseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ajouterDepenseModalLabel">Ajouter une dépense</h5>
            </div>
            <div class="modal-body">
                <!-- Formulaire pour ajouter une dépense -->
                <form action="{{ route('ajoutDepense') }}" method="post">
                    @csrf

                    <div class="row p-3">
                        <!-- Champ Montant -->
                        <div class="col-6 mb-3 p-2">
                            <label for="montant" class="form-label">Montant :</label>
                            <input type="text" name="montant" id="montant" class="form-control" required>
                        </div>

                        <!-- Champ Date -->
                        <div class="col-6 mb-3 p-2">
                            <label for="date" class="form-label">Date :</label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ now()->format('Y-m-d') }}" required>

                        </div>
                    </div>

                    <!-- Champ Raison -->
                    <div class=" mb-3 p-2">
                        <label for="raison" class="form-label">Raison :</label>
                        <input type="text" name="raison" id="raison" class="form-control" required>
                    </div>

                    @if(session('error'))
                        <div class="alert text-sm text-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="text-center d-flex align-items-center justify-content-around mt-2">
                        <div type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</div>
                        <div type="submit" class="btn btn-success">Enregistrer</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
