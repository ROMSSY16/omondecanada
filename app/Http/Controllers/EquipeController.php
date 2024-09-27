<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Document;
use App\Models\Permission;
use App\Models\Consultante;
use App\Models\PosteOccupe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;

class EquipeController extends Controller
{
    public function index(){
        $pageTitle = 'Equipe';
        $users  = User::get();
        $roles = Role::get();
        $permissions = Permission::get();
        $posteoccuppes = PosteOccupe::get();
        return view('equipe.index', [
            'roles' => $roles,
            'permissions' => $permissions,
            'poste_occupes' => $posteoccuppes,
            'users' => $users,
            'page' => $pageTitle,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'date_naissance' => 'required',
            'mot_de_passe' => 'required|string|min:6',
            'id_poste_occupe' => 'required|exists:poste_occupe,id',
            'id_succursale' => 'required|exists:succursale,id',
            'photo_profil' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'permissions' => 'required|array',
            'permissions.*' => 'string',
        ]);
        if ($request->hasFile('photo_profil')) {
            $image = $request->file('photo_profil');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(150,150)->save('assets/img/profil/'.$name_gen);
            $profilImage = 'assets/img/profil/'.$name_gen;

        }
        /* code AGENT */

        $code = strtoupper(substr($request->nom, 0, 1)) . strtoupper(substr($request->prenom, 0, 1)) . substr($request->date_naissance, 2, 2) . sprintf('%04d', User::count() + 1);

        $utilisateur = User::create([
            'code' => $code,
            'last_name' => $request->input('prenom'),
            'name' => $request->input('nom'),
            'email' => $request->input('email'),
            'date_naissance' => $request->input('date_naissance'),
            'password' => bcrypt($request->input('mot_de_passe')),
            'password2' => $request->input('mot_de_passe'),
            'id_poste_occupe' => $request->input('id_poste_occupe'),
            'id_succursale' => $request->input('id_succursale'),
            'lien_photo' => $profilImage ?? null,
        ]);
        if($utilisateur){
            if($request->email){
                Mail::send('emails.equipe', ['utilisateur' => $utilisateur], function ($message) use ($utilisateur) {
                    $message->to($utilisateur->email); 
                    $message->subject('Confirmation de compte');
                });
            }

            if ($request->has('roles')) {
                $utilisateur->roles()->sync($request->roles);
            }
    
            $permissions = json_decode($request->permissions[0], true);
            if (is_array($permissions)) {
                foreach ($permissions as $permissionData) {
                    if (isset($permissionData['value'])) {
                        $permissionName = $permissionData['value'];
                        $permission = Permission::where('name', $permissionName)->first();
                        if ($permission) {
                            $utilisateur->permissions()->attach($permission->id);
                        }
                    }
                }
            }
    
        }
        
        return redirect()->route('equipes.index')->with('success', 'Personnel enregistré avec succès !');
    }


    public function update(Request $request, $id){

        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users'. $id,
            'date_naissance' => 'required',
            'mot_de_passe' => 'required|string|min:6',
            'id_poste_occupe' => 'required|exists:poste_occupe,id',
            'id_succursale' => 'required|exists:succursale,id',
            'photo_profil' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'permissions' => 'required|array',
            'permissions.*' => 'string',
        ]);

        $utilisateur = User::find($id);

        if (!$utilisateur) {

            return redirect()->back()->with('error', 'Utilisateur non trouvé.');
        }

        if ($request->hasFile('photo_profil')) {
            $image = $request->file('photo_profil');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(150,150)->save('assets/img/profil/'.$name_gen);
            $profilImage = 'assets/img/profil/'.$name_gen;

            $utilisateur->update(['lien_photo' => $profilImage]);
        }
        $utilisateur->update([
            'last_name' => $request->input('prenom'),
            'name' => $request->input('nom'),
            'email' => $request->input('email'),
            'id_poste_occupe' => $request->input('poste_occupe'),
            'id_role_utilisateur' => $request->input('id_role_utilisateur'),
            'id_succursale' => $request->input('id_succursale'),
        ]);
        
        if ($request->has('roles')) {
            $utilisateur->roles()->sync($request->roles);
        }

        $permissions = json_decode($request->permissions[0], true);
        if (is_array($permissions)) {
            foreach ($permissions as $permissionData) {
                if (isset($permissionData['value'])) {
                    $permissionName = $permissionData['value'];
                    $permission = Permission::where('name', $permissionName)->first();
                    if ($permission) {
                        $utilisateur->permissions()->attach($permission->id);
                    }
                }
            }
        }
        if ($request->filled('mot_de_passe')) {
            $utilisateur->update(['password' => bcrypt($request->input('mot_de_passe'))]);
        }
        return redirect()->back()->with('success', 'Utilisateur modifié avec succès.');
    }
    
    public function addDocument(Request $request, $id){
        $user = User::findOrFail($id);

        if ($request->hasFile('document_url')) {
            $filename = time() . '-' . $request->file('document_url')->getClientOriginalName();
            $documentPath = 'documents/';
            $documentUrl = $documentPath . $filename;
            if (!file_exists(public_path($documentPath))) {
                mkdir(public_path($documentPath), 0777, true);
            }
            $request->file('document_url')->move(public_path($documentPath), $filename);
        } else {
            return redirect()->back()->with('error', 'Aucun fichier sélectionné.');
        }
        $document = Document::create([
            'nom' => $request->nom,
            'url' => $documentUrl,
            'id_user' => $user->id,
        ]);
        return redirect()->back()->with('success','Document ajoute avec succes.');
    }

    public function viewDocument($id){
        $user = User::findOrFail($id);
        $pageTitle = 'Dossier de : ' . $user->name . ' ' . $user->last_name;
        $documents = Document::where('id_user', $user->id)->get();
        //dd($documents);
        return view('equipe.index', [
            'pageTitle' => $pageTitle,
            'documents'=> $documents,
            'user'=> $user
        ]);
    }
}
