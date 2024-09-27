
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
                <div class="modal fade z-index-2" id="voirDossierModal{{ $user->id }}" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Documents de {{ $user->name }} {{ $user->last_name }}
                                </h5>
                            </div>
                            <div class="modal-body">
                                @php
                                    $dossierPath = storage_path('app/public/dossierAgent/' . substr($user->name, 0, 2) . substr($user->last_name, 0, 1) . $user->id);
                                    $files = glob($dossierPath . '/*');
                                @endphp
                                @if (!empty($files))
                                    <div class="list-group">
                                        @foreach ($files as $file)
                                            <div class="d-flex justify-content-between align-items-center row">
                                                <div class="d-flex align-items-center col-11 mb-1">
                                                    <a href="{{ asset('storage/' . str_replace(storage_path('app/public'), '', $file)) }}"
                                                        target="_blank"
                                                        class="list-group-item list-group-item-action d-flex justify-content-between rounded align-items-center">
                                                        <span>
                                                            {{ basename($file) }}
                                                        </span>
                                                        <span class="badge bg-secondary rounded-pill">Document</span>
                                                    </a>
                                                </div>
                                                <div class="d-flex align-items-center col-1">
                                                    <!-- Icône de suppression -->
                                                    <a href="#" data-url="{{ route('supprimerFichierAgent', ['userId' => $user->id, 'fileName' => basename($file)]) }}" class="text-danger ml-2 delete-document">
                                                        <i class="material-icons">delete</i>
                                                        </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p>Aucun fichier trouvé.</p>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
                

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
                            <label for="permission" class="form-label text-dark">Autorisations :</label>
                            <input id="update_permission" name="permissions" class="form-control" value="{{ old('permissions', $user->permissions->pluck('name')->implode(',')) }}" required>
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

    @endforeach
                              
    <div class="modal z-index-2 fade" id="creerUtilisateurModal" tabindex="-1" role="dialog" aria-labelledby="creerUtilisateurModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="creerUtilisateurModalLabel">Créer un utilisateur</h5>
                    
                </div>
                <div class="modal-body">
                    <form action="{{ route('equipes.store') }}" method="post" class=" bg-white rounded p-4 w-100" enctype="multipart/form-data">
                        @csrf 
    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom :</label>
                                    <input type="text" id="nom" name="nom" class="form-control ps-2" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="prenom" class="form-label">Prénom :</label>
                                    <input type="text" id="prenom" name="prenom" class="form-control ps-2" required>
                                </div>
                            </div>
                        </div>         
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail :</label>
                            <input type="email" id="email" name="email" class="form-control ps-2"
                                required>
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
                                    @foreach ($poste_occupes as $poste)
                                        <option value="{{ $poste->id }}" class="text-dark">{{ $poste->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="roles" class="form-label text-dark">Rôle utilisateur :</label>
                                <select id="roles" name="roles" class="form-select ps-2" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" class="text-dark">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="smb-3 col-md-4">
                                <label for="id_succursale" class="form-label text-dark">Succursale :</label>
                                <select id="id_succursale" name="id_succursale" class="form-select ps-2" required>
                                    @foreach (App\Models\Succursale::all() as $succursale)
                                        <option value="{{ $succursale->id }}" class="text-error ">{{ $succursale->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="permission" class="form-label text-dark">Autorisations :</label>
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
            var inputUpdate = document.querySelector('#update_permission');
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

