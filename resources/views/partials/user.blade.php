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
@include('Informatique.Partials.ModifierUser', ['user' => Auth::user()])
