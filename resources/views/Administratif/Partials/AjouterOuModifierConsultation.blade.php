<div class="modal z-index-1 fade procedureClient " id="AjouterOuModifierConsultationModal{{ $candidat->id }}"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title" id="exampleModalLabel">Ajouter ou Modifier la Consultation</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('Administratif.CreerOuModifierDateConsultation', $candidat->id) }}" method="POST"
                    class="text-start DateConsForm" id="modifierDateCons{{ $candidat->id }}" enctype="multipart/form-data"
                    data-modal-id="{{ $candidat->id }}">
                    @csrf
                    @method('PUT')

                    <label for="consultation_id"><h3>
                        </h3></label>

                    <div class=" d-flex flex-wrap ">
                        <!-- Boucle sur la liste des consultations à venir -->
                        @foreach ($consultationsDisponible as $consultation)
                            <div
                                class="form-check  w-50 d-flex align-item-center justify-content-between m-1 mb-2">
                                <input class="form-check-input" type="radio" name="consultation_id"
                                    id="consultation-{{ $consultation->id }}" value="{{ $consultation->id }}"
                                    {{ $candidat->id_info_consultation == $consultation->id ? 'checked' : '' }}>
                                <label class="form-check-label w-100" for="consultation-{{ $consultation->id }}">
                                    <p class="text-bold">
                                        {{ $consultation->dateFormatee }}
                                    </p>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    
                    

                    <div class="text-center mt-3  d-flex align-items-center justify-content-around">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
