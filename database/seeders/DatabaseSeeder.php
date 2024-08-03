<?php

// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Database\Seeders\assign_permissions_to_user\AssignPermissionsToAdministratif;
use Database\Seeders\assign_permissions_to_user\AssignPermissionsToCommercial;
use Database\Seeders\assign_permissions_to_user\AssignPermissionsToConsultante;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\PersonnelSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\SuccursaleSeeder;
use Database\Seeders\PosteOccupeSeeder;
use Database\Seeders\RoleUtilisateurSeeder;
use Database\Seeders\assign_permissions_to_user\AssignPermissionsToDirection;
use Database\Seeders\assign_permissions_to_user\AssignPermissionsToInformatique;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        

        $this->call(CategorySeeder::class);
        $this->call(RoleUtilisateurSeeder::class);
        $this->call(PosteOccupeSeeder::class);
        $this->call(SuccursaleSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(PersonnelSeeder::class);
        $this->call(AssignPermissionsToDirection::class);
        $this->call(AssignPermissionsToCommercial::class);
        $this->call(AssignPermissionsToConsultante::class);
        $this->call(AssignPermissionsToAdministratif::class);
        $this->call(AssignPermissionsToInformatique::class);

    }
}
