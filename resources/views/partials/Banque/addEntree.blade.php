<!-- Modal pour ajouter une entrée -->
<div class="modal fade z-index-1" id="ajouterEntreeModal" tabindex="-1" role="dialog"
    aria-labelledby="ajouterEntreeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ajouterEntreeModalLabel">Ajouter une entrée</h5>

            </div>
            <div class="modal-body">
                <!-- Formulaire pour ajouter une entrée -->
                <form action="{{ route('ajoutEntree') }}" method="post">
                    @csrf

                    <div class="d-flex">
                        <!-- Champs Montant -->
                        <div class="input-group input-group-outline mb-3 p-2">
                            <label for="montant" class="form-label">Montant :</label>
                            <input type="text" name="montant" id="montant" class="form-control" required>
                        </div>


                        <!-- Champs Date -->


                        <div class="input-group input-group-outline mb-3 p-2">
                            <label for="date" class="form-label">Date:</label>
                            <input type="date" name="date" id="date" class="form-control"
                                value="{{ now()->format('Y-m-d') }}" required>
                        </div>

                    </div>
                    <!-- Champs Candidat -->
                    <div class="input-group input-group-outline mb-3 p-2">
                        <label for="candidat" class="form-label">Candidat :</label>
                        <select name="candidat" id="candidat" class="form-control" required>
                            <!-- Option vide au début pour laisser le choix par défaut -->
                            <option value="" disabled selected>Choisissez un candidat</option>
                    
                            <!-- Récupérer la liste des candidats triés par nom -->
                            @foreach (App\Models\Candidat::orderBy('nom')->get() as $candidat)
                                <option value="{{ $candidat->id }}">{{ $candidat->nom }} {{ $candidat->prenom }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Champ Type (Versement ou Consultation) -->
                    <div class="input-group input-group-outline d-flex">
                        <label for="type">Type :</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="versement" value="1"
                                required>
                            <label class="form-check-label" for="versement">Versement</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="consultation"
                                value="2" required>
                            <label class="form-check-label" for="consultation">Consultation</label>
                        </div>
                    </div>
                    @if (session('error'))
                        <div class="alert text-sm text-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Bouton Enregistrer -->
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>
