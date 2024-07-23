<?php

// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(RoleUtilisateurSeeder::class);
        $this->call(PosteOccupeSeeder::class);
        $this->call(SuccursaleSeeder::class);
        $this->call(PersonnelSeeder::class);
    }
}
