<!--
=========================================================
* Material Dashboard 2 - v3.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href={{ asset('assets/img/logos/icon.png') }}>
    <title>
        Omonde Canada - CRM
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-200 d-flex align-item-center justify-content-center">
    <main>
        <h1>Création d'utilisateur</h1>
        <form action="{{ route('creer-utilisateur.creer') }}" method="post"
            class="col-md-10 bg-white rounded p-4 w-100 col-lg-10" enctype="multipart/form-data">
            @csrf <!-- Ajoutez le jeton CSRF pour protéger le formulaire -->

            <div class="d-flex">

                <!-- Champ pour le nom de l'utilisateur -->
                <div class="input-group input-group-outline mb-3">
                    <label for="nom" class="form-label">Nom :</label>
                    <input type="text" id="nom" name="nom" class="form-control"
                        placeholder="Entrez votre nom" required>
                </div>
                <!-- Champ pour le prénom de l'utilisateur -->
                <div class="input-group input-group-outline mb-3">
                    <label for="prenom" class="form-label">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" class="form-control"
                        placeholder="Entrez votre prénom" required>
                </div>

            </div>


            <!-- Champ pour l'e-mail de l'utilisateur -->
            <div class="input-group input-group-outline mb-3">
                <label for="email" class="form-label">E-mail :</label>
                <input type="email" id="email" name="email" class="form-control"
                    placeholder="Entrez votre adresse e-mail" required>
            </div>

            <!-- Champ pour le mot de passe de l'utilisateur -->
            <div class="input-group input-group-outline mb-3">
                <label for="mot_de_passe" class="form-label">Mot de passe :</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control"
                    placeholder="Entrez votre mot de passe" required>
            </div>

            <!-- Champ pour le poste occupé -->
            <div class="select-group  mb-3">
                <label for="poste_occupe" class="form-label text-dark">Poste occupé :</label>
                <select id="poste_occupe" name="poste_occupe" class="form-select" required>
                    <!-- Options de poste à récupérer de la base de données -->
                    @foreach (App\Models\PosteOccupe::all() as $poste)
                        <option value="{{ $poste->id }}" class="text-dark p-3">{{ $poste->label }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Champ pour le rôle utilisateur -->
            <div class="select-group  mb-3">
                <label for="id_role_utilisateur" class="form-label text-dark">Rôle utilisateur :</label>
                <select id="id_role_utilisateur" name="id_role_utilisateur" class="form-select" required>
                    <!-- Options de rôle à récupérer de la base de données -->
                    @foreach (App\Models\RoleUtilisateur::all() as $role)
                        <option value="{{ $role->id }}" class="text-dark">{{ $role->role }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Champ pour la succursale -->
            <div class="select-group  mb-3">
                <label for="id_succursale" class="form-label text-dark">Succursale :</label>
                <select id="id_succursale" name="id_succursale" class="form-select" required>
                    <!-- Options de succursale à récupérer de la base de données -->
                    @foreach (App\Models\Succursale::all() as $succursale)
                        <option value="{{ $succursale->id }}" class="text-error ">{{ $succursale->label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="photo_profil" class="form-label text-dark">Photo de profil :</label>
                <input type="file" id="photo_profil" name="photo_profil" class="form-control form-control-md">
            </div>



            <!-- Bouton de soumission du formulaire -->
            <button type="submit" class="btn btn-primary">Créer utilisateur</button>
        </form>




    </main>
    @include('partials.plugin')

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

</html>
