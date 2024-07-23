<!-- Modal Structure -->
  <div class="modal fade z-index-1" id="changeTagModal{{ $candidat->id }}" tabindex="-1" aria-labelledby="changeTagModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changeTagModalLabel">Ajouter un tag</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Form to change the tag -->
          <form id="tagChangeForm" data-candidat-id="{{ $candidat->id }}">
            <div class="mb-3">
              <label for="tagSelect" class="form-label">Sélectionner un nouveau tag:</label>
              <select class="form-select" id="tagSelect">
                <!-- Options should be populated based on available tags -->
                <option selected>Choisir...</option>
                @foreach (App\Models\Tags::all() as $tag)
                <option value="{{ $tag->id }}">{{ $tag->label }}</option>
            @endforeach
              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-primary">Sauvegarder les changements</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  

 