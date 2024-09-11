@extends('layouts.app')
@section('content')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3">
                    <div class="bg-gradient-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                        <div class="p-2 border-radius-lg w-40 bg-white">
                            <input type="text" id="searchInput" class="form-control text-dark text-lg bg-transparent border-0 p-1" placeholder="Recherche...">
                        </div>
                        <div class="d-flex align-items-center justify-content-around w-50">
                            <button class="btn bg-primary text-white circle" data-bs-toggle="modal" data-bs-target="#addVersement"> <i class="material-icons">add</i> Faire un versement </button>
                            <button class="btn bg-primary text-white circle" data-bs-toggle="modal" data-bs-target="#addDepense"> <i class="material-icons">add</i> Enregistrer une dépense </button>
                        </div>
                    </div>
                </div>

                <div class="container mt-5">
                    <div class="row">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
        {{-- modal add document --}}
        <div class="modal z-index-1 fade" id="addVersement" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-top">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title align-items-center" id="exampleModalLabel">Enregistrer un versement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="row">
                                <!-- Type de versement -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="type_versement" class="form-label">Type de versement</label>
                                        <select name="type_versement" id="type_versement" class="form-select" required>
                                            <option value="">Sélectionner un type</option>
                                            <option value="1er_versement" {{ old('type_versement') == '1er_versement' ? 'selected' : '' }}>1er versement</option>
                                            <option value="2e_versement" {{ old('type_versement') == '2e_versement' ? 'selected' : '' }}>2e versement</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Veuillez sélectionner un type de versement.
                                        </div>
                                    </div>
                                </div>

                                <!-- Clients -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="client" class="form-label">Client</label>
                                        <select name="client" id="client" class="form-select select2" required>
                                            <option value="">Sélectionner un client</option>
                                            @foreach ($clients as $item)
                                                <option value="{{ $item->candidat->id }}" {{ old('client') == $item->candidat->id ? 'selected' : '' }}>
                                                    {{ $item->candidat->nom }} {{ $item->candidat->prenom }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Veuillez sélectionner un client.
                                        </div>
                                    </div>
                                </div>


                                <!-- Montant -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="montant" class="form-label">Montant</label>
                                        <input type="number" name="montant" id="montant" class="form-control" value="{{ old('montant') }}" placeholder="Ex: 1000" required>
                                        <div class="invalid-feedback">
                                            Veuillez entrer un montant.
                                        </div>
                                    </div>
                                </div>

                                <!-- Fichier reçu -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="recu" class="form-label">Télécharger le reçu</label>
                                        <input class="form-control" type="file" name="recu" id="recu" required>
                                        <div class="invalid-feedback">
                                            Veuillez télécharger un fichier.
                                        </div>
                                    </div>
                                </div>

                                <!-- Note -->
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="note" class="form-label">Note</label>
                                        <textarea name="note" id="note" class="form-control" rows="5" placeholder="Ajouter une note optionnelle">{{ old('note') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal z-index-1 fade" id="addDepense" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-top">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title align-items-center" id="exampleModalLabel">Enregistrer une dépense</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label for="nom" class="form-label">Titre du document</label>
                                        <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" placeholder="Ex: Fiche de consultation"required>
                                        <div class="invalid-feedback">
                                            Veuillez entrer le titre du document .
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="file" class="form-label">Telecharger le fichier</label>
                                    <input class="form-control" type="file" name="document_url">
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
       
    <script>
       $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Sélectionner un client",
                allowClear: true
            });
        });
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let folderCards = document.querySelectorAll('.folder-card');

            folderCards.forEach(card => {
                let title = card.querySelector('.card-title').textContent.toLowerCase();
                if (title.includes(filter)) {
                    card.parentElement.style.display = '';
                } else {
                    card.parentElement.style.display = 'none';
                }
            });
        });

        function confirmDelete(documentId) {
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Voulez-vous vraiment supprimer ce document?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.getElementById('delete-document');
                    form.submit();
                }
            });
        }
    </script>
    
@endsection
