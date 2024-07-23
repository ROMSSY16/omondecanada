<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Succursale;
use App\Models\PosteOccupe;
use App\Models\RoleUtilisateur;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PersonnelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::get();
        if(count($users) == 0){
            //ADMINISTRATION
            $role = RoleUtilisateur::where('role', 'Direction')->first();
            $poste = PosteOccupe::where('label', 'PDG')->first();
            $succursale = Succursale::where('label', 'Cote d\'Ivoire')->first();
    
            $direction = User::create([
                'id' => 1,
                'name' => 'Admin',
                'last_name' => 'Omonde Canada',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456789'),
                'id_poste_occupe' => $poste->id,
                'id_role_utilisateur' => $role->id,
                'id_succursale' => $succursale->id,
            ]);

            //CONSULTANTE
            $role = RoleUtilisateur::where('role', 'Consultante')->first();
            $poste = PosteOccupe::where('label', 'Consultante')->first();
            $succursale = Succursale::where('label', 'Cote d\'Ivoire')->first();
    
            $consultante = User::create([
                'id' => 2,
                'name' => 'Consultant(e)',
                'last_name' => 'Omonde Canada',
                'email' => 'consultant@gmail.com',
                'password' => bcrypt('123456789'),
                'id_poste_occupe' => $poste->id,
                'id_role_utilisateur' => $role->id,
                'id_succursale' => $succursale->id,
            ]);

            //COMMERCIAL - CONSEILLER
            $role = RoleUtilisateur::where('role', 'Commercial')->first();
            $poste = PosteOccupe::where('label', 'Commercial(e)')->first();
            $succursale = Succursale::where('label', 'Cote d\'Ivoire')->first();
    
            $commercial = User::create([
                'id' => 3,
                'name' => 'Commercial(e)',
                'last_name' => 'Omonde Canada',
                'email' => 'commercial@gmail.com',
                'password' => bcrypt('123456789'),
                'id_poste_occupe' => $poste->id,
                'id_role_utilisateur' => $role->id,
                'id_succursale' => $succursale->id,
            ]);

            //ADMINISTRATIF
            $role = RoleUtilisateur::where('role', 'Administratif')->first();
            $poste = PosteOccupe::where('label', 'Attache Administrative')->first();
            $succursale = Succursale::where('label', 'Cote d\'Ivoire')->first();
    
            $administratif = User::create([
                'id' => 4,
                'name' => 'Administratif',
                'last_name' => 'Omonde Canada',
                'email' => 'administratif@gmail.com',
                'password' => bcrypt('123456789'),
                'id_poste_occupe' => $poste->id,
                'id_role_utilisateur' => $role->id,
                'id_succursale' => $succursale->id,
            ]);

            //IT
            $role = RoleUtilisateur::where('role', 'IT')->first();
            $poste = PosteOccupe::where('label', 'Informaticien(e)')->first();
            $succursale = Succursale::where('label', 'Cote d\'Ivoire')->first();
    
            $informaticien = User::create([
                'id' => 5,
                'name' => 'Informaticien(e)',
                'last_name' => 'Omonde Canada',
                'email' => 'informaticien@gmail.com',
                'password' => bcrypt('123456789'),
                'id_poste_occupe' => $poste->id,
                'id_role_utilisateur' => $role->id,
                'id_succursale' => $succursale->id,
            ]);
        }

    }
}
