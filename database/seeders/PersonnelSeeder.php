<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Succursale;
use App\Models\PosteOccupe;
use Illuminate\Database\Seeder;

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
