<?php

namespace Database\Seeders\assign_permissions_to_user;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class AssignPermissionsToDirection extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $direction = User::firstWhere('name', 'Direction');
        $role = Role::where('name', 'Direction')->first();
        
        if (!$direction) {
            $this->command->info('Utilisateur "Direction" n\'existe pas.');
            return;
        }

        if (!$role) {
            $this->command->info('Rôle "Direction" n\'existe pas.');
            return;
        }

        $permissions = [
            'Historique des consultations',
            'Voir détail consultation',

            'Voir dossier client',

            'Voir banque',
           
            'Voir personnels',
            'Afficher tous les candidats',
        ];
        $direction->roles()->sync($role->id);
        $permissionIds = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
        $direction->permissions()->sync($permissionIds);
    }
}
