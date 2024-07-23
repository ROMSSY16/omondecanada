<div class="modal z-index-2 fade" id="creerUtilisateurModal" tabindex="-1" role="dialog" aria-labelledby="creerUtilisateurModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <!-- Contenu du modal -->
            <div class="modal-header">
                <h5 class="modal-title" id="creerUtilisateurModalLabel">Créer un utilisateur</h5>
                
            </div>
            <div class="modal-body">
                <!-- Votre formulaire ici -->
                <form action="{{ route('creer-utilisateur.creer') }}" method="post"
            class=" bg-white rounded p-4 w-100" enctype="multipart/form-data">
            @csrf <!-- Ajoutez le jeton CSRF pour protéger le formulaire -->

            <div class="row">
                <!-- Champ pour le nom de l'utilisateur -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="nom" class="form-label">Nom :</label>
                    <input type="text" id="nom" name="nom" class="form-control ps-2"
                   required>
                  </div>
                </div>
                <!-- Champ pour le prénom de l'utilisateur -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" class="form-control ps-2"
                required>
                  </div>
                </div>
              </div>


            <!-- Champ pour l'e-mail de l'utilisateur -->
            <div class="mb-3">
                <label for="email" class="form-label">E-mail :</label>
                <input type="email" id="email" name="email" class="form-control ps-2"
                     required>
            </div>

            <!-- Champ pour le mot de passe de l'utilisateur -->
            <div class="mb-3">
                <label for="mot_de_passe" class="form-label">Mot de passe :</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control ps-2"
                 required>
            </div>

            <!-- Champ pour le poste occupé -->
        <div class="row">
            <div class=" mb-3 col-md-4">
                <label for="poste_occupe" class="form-label text-dark">Poste occupé :</label>
                <select id="poste_occupe" name="poste_occupe" class="form-select ps-2" required>
                    <!-- Options de poste à récupérer de la base de données -->
                    @foreach (App\Models\PosteOccupe::all() as $poste)
                        <option value="{{ $poste->id }}" class="text-dark">{{ $poste->label }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Champ pour le rôle utilisateur -->
            <div class="  mb-3 col-md-4">
                <label for="id_role_utilisateur" class="form-label text-dark">Rôle utilisateur :</label>
                <select id="id_role_utilisateur" name="id_role_utilisateur" class="form-select ps-2" required>
                    <!-- Options de rôle à récupérer de la base de données -->
                    @foreach (App\Models\RoleUtilisateur::all() as $role)
                        <option value="{{ $role->id }}" class="text-dark">{{ $role->role }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Champ pour la succursale -->
            <div class="smb-3 col-md-4">
                <label for="id_succursale" class="form-label text-dark">Succursale :</label>
                <select id="id_succursale" name="id_succursale" class="form-select ps-2" required>
                    <!-- Options de succursale à récupérer de la base de données -->
                    @foreach (App\Models\Succursale::all() as $succursale)
                        <option value="{{ $succursale->id }}" class="text-error ">{{ $succursale->label }}</option>
                    @endforeach
                </select>
            </div>
           </div>
            <div class="mb-3">
                <label for="photo_profil" class="form-label text-dark">Photo de profil :</label>
                <input type="file" id="photo_profil" name="photo_profil" class="form-control form-control-md border ps-2 ">
            </div>



            <!-- Bouton de soumission du formulaire -->
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
