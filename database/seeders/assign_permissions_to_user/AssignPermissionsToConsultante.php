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

            'Afficher consultations',
            'Historique des consultations',
            'Consultations a venir',
            'Voir détail consultation',

            'Voir dossier client',
        ];
        $consultante->roles()->sync($role->id);
        $permissionIds = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
        $consultante->permissions()->sync($permissionIds);
    }
}
