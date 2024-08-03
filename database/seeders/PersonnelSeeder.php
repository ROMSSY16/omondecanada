<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use App\Models\Succursale;
use App\Models\PosteOccupe;
use App\Models\Role;
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
            $poste = PosteOccupe::where('label', 'PDG')->first();
            $succursale = Succursale::where('label', 'Cote d\'Ivoire')->first();

            $direction = User::create([
                'id' => 1,
                'name' => 'Direction',
                'last_name' => 'Omonde Canada',
                'email' => 'direction@gmail.com',
                'password' => bcrypt('123456789'),
                'id_poste_occupe' => $poste->id,
                'id_succursale' => $succursale->id,
            ]);
           
            //CONSULTANTE
            $poste = PosteOccupe::where('label', 'Consultante')->first();
            $succursale = Succursale::where('label', 'Cote d\'Ivoire')->first();
    
            $consultante = User::create([
                'id' => 2,
                'name' => 'Consultant(e)',
                'last_name' => 'Omonde Canada',
                'email' => 'consultant@gmail.com',
                'password' => bcrypt('123456789'),
                'id_poste_occupe' => $poste->id,
                'id_succursale' => $succursale->id,
            ]);

            //COMMERCIAL - CONSEILLER
            $poste = PosteOccupe::where('label', 'Commercial(e)')->first();
            $succursale = Succursale::where('label', 'Cote d\'Ivoire')->first();
    
            $commercial = User::create([
                'id' => 3,
                'name' => 'Commercial(e)',
                'last_name' => 'Omonde Canada',
                'email' => 'commercial@gmail.com',
                'password' => bcrypt('123456789'),
                'id_poste_occupe' => $poste->id,
                'id_succursale' => $succursale->id,
            ]);

            //ADMINISTRATIF
            $poste = PosteOccupe::where('label', 'Attache Administrative')->first();
            $succursale = Succursale::where('label', 'Cote d\'Ivoire')->first();
    
            $administratif = User::create([
                'id' => 4,
                'name' => 'Administratif',
                'last_name' => 'Omonde Canada',
                'email' => 'administratif@gmail.com',
                'password' => bcrypt('123456789'),
                'id_poste_occupe' => $poste->id,
                'id_succursale' => $succursale->id,
            ]);

            //IT
            $poste = PosteOccupe::where('label', 'Informaticien(e)')->first();
            $succursale = Succursale::where('label', 'Cote d\'Ivoire')->first();
    
            $informaticien = User::create([
                'id' => 5,
                'name' => 'Informaticien(e)',
                'last_name' => 'Omonde Canada',
                'email' => 'informaticien@gmail.com',
                'password' => bcrypt('123456789'),
                'id_poste_occupe' => $poste->id,
                'id_succursale' => $succursale->id,
            ]);
           
        }

    }
}
