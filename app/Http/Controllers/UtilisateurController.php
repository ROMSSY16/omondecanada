<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\consultante;
use App\Models\Permission;
use App\Models\PosteOccupe;
use App\Models\Role;

class UtilisateurController extends Controller
{
    public function formulaireCreation()
    {
        $roles = Role::get();
        $permissions = Permission::get();
        $posteoccuppes = PosteOccupe::get();
        return view('equipe.index', [
            'roles' => $roles,
            'permissions' => $permissions,
            'poste_occupes' => $posteoccuppes,
        ]);
    }

    public function creer(Request $request)
    {
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'mot_de_passe' => 'required|string|min:6',
            'poste_occupe' => 'required|exists:poste_occupe,id',
            'role' => 'required',
            'id_succursale' => 'required|exists:succursale,id',
            'photo_profil' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('photo_profil')) {
            $nom = str_replace(' ', '_', $request->input('nom'));
            $prenom = str_replace(' ', '_', $request->input('prenom'));
            $path = $request->file('photo_profil')->storeAs('photo', 'photo' . $nom . $prenom . '.png', 'public');
        }

        $utilisateur = User::create([
            'last_name' => $request->input('prenom'),
            'name' => $request->input('nom'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('mot_de_passe')),
            'id_succursale' => $request->input('id_succursale'),
            'lien_photo' => $path,
        ]);

        if ($request->has('roles')) {
            $utilisateur->roles()->sync($request->roles);
        }

        if ($request->has('permissions')) {
            $utilisateur->permissions()->sync($request->permissions);
        }
        

        return redirect()->route('equipes.index')->with('success', 'Personnel enregistré avec succès !');
    }


    public function modifier(Request $request, $id)

    {

        $request->validate([

            'prenom' => 'required|string|max:255',

            'nom' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email,' . $id,

            'mot_de_passe' => 'nullable|string|min:6', // Rendre le mot de passe facultatif

            'poste_occupe' => 'required|exists:poste_occupe,id',

            'id_role_utilisateur' => 'required|exists:role_utilisateur,id',

            'id_succursale' => 'required|exists:succursale,id',

            'photo_profil' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        // Obtenez l'utilisateur à modifier

        $utilisateur = User::find($id);

        // Affichez des informations dans la console


        if (!$utilisateur) {

            return redirect()->back()->with('error', 'Utilisateur non trouvé.');
        }

        // Traitement de la photo de profil

        if ($request->hasFile('photo_profil')) {
            // Enlevez les espaces du nom et du prénom
            $nom = str_replace(' ', '_', $request->input('nom'));
            $prenom = str_replace(' ', '_', $request->input('prenom'));
        
            // Enregistrez le fichier sur le serveur
            $path = $request->file('photo_profil')->storeAs('photo', 'photo' . $nom . $prenom . '.png', 'public');

            $utilisateur->update(['lien_photo' => $path]);
        }

        // Mettez à jour les autres champs de l'utilisateur

        // Mettez à jour les autres champs de l'utilisateur
        $utilisateur->update([
            'last_name' => $request->input('prenom'),
            'name' => $request->input('nom'),
            'email' => $request->input('email'),
            'id_poste_occupe' => $request->input('poste_occupe'),
            'id_role_utilisateur' => $request->input('id_role_utilisateur'),
            'id_succursale' => $request->input('id_succursale'),
        ]);

        // Vérifiez si l'utilisateur est un consultante
        if ($request->input('id_role_utilisateur') == 0) {
            Consultante::updateOrCreate(
                ['id_utilisateur' => $utilisateur->id],
                [
                    'nom' => $request->input('nom'),
                    'prenoms' => $request->input('prenom'),
                ]
            );
        }
        

        // Mettez à jour le mot de passe s'il est fourni

        if ($request->filled('mot_de_passe')) {

            $utilisateur->update(['password' => bcrypt($request->input('mot_de_passe'))]);
        }

        // Vérifiez si l'utilisateur est un candidat

        // Affichez des informations dans la console

        return redirect()->back()->with('success', 'Utilisateur modifié avec succès.');
    }
}
