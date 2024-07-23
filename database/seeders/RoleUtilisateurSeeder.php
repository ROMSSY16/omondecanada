<?php

namespace Database\Seeders;

use App\Models\RoleUtilisateur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleUtilisateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = RoleUtilisateur::get();
        if(count($roles) == 0){

            $roles = [
                'Consultante',
                'Commercial',
                'Administratif',
                'IT',
                'Direction',
            ];
            foreach($roles as $role){
                RoleUtilisateur::create([
                    'role' => $role,
                ]);
            }
        }
    }
}
