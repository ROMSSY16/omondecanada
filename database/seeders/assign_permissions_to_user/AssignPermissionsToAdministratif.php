<?php

namespace Database\Seeders\assign_permissions_to_user;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssignPermissionsToAdministratif extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administratif = User::firstWhere('name', 'Administratif');
        $role = Role::where('name', 'Administratif')->first();
        
        if (!$administratif) {
            $this->command->info('Utilisateur "Administratif" n\'existe pas.');
            return;
        }

        if (!$role) {
            $this->command->info('Rôle "Administratif" n\'existe pas.');
            return;
        }

        $permissions = [

           
            'Afficher tous les clients',
            'Afficher mes clients',
            'Voir détail client',
            'Supprimer client',


            'Afficher toutes les consultations',
            'Voir détail consultation',

            'Voir dossier client',
            'Voir banque',

            'Voir candidats',
            'Afficher tous les candidats',
        ];
        $administratif->roles()->sync($role->id);
        $permissionIds = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
        $administratif->permissions()->sync($permissionIds);
    }
}
