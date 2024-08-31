<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InfoConsultationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('info_consultation')->insert([
            [
                'label' => 'Consultation 1',
                'lien_zoom' => 'https://zoom.us/j/1234567890',
                'lien_zoom_demarrer' => 'https://zoom.us/s/1234567890',
                'date_heure' => Carbon::now()->addDays(1),
                'nombre_candidats' => '5',
                'id_consultante' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'label' => 'Consultation 2',
                'lien_zoom' => 'https://zoom.us/j/0987654321',
                'lien_zoom_demarrer' => 'https://zoom.us/s/0987654321',
                'date_heure' => Carbon::now()->addDays(2),
                'nombre_candidats' => '10',
                'id_consultante' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            
        ]);
    }
}
