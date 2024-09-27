@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.9.8/tagify.min.css">
@section('content')

    <div class="container-fluid py-4">

        <div class="row">
            <div class="col-lg-12">
                <div class="card my-2">
                    <div class="card-header p-0 position-relative mt-n3 mx-3">
                        <div class="bg-gradient-dark border-radius-lg pt-4 pb-2 d-flex align-items-center justify-content-between p-4">
                            <div class="p-2 border-radius-lg w-40 bg-white">
                                <input type="text" id="searchInput"
                                    class="form-control text-dark text-lg bg-transparent border-0 p-1"
                                    placeholder="Rechercher...">
                            </div>

                            <div class="dropdown">
                                <button type="button" class="btn bg-primary text-white circle" data-bs-toggle="modal" data-bs-target="#creerUtilisateurModal">Créer un utilisateur</button>
                                <button class="btn bg-primary text-white circle" type="button" id="dropdownSuccursales" data-toggle="dropdown"> Pays </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownSuccursales">
                                    @foreach (\App\Models\Succursale::all() as $succursale)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                value="{{ $succursale->label }}"
                                                id="typePaiement{{ $succursale->id }}" name="pays" checked>
                                            <label class="form-check-label" for="typePaiement{{ $succursale->id }}">
                                                {{ $succursale->label }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0" style="max-height: 700px; overflow-y: auto;">
                            <table class="table align-items-center justify-content-center mb-0 dataTable">
                                <thead>
                                    <tr>
                                        <th
                                            class="col-md-2  text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            NOM
                                        </th>
                                        <th
                                            class="col-md-2 text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            POSTE
                                        </th>
                                        <th
                                            class="col-md-2 text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            SUCCURSALE
                                        </th>
                                        <th
                                            class="col-md-1 text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            INDICE PERFORMANCE (MOIS/ANNEES)
                                        </th>
                                        <th
                                            class="col-md-2 text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            DOCUMENT
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2">
                                                    <h6 class="p-2 text-xl">{{ $user->name }}
                                                        {{ $user->last_name }}</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-left">
                                                <h6 class="p-2 text-xl">{{ $user->posteOccupe->label }} </h6>
                                            </td>
                                            <td class="align-middle text-center">
                                                <h6 class="p-2 text-xl">{{ $user->succursale->label }} </h6>
                                            </td>
                                            <td class="align-middle text-center">
                                                <h6 class="p-2 text-xl">
                                                    {{ $user->rendezVous()->where('date_rdv', today())->count() }}
                                                    /
                                                    {{ $user->rendezVous()->whereMonth('date_rdv', date('m'))->whereYear('date_rdv', date('Y'))->count() }}
                                                
                                                </h6>
                                            </td>


                                            <td class="align-middle text-center">
                                                <button class="btn bg-gradient-dark" data-bs-toggle="modal"
                                                    data-bs-target="#voirDossierModal{{ $user->id }}">
                                                    Voir Dossier

                                                </button>
                                                
                                            </td>
                                            <td class="d-flex align-items-center justify-content-center">
                                                    <div class="dropdown">
                                                        <div class="btn btn-dark" type="button" id="dropdownMenuButton"
                                                            data-bs-toggle="dropdown"><i
                                                                class="material-icons">more_vert</i></div>
                                                        <div class="dropdown-menu d-flex flex-direction-column flex-wrap"
                                                            aria-labelledby="dropdownMenuButton">
                                                            <a class="btn btn-danger col-12 m-1" data-bs-toggle="modal"
                                                                data-bs-target="#ajouterFichierModal{{ $user->id }}">Ajout
                                                                Documents</a>
                                                            <a class="btn btn-danger col-12 m-1" data-bs-toggle="modal"
                                                                data-bs-target="#voirDossierModal{{ $user->id }}">Voir
                                                                Dossier</a>
                                                            <a class="btn btn-danger col-12 m-1" data-bs-toggle="modal"
                                                                data-bs-target="#modifierUtilisateurModal{{ $user->id }}">Modifier
                                                                utilisateur</a>
                                                        </div>
                                                    </div>
                                                </td>
                                        </tr>
                                       
                                        <div class="modal z-index-1 fade" id="voirDossierModal{{ $user->id }}" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Dossier de : {{ $user->name }} {{ $user->last_name }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @php
                                                            $documents = \App\Models\Document::where('id_user', $user->id)->get();
                                                        @endphp
                                                        
                                                        @if ($documents->isEmpty())
                                                            <p>Aucun document disponible pour cet utilisateur.</p>
                                                        @else
                                                            <!-- Affichage d'un seul iframe pour naviguer -->
                                                            <iframe id="docIframe-{{ $user->id }}" src="{{ asset($documents->first()->url) }}" width="100%" height="500px" frameborder="0"></iframe>
                                                            
                                                            <div class="text-center mt-3">
                                                                <button id="prevDoc-{{ $user->id }}" class="btn btn-secondary" disabled>Précédent</button>
                                                                <button id="nextDoc-{{ $user->id }}" class="btn btn-secondary">Suivant</button>
                                                            </div>

                                                            <!-- Stocker les URLs des documents -->
                                                            <ul id="docUrls-{{ $user->id }}" class="d-none">
                                                                @foreach ($documents as $document)
                                                                    <li>{{ asset($document->url) }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="modal z-index-2 fade" id="modifierUtilisateurModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="modifierUtilisateurModalLabel{{ $user->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-md" role="document">
                                                <div class="modal-content">
                                                    
                                                    <div class="modal-body">
                                                    <form action="{{ route('equipes.update', $user->id) }}" method="POST" class="bg-white rounded p-4 w-100" enctype="multipart/form-data">
                                                        @csrf
                                                        
                                                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label for="nom" class="form-label">Nom :</label>
                                                                    <input type="text" id="nom" name="nom" class="form-control ps-2" value="{{ old('nom', $user->name) }}" required>
                                                                    @error('nom')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-8">
                                                                <div class="mb-3">
                                                                    <label for="prenom" class="form-label">Prénom :</label>
                                                                    <input type="text" id="prenom" name="prenom" class="form-control ps-2" value="{{ old('prenom', $user->last_name) }}" required>
                                                                    @error('prenom')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="email" class="form-label">E-mail :</label>
                                                                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                                                    @error('email')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="mot_de_passe" class="form-label">Mot de passe :</label>
                                                                    <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control ps-2">
                                                                    @error('mot_de_passe')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label for="poste_occupe" class="form-label">Poste occupé :</label>
                                                                    <select id="poste_occupe" name="poste_occupe" class="form-select" required>
                                                                        @foreach (App\Models\PosteOccupe::all() as $poste)
                                                                            <option value="{{ $poste->id }}" {{ $poste->id == old('poste_occupe', $user->id_poste_occupe) ? 'selected' : '' }}>
                                                                                {{ $poste->label }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('poste_occupe')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label for="id_role_utilisateur" class="form-label">Rôle utilisateur :</label>
                                                                    <select id="id_role_utilisateur" name="id_role_utilisateur" class="form-select" required>
                                                                        @foreach (App\Models\RoleUtilisateur::all() as $role)
                                                                            <option value="{{ $role->id }}" {{ $role->id == old('id_role_utilisateur', $user->id_role_utilisateur) ? 'selected' : '' }}>
                                                                                {{ $role->role }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('id_role_utilisateur')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label for="id_succursale" class="form-label">Succursale :</label>
                                                                    <select id="id_succursale" name="id_succursale" class="form-select" required>
                                                                        @foreach (App\Models\Succursale::all() as $succursale)
                                                                            <option value="{{ $succursale->id }}" {{ $succursale->id == old('id_succursale', $user->id_succursale) ? 'selected' : '' }}>
                                                                                {{ $succursale->label }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('id_succursale')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="update_permission-{{ $user->id }}" class="form-label text-dark">Autorisations :</label>
                                                            <input id="update_permission-{{ $user->id }}" name="permissions" class="form-control" value="{{ old('permissions', $user->permissions->pluck('name')->implode(',')) }}" required>
                                                            @error('permissions')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="photo_profil" class="form-label">Photo de profil :</label>
                                                            <input type="file" id="photo_profil" name="photo_profil" class="form-control">
                                                            @if (!empty($user->lien_photo))
                                                                <img src="{{ asset($user->lien_photo) }}" alt="Photo de profil" class="mt-2">
                                                            @endif
                                                            @error('photo_profil')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="d-flex justify-content-end">
                                                            <button type="submit" class="btn btn-success">Modifier utilisateur</button>
                                                        </div>
                                                    </form>


                                                        @if (session('error'))
                                                            <div class="alert text-sm text-danger" role="alert">
                                                                {{ session('error') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal z-index-2 fade" id="ajouterFichierModal{{ $user->id }}" aria-labelledby="ajouterFichierModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="ajouterFichierModalLabel">Ajouter des fichiers au
                                                            dossier de {{ $user->name }} {{ $user->last_name}}   </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form action="{{ route('equipes.add_document', $user->id) }}" method="POST" enctype="multipart/form-data" novalidate>
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
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal z-index-2 fade" id="creerUtilisateurModal" tabindex="-1" role="dialog" aria-labelledby="creerUtilisateurModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <!-- Contenu du modal -->
                <div class="modal-header">
                    <h5 class="modal-title" id="creerUtilisateurModalLabel">Créer un utilisateur</h5>
                    
                </div>
                <div class="modal-body">
                    <!-- Votre formulaire ici -->
                    <form action="{{ route('equipes.store') }}" method="post" class=" bg-white rounded p-4 w-100" enctype="multipart/form-data">
                        @csrf 
    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom :</label>
                                    <input type="text" id="nom" name="nom" class="form-control ps-2" required>
                                </div>
                            </div>
                            <!-- Champ pour le prénom de l'utilisateur -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="prenom" class="form-label">Prénom :</label>
                                    <input type="text" id="prenom" name="prenom" class="form-control ps-2" required>
                                </div>
                            </div>
                        </div>         
                        <!-- Champ pour l'e-mail de l'utilisateur -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">E-mail :</label>
                                    <input type="email" id="email" name="email" class="form-control ps-2"
                                        required>
                                </div>
                            </div>
                            <!-- Champ pour le prénom de l'utilisateur -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date_naissance" class="form-label">Date naissance:</label>
                                    <input type="date_naissance" id="date_naissance" name="date_naissance" class="form-control ps-2" required>
                                </div>
                            </div>
                        </div>   
                       
                        <div class="mb-3">
                            <label for="mot_de_passe" class="form-label">Mot de passe :</label>
                            <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control ps-2"
                            required>
                        </div>
                        <div class="row">
                            <div class=" mb-3 col-md-4">
                                <label for="id_poste_occupe" class="form-label text-dark">Poste occupé :</label>
                                <select id="id_poste_occupe" name="id_poste_occupe" class="form-select ps-2" required>
                                    <!-- Options de poste à récupérer de la base de données -->
                                    @foreach ($poste_occupes as $poste)
                                        <option value="{{ $poste->id }}" class="text-dark">{{ $poste->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="roles" class="form-label text-dark">Rôle utilisateur :</label>
                                <select id="roles" name="roles" class="form-select ps-2" required>
                                    <!-- Options de rôle à récupérer de la base de données -->
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" class="text-dark">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="smb-3 col-md-4">
                                <label for="id_succursale" class="form-label text-dark">Succursale :</label>
                                <select id="id_succursale" name="id_succursale" class="form-select ps-2" required>
                                    <!-- Options de succursale à récupérer de la base de données -->
                                    @foreach (App\Models\Succursale::all() as $succursale)
                                        <option value="{{ $succursale->id }}" class="text-error ">{{ $succursale->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="create_permission" class="form-label text-dark">Autorisations :</label>
                                <input id="create_permission" name="permissions[]" class="form-control" required>
                            </div>

                        </div>
                        <div class="mb-3">
                            <label for="photo_profil" class="form-label text-dark">Photo de profil :</label>
                            <input type="file" id="photo_profil" name="photo_profil" class="form-control form-control-md border ps-2 ">
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Fermer">
                                Fermer
                            </button>
                            <button type="submit" class="btn btn-success">Créer utilisateur</button>
                            
                        </div>
                    </form>
                    @if (session('error'))
                        <div class="alert text-sm text-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.9.8/tagify.min.js"></script>
    <script>
         document.addEventListener('DOMContentLoaded', function() {
            // Tagify for update permissions
            var inputUpdate = document.querySelector('#update_permission-{{$user->id}}');
            var tagifyUpdate = new Tagify(inputUpdate, {
                whitelist: [
                    @foreach($permissions as $permission)
                        "{{ $permission->name }}",
                    @endforeach
                ],
                dropdown: {
                    maxItems: 20,
                    enabled: 0,
                    closeOnSelect: false
                }
            });

            // Tagify for create permissions
            var inputCreate = document.querySelector('#create_permission');
            var tagifyCreate = new Tagify(inputCreate, {
                whitelist: [
                    @foreach($permissions as $permission)
                        "{{ $permission->name }}",
                    @endforeach
                ],
                dropdown: {
                    maxItems: 20,
                    enabled: 0,
                    closeOnSelect: false
                }
            });
        });
    </script>

    <script>
        const table = $('.dataTable').DataTable({
            "language": {
                "lengthMenu": "",
                "zeroRecords": "Aucun résultat trouvé",
                "info": "",
                "infoEmpty": "",
                "infoFiltered": "",
                "paginate": {
                    "first": "Premier",
                    "last": "Dernier",
                    "next": "Suivant",
                    "previous": "Précédent"
                },
                "search": "" 
            },
            "lengthMenu": [10, 25, 50, 100], 
            "dom": '<"top"i>rt<"bottom"flp><"clear">', 
            "columnDefs": [{
                    "targets": [2], 
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": [2], 
                    "searchable": true,
                    "orderable": true
                }
              
            ]
        });
        
        $('#searchInput').on('input', function() {
            table.search(this.value).draw();
        });
        $('input:checkbox').on('change', function() {
            
            var pays = $('input:checkbox[name="pays"]:checked').map(function() {
                return this.value;
            }).get().join('|');
           
            table.column(2).search(pays, true, false, true).draw(false);
        });
    </script>
    <script>
       
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

       
       document.addEventListener('DOMContentLoaded', function () {
    @foreach ($users as $user)
        let currentIndex = 0;
        const docIframe = document.getElementById('docIframe-{{ $user->id }}');
        const prevButton = document.getElementById('prevDoc-{{ $user->id }}');
        const nextButton = document.getElementById('nextDoc-{{ $user->id }}');
        const docUrls = Array.from(document.querySelectorAll('#docUrls-{{ $user->id }} li')).map(li => li.textContent);

        // Initialisation de l'iframe avec le premier document
        if (docUrls.length > 0) {
            docIframe.src = docUrls[currentIndex];
        }

        // Fonction pour mettre à jour l'iframe
        function updateIframe() {
            docIframe.src = docUrls[currentIndex];
            prevButton.disabled = (currentIndex === 0);
            nextButton.disabled = (currentIndex === docUrls.length - 1);
        }

        // Gestion du bouton "Précédent"
        prevButton.addEventListener('click', function () {
            if (currentIndex > 0) {
                currentIndex--;
                updateIframe();
            }
        });

        // Gestion du bouton "Suivant"
        nextButton.addEventListener('click', function () {
            if (currentIndex < docUrls.length - 1) {
                currentIndex++;
                updateIframe();
            }
        });

        // Désactivation des boutons si un seul document
        if (docUrls.length <= 1) {
            prevButton.disabled = true;
            nextButton.disabled = true;
        }
    @endforeach
});

   </script>
@endsection
