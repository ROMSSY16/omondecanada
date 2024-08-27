<?php

namespace Database\Seeders;

use App\Models\ModePaiement;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MoyenPaiementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paiements = ModePaiement::all();
        if ($paiements->isEmpty()) {
            $paiementsData = [
                'Mobile Money',
                'En espece',
                'Virement bancaire',
            ];
            foreach ($paiementsData as $paiementName) {
                ModePaiement::create([ 
                    'label' => $paiementName,
                ]);
            }
        }
    }
}
