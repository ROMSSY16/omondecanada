<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = Permission::all();
        if ($permissions->isEmpty()) {
            $permissionsData = [
                'Manage Prospects',
                'Afficher tous les prospects',
                'Afficher prospects',
                'Enregister prospect',
                'Voir détail prospect',
                'Supprimer prospect',
                'Modifier prospect',

                'Manage Rendez-vous',
                'Afficher tous les rendez-vous',
                'Afficher rendez-vous',
                'Enregister rendez-vous',
                'Voir détail rendez-vous',
                'Supprimer rendez-vous',
                'Modifier date rendez-vous',
                'Valider rendez-vous',

                'Manage Clients',
                'Afficher tous les clients',
                'Afficher clients',
                'Voir détail client',
                'Supprimer client',

                'Manage Consultations',
                'Historique des consultations',
                'Afficher consultations',
                'Consultations a venir',
                'Faire une consultation',
                'Voir détail consultation',
                'Supprimer consultation',
                'Modifier consultation',

                'Voir dossier client',
                'Voir banque',
                'Manage personnels',
                'Voir personnels',

                'Manage candidats',
                'Voir candidats',
                'Afficher tous les candidats',

            ];

            foreach ($permissionsData as $permissionName) {
                Permission::create([ 
                    'name' => $permissionName,
                ]);
            }
        }
    }
}
