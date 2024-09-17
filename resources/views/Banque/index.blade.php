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

                <div class="card-body px-0 pb-2 bg-white">
                        <div class="table-responsive p-0" style="max-height: 700px; min-height: 700px; overflow-y: auto;">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            #
                                        </th>
                                        <th class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            MOTIF
                                        </th>
                                        <th class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            PROCEDURE
                                        </th>
                                        <th class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            TYPE
                                        </th>
                    
                                        <th class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            MONTANT
                                        </th>
                                        
                                        <th class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder text-left opacity-7 ps-2">
                                            DATE
                                        </th>
                                        <th class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder text-left opacity-7 ps-2">
                                            AGENT
                                        </th>
                                        <th class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder text-left opacity-7 ps-2">
                                            RECU
                                        </th>
                                        <th class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder text-left opacity-7 ps-2">
                                            RAISON
                                        </th>
                                        <th class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            STATUS
                                        </th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                    
                                @foreach ($transactions as $item)
                                    <tr @if($item->type == 'entree') style="background-color: #f7fcf9" @elseif($item->type == 'sortie') style="background-color: #f5e1ea" @endif>
                                        <td>
                                            <div class="d-flex">
                                                <h6 class="p-2 font-weight-bold text-lg">{{ $item->code }}
                                                     @if($item->type == 'entree') <i class="material-icons opacity-10 text-success">arrow_downward</i> @elseif($item->type == 'sortie') <i class="material-icons opacity-10 text-danger">arrow_upward</i> @endif
                                                </h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2">
                                                <span class="p-2 text-md text-center">{{ $item->motif }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2">
                                                <span class="p-2 text-md text-center">{{ $item->typeProcedure->label ?? null }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2">
                                                <h6 class="p-2 text-lg text-success text-center">{{ $item->type }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-lg font-weight-bold mb-0">{{ number_format($item->montant, 0, ' ', ' ') }}</p>
                                        </td>
                                        <td>
                                            <span class="text-md">{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</span>
                                        </td>

                                        <td class="align-middle text-left">
                                            <span class="text-md font-weight-bold">{{ $item->agent->name }} {{ $item->agent->last_name }}</span>
                                        </td>
                                        <td class="align-middle text-left">
                                            @if ($item->recu)
                                            <span class="btn bg-primary text-white circle" data-bs-toggle="modal" data-bs-target="#viewRecuModal{{$item->id}}"> <i class="material-icons">remove_red_eye</i> Reçu </span>
                                            @endif
                                           
                                        </td>
                                        <td class="align-middle text-left">
                                            <span class="text-sm">{{ $item->note }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-md text-success">éffectué</span>
                                        </td>
                                    </tr>


                                    <div class="modal z-index-1 fade" id="viewRecuModal{{ $item->id }}" aria-labelledby="recuLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="recuLabel">Recu </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @if($item->recu)
                                                        <iframe href="{{ asset($item->recu) }}" width="100%" height="500px"></iframe>
                                                    @else
                                                        <p>Aucun reçu disponible</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                    
                                </tbody>
                            </table>
                    
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
                        <form action="{{route('banque.entree.store')}}" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-4 p-2">
                                    <div class="form-group mb-3">
                                        <label for="type_versement" class="form-label">Type de versement</label>
                                        <select name="type_versement" id="type_versement" class="form-control" required>
                                            <option value="">Sélectionner un type</option>
                                            <option value="1er Versement" {{ old('type_versement') == '1er Versement' ? 'selected' : '' }}>1er Versement</option>
                                            <option value="2e Versement" {{ old('type_versement') == '2e Versement' ? 'selected' : '' }}>2e Versement</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Veuillez sélectionner un type de versement.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 p-2">
                                    <div class="form-group mb-3">
                                        <label for="client" class="form-label">Client</label>
                                        <select name="client" id="client" class="form-control select2" required>
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
                                <div class="col-md-4 mb-3 p-2">
                                    <label for="moyen_paiement" class="form-label">Mode de paiement :</label>
                                    <select name="moyen_paiement" id="moyen_paiement" class="form-control" required>
                                        <option value="" disabled {{ old('moyen_paiement') ? '' : 'selected' }}>Choisissez un moyen de paiement</option>
                                        @foreach($moyen_paiements as $item)
                                            <option value="{{ $item->id }}" {{ old('moyen_paiement') == $item->id ? 'selected' : '' }}>
                                                {{ $item->label }}
                                            </option>
                                        @endforeach
                                    </select>
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
                                <button type="submit" class="btn btn-primary">VALIDER</button>
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
                        <h5 class="modal-title text-center" id="exampleModalLabel">Enregistrer une dépense</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('banque.sortie.store')}}" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-6 p-2">
                                    <div class="form-group mb-3">
                                        <label for="type_depense" class="form-label">Type de dépense</label>
                                        <select name="type_depense" id="type_depense" class="form-control" required>
                                            <option value="">Sélectionner un type</option>
                                            <option value="Loyer" {{ old('type_depense') == 'Loyer' ? 'selected' : '' }}>Loyer</option>
                                            <option value="Facture courant" {{ old('type_depense') == 'Facture courant' ? 'selected' : '' }}>Facture courant</option>
                                            <option value="Facture eau" {{ old('type_depense') == 'Facture eau' ? 'selected' : '' }}>Facture eau</option>
                                            <option value="Recharge téléphonique" {{ old('type_depense') == 'Recharge téléphonique' ? 'selected' : '' }}>Recharge téléphonique</option>
                                            <option value="Autre" {{ old('type_depense') == 'Autre' ? 'selected' : '' }}>Autre</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Veuillez sélectionner un type de depense.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3 p-2">
                                    <label for="moyen_paiement" class="form-label">Mode de versement :</label>
                                    <select name="moyen_paiement" id="moyen_paiement" class="form-control" required>
                                        <option value="" disabled {{ old('moyen_paiement') ? '' : 'selected' }}>Choisissez un moyen de paiement</option>
                                        @foreach($moyen_paiements as $item)
                                            <option value="{{ $item->id }}" {{ old('moyen_paiement') == $item->id ? 'selected' : '' }}>
                                                {{ $item->label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Montant -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="montant" class="form-label">Montant dépensé</label>
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
                                        <label for="note" class="form-label">Justificatif</label>
                                        <textarea name="note" id="note" class="form-control" rows="5" placeholder="Ajouter une note optionnelle">{{ old('note') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">ENVOYER</button>
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
