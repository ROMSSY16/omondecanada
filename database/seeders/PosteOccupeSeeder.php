<?php

namespace Database\Seeders;

use App\Models\PosteOccupe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PosteOccupeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $postes = PosteOccupe::get();
        if(count($postes) == 0){

            $postes = [
                'Consultante',
                'Informaticien(e)',
                'Commercial(e)',
                'Directeur des operations',
                'Attache Administrative',
                'Directeur General Adjoint',
                'PDG',
                'Comptable'
            ];
            foreach($postes as $poste){
                PosteOccupe::create([
                    'label' => $poste,
                ]);
            }
        }
    }
}
