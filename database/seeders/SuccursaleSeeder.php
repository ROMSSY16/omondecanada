<?php

namespace Database\Seeders;

use App\Models\Succursale;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuccursaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $succursale = Succursale::get();
        if (count($succursale) == 0) {
            $succursales = [
                [
                    'label' => 'Canada',
                    'montant' => '100',
                    'devis' => 'USD',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'label' => 'Cote d\'Ivoire',
                    'montant' => '50000',
                    'devis' => 'FCFA',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'label' => 'Cameroun',
                    'montant' => '50000',
                    'devis' => 'FCFA',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'label' => 'Congo Brazzaville',
                    'montant' => '50000',
                    'devis' => 'FCFA',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'label' => 'Rd Congo',
                    'montant' => '100',
                    'devis' => 'USD',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];

            foreach ($succursales as $succ) {
                Succursale::create($succ);
            }
        }
    }

}
