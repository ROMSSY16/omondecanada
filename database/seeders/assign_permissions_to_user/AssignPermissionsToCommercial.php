<?php

namespace Database\Seeders\assign_permissions_to_user;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssignPermissionsToCommercial extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $commercial = User::firstWhere('name', 'Commercial(e)');
        $role = Role::where('name', 'Commercial')->first();
        
        if (!$commercial) {
            $this->command->info('Utilisateur "commercial" n\'existe pas.');
            return;
        }

        if (!$role) {
            $this->command->info('Rôle "commercial" n\'existe pas.');
            return;
        }

        $permissions = [
            'Manage Prospects',
            'Afficher tous les prospects',
            'Afficher prospects',
            'Enregistrer prospect',
            'Voir détail prospect',
            'Supprimer prospect',
            'Modifier prospect',

            'Manage Rendez-vous',
            'Afficher tous les rendez-vous',
            'Afficher rendez-vous',
            'Enregistrer rendez-vous',
            'Voir détail rendez-vous',
            'Supprimer rendez-vous',
            'Modifier date rendez-vous',
            'Valider rendez-vous',

            'Historique des consultations',
          
            'Manage candidats',
            'Voir candidats',
            'Afficher tous les candidats',

            'Afficher clients',
            'Afficher tous les clients',
        ];
        $commercial->roles()->sync($role->id);
        $permissionIds = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
        $commercial->permissions()->sync($permissionIds);
    }
}
