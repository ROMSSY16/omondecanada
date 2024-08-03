<?php

namespace Database\Seeders\assign_permissions_to_user;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssignPermissionsToConsultante extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $consultante = User::firstWhere('name', 'Consultant(e)');
        $role = Role::where('name', 'Consultante')->first();
        
        if (!$consultante) {
            $this->command->info('Utilisateur "Consultante" n\'existe pas.');
            return;
        }

        if (!$role) {
            $this->command->info('Rôle "Consultante" n\'existe pas.');
            return;
        }

        $permissions = [
            'Manage Prospects',
            'Afficher tous les prospects',
            'Afficher mes prospects',
            'Enregistrer prospect',
            'Voir détail prospect',
            'Supprimer prospect',
            'Modifier prospect',

            'Manage Rendez-vous',
            'Afficher tous les rendez-vous',
            'Afficher mes rendez-vous',
            'Enregistrer rendez-vous',
            'Voir détail rendez-vous',
            'Supprimer rendez-vous',
            'Modifier date rendez-vous',
            'Valider rendez-vous',

            'Manage Clients',
            'Afficher tous les clients',
            'Afficher mes clients',
            'Voir détail client',
            'Supprimer client',

            'Manage Consultations',
            'Afficher toutes les consultations',
            'Afficher mes consultations',
            'Afficher consultations en attente',
            'Faire une consultation',
            'Voir détail consultation',
            'Supprimer consultation',
            'Modifier consultation',

            'Voir dossier client',
            'Voir banque',
            'Manage personnels',
            'Voir personnels',

            'Manage candidats',
            'Voir candidat',
            'Afficher tous les candidats',
        ];
        $consultante->roles()->sync($role->id);
        $permissionIds = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
        $consultante->permissions()->sync($permissionIds);
    }
}
