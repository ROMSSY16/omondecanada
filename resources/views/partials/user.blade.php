@php
    $user =  auth()->user();
@endphp
<!-- Affichage des informations de l'utilisateur -->
<li class="nav-item dropdown pe-2 d-flex align-items-center font-weight-bold cursor-pointer align-items-center justify-content-between">
    <!-- Avatar de l'utilisateur -->
    <div class="rounded-circle overflow-hidden d-inline-block" style="width: 40px; height: 40px;">
        @isset(auth()->user()->lien_photo)
            <img src="{{ asset('storage/' . auth()->user()->lien_photo) }}" alt="Avatar" class="w-100 h-100 object-cover">
        @else
            <img src="{{ asset('assets/img/logos/logo-icon.png') }}" alt="Avatar par défaut" class="w-100 h-100 object-cover">
        @endisset
    </div>
    <!-- Informations textuelles de l'utilisateur -->
    <div class="d-flex flex-column justify-content-around ms-2">
        <!-- Nom et prénom de l'utilisateur -->
        <span>{{ auth()->user()->name }} {{ auth()->user()->last_name }}</span>
        <!-- Affichage du label du poste -->
        <span>{{ auth()->user()->poste_occupe->label }}</span>
    </div>
</li>
<!-- Dropdown pour les paramètres -->
<li class="nav-item dropdown pe-2 d-flex align-items-center">
    <a href="#" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="material-icons fs-4">settings</span>
    </a>
    <!-- Menu déroulant des paramètres -->
    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">


        <!-- Bouton pour modifier le profil -->
        <li class="mb-2">
            <div class="btn btn-dark d-flex align-items-center justify-content-around p-2" data-bs-toggle="modal" data-bs-target="#modifierUtilisateurModal{{ Auth()->user()->id }}">
                <span class="material-icons fs-2">person</span>
                <span class="text-md text-bold text-white">
                    MODIFIER
                </span>
            </div>
        </li>
        <!-- Bouton de déconnexion -->
        <li class="mb-2">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="dropdown-item border-radius-md bg-danger">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="material-icons fs-2">logout</span>
                        <span class=" text-bold text-white">
                            DECONNEXION
                        </span>
                    </div>
                </button>
            </form>
        </li>
        
    </ul> 
</li>
<div class="modal z-index-2 fade" id="modifierUtilisateurModal{{ $user->id }}" tabindex="-1" role="dialog"
    aria-labelledby="modifierUtilisateurModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <!-- Contenu du modal -->
            <div class="modal-header">
                <h5 class="modal-title" id="modifierUtilisateurModalLabel{{ $user->id }}">Modifier un utilisateur
                </h5>
            </div>
            <div class="modal-body">
                <!-- Votre formulaire ici -->
                <form action="{{ route('ModifierUser', ['id' => $user->id]) }}" method="post"
                    class="bg-white rounded p-4 w-100" enctype="multipart/form-data">
                    @csrf <!-- Ajoutez le jeton CSRF pour protéger le formulaire -->

                    <!-- Ajoutez un champ caché pour l'ID de l'utilisateur -->
                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                    <div class="row">
                        <!-- Champ pour le nom de l'utilisateur -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom :</label>
                                <input type="text" id="nom" name="nom" class="form-control ps-2"
                                    value="{{ $user->name }}" required>
                            </div>
                        </div>
                        <!-- Champ pour le prénom de l'utilisateur -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Prénom :</label>
                                <input type="text" id="prenom" name="prenom" class="form-control ps-2"
                                    value="{{ $user->last_name }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail :</label>
                                <input type="email" id="email" name="email" class="form-control"
                                      value="{{ $user->email }}" required>
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="mb-3">
                                <label for="mot_de_passe" class="form-label">Mot de passe :</label>
                                <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control ps-2"
                                    required>
                            </div>
                        </div>
                    </div>

                    <!-- Champ pour le poste occupé -->
                    <div class="row">
                        <div class="select-group  mb-3 col-md-4">
                            <label for="poste_occupe" class="form-label text-dark">Poste occupé :</label>
                            <select id="poste_occupe" name="poste_occupe" class="form-select ps-2" required>
                                <!-- Options de poste à récupérer de la base de données -->
                                @foreach (App\Models\PosteOccupe::all() as $poste)
                                    <option value="{{ $poste->id }}" class="text-dark"
                                        @if ($poste->id == $user->id_poste_occupe) selected @endif>{{ $poste->label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Champ pour le rôle utilisateur -->
                        <div class="select-group  mb-3 col-md-4">
                            <label for="id_role_utilisateur" class="form-label text-dark">Rôle utilisateur :</label>
                            <select id="id_role_utilisateur" name="id_role_utilisateur" class="form-select ps-2"
                                required>
                                <!-- Options de rôle à récupérer de la base de données -->
                                @foreach (App\Models\RoleUtilisateur::all() as $role)
                                    <option value="{{ $role->id }}" class="text-dark"
                                        @if ($role->id == $user->id_role_utilisateur) selected @endif>{{ $role->role }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Champ pour la succursale -->
                        <div class="select-group  mb-3 col-md-4">
                            <label for="id_succursale" class="form-label text-dark">Succursale :</label>
                            <select id="id_succursale" name="id_succursale" class="form-select ps-2" required>
                                <!-- Options de succursale à récupérer de la base de données -->
                                @foreach (App\Models\Succursale::all() as $succursale)
                                    <option value="{{ $succursale->id }}" class="text-error"
                                        @if ($succursale->id == $user->id_succursale) selected @endif>{{ $succursale->label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                 
                    <div class="mb-3">
                        <label for="photo_profil" class="form-label text-dark">Photo de profil :</label>
                        <input type="file" id="photo_profil" name="photo_profil" class="form-control form-control-md border ps-2 ">
                        <!-- Afficher la photo de profil existante si elle existe -->
                        @if (!empty($user->lien_photo))
                            <img src="{{ asset('storage/' . $user->lien_photo) }}" alt="Photo de profil" class="mt-2">
                        @endif
                    </div>
                    
                    <!-- Bouton de soumission du formulaire -->
                    <div class="d-flex align-items-center justify-content-between">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Fermer">
                            Fermer
                        </button>
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
