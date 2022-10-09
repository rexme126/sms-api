<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(WorkspacesSeederTable::class);
        $this->call(BloodGroupsTableSeeder::class);
        $this->call(KlasesTableSeeder::class);
        $this->call(RolesAndPermissionsTableSeeder::class);
        $this->call(SetPromotionSeeder::class);
        $this->call(GradesSeeder::class);
      
    }
}
