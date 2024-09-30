<?php

namespace Database\Seeders;

use App\Models\ExchangeRate;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ExchangeRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exchanges = ExchangeRate::get();
        if(count($exchanges) == 0){
            ExchangeRate::create([
                'rate_dollar' => 1,
                'rate_fcfa' => 433,
            ]);
            
        }
    }
}
