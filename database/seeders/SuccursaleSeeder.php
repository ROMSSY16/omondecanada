<?php

namespace Database\Seeders;

use App\Models\Succursale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuccursaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $succursale = Succursale::get();
        if(count($succursale) == 0){

            $succursale = [
                'Cote d\'Ivoire',
                'Cameroun',
                'Congo Brazzaville',
                'Rd Congo',
                'Canada',
            ];
            foreach($succursale as $succ){
                Succursale::create([
                    'label' => $succ,
                ]);
            }
        }
    }
}
