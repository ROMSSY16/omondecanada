<!-- resources/views/partials/fiche_de_renseignement_form.blade.php -->

<div class="modal fade z-index-1" id="addFicheRens{{ $candidat->id }}" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">Formulaire de renseignement {{ $candidat->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="categoryForm{{ $candidat->id }}">
                    @csrf
                    <div id="categorySections{{ $candidat->id }}">
                        @foreach($categories as $index => $category)
                            <div class="category-section" data-category-id="{{ $category->id }}" @if($index != 0) style="display:none;" @endif>
                                <h4>{{ $category->name }}</h4>
                                @foreach($category->questions as $question)
                                    <div class="form-group">
                                        <label>{{ $question->question }}</label>
                                        <input type="text" name="answers[{{ $category->id }}][{{ $question->id }}]" class="form-control" required>
                                        <span class="text-danger error-message" style="display: none;"></span>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="prevBtn{{ $candidat->id }}">Précédent</button>
                <button type="button" class="btn btn-primary" id="nextBtn{{ $candidat->id }}">Suivant</button>
                <button type="button" class="btn btn-success" id="submitBtn{{ $candidat->id }}" style="display: none;">Soumettre</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let currentCategoryIndex{{ $candidat->id }} = 0;
        const categorySections{{ $candidat->id }} = $('#categorySections{{ $candidat->id }} .category-section');
        const totalCategories{{ $candidat->id }} = categorySections{{ $candidat->id }}.length;

        function showCategory{{ $candidat->id }}(index) {
            categorySections{{ $candidat->id }}.hide();
            categorySections{{ $candidat->id }}.eq(index).show();
            $('#prevBtn{{ $candidat->id }}').toggle(index > 0);
            $('#nextBtn{{ $candidat->id }}').toggle(index < totalCategories{{ $candidat->id }} - 1);
            $('#submitBtn{{ $candidat->id }}').toggle(index === totalCategories{{ $candidat->id }} - 1);
        }

        $('#nextBtn{{ $candidat->id }}').click(function() {
            if (currentCategoryIndex{{ $candidat->id }} < totalCategories{{ $candidat->id }} - 1) {
                currentCategoryIndex{{ $candidat->id }}++;
                showCategory{{ $candidat->id }}(currentCategoryIndex{{ $candidat->id }});
            }
        });

        $('#prevBtn{{ $candidat->id }}').click(function() {
            if (currentCategoryIndex{{ $candidat->id }} > 0) {
                currentCategoryIndex{{ $candidat->id }}--;
                showCategory{{ $candidat->id }}(currentCategoryIndex{{ $candidat->id }});
            }
        });

        $('#submitBtn{{ $candidat->id }}').click(function() {
            $.ajax({
                url: "{{ route('administratif.fiche.renseignement.store', $candidat->id) }}",
                type: "POST",
                data: $('#categoryForm{{ $candidat->id }}').serialize(),
                success: function(response) {
                    alert(response.message);
                    $('#addFicheRens{{ $candidat->id }}').modal('hide');
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        $('.error-message').hide();
                        for (let field in errors) {
                            const fieldError = errors[field];
                            $(`[name="${field}"]`).next('.error-message').text(fieldError).show();
                        }
                    } else {
                        alert('Erreur lors de l\'enregistrement de la fiche de renseignement.');
                    }
                }
            });
        });

        showCategory{{ $candidat->id }}(currentCategoryIndex{{ $candidat->id }});
    });
</script>
