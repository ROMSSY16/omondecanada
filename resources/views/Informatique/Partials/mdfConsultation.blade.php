<div class="modal z-index-1 fade consultation" id="mdfConsultation{{ $consultation->id }}"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier Consultation</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('modifierConsultation', ['id' => $consultation->id]) }}" method="POST"
                    class="text-start" id="consultationForm{{ $consultation->id }}">
                    @csrf
                    @method('PUT')

                    <div class=" mb-3 p-2">
                        <label for="lien_zoom" class="form-label">Lien Zoom</label>
                        <input type="text" name="lien_zoom" id="lien_zoom" class="form-control"
                            value="{{ $consultation->lien_zoom }}" required>
                    </div>

                    <div class="mb-3 p-2">
                        <label for="lien_zoom_demarrer" class="form-label">Lien démarrer</label>
                        <input type="text" name="lien_zoom_demarrer" id="lien_zoom_demarrer" class="form-control"
                            value="{{ $consultation->lien_zoom_demarrer }}" required>
                    </div>

                    <div class="row p-3">
                        <div class="col-4 mb-3 p-2">
                            <label for="date_heure" class="form-label">Date et Heure</label>
                            <input type="datetime-local" name="date_heure" id="date_heure" class="form-control"
                                value="{{ $consultation->date_heure }}" required>
                        </div>

                        <div class="col-4 mb-3 p-2">
                            <label for="nombre_candidats" class="form-label">Nombre de participants</label>
                            <input type="tel" name="nombre_candidats" id="nombre_candidats" class="form-control"
                                value="{{ $consultation->nombre_candidats }}" required>
                        </div>

                        <div class="col-4 mb-3 p-2">
                            <label for="id_consultante" class="form-label">Nom de la Consultante</label>
                            <select name="id_consultante" id="id_consultante" class="form-select p-2" required>
                                @foreach($data_consultante as $consultante)
                                    <option value="{{ $consultante->id }}" {{ $consultation->id_consultante == $consultante->id ? 'selected' : '' }}>
                                        {{ $consultante->nom }} {{ $consultante->prenoms }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="text-end d-flex justify-content-around">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">FERMER</button>
                        <button type="submit" class="btn btn-success">ENREGISTRER</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
