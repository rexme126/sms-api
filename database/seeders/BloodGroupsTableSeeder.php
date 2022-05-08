<?php

namespace Database\Seeders;

use App\Models\BloodGroup;
use Illuminate\Database\Seeder;

class BloodGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bloodGroups = ['O-','O+','A+','A-','B+','B-','AB'];
        foreach ($bloodGroups as $bloodGroup) {
           BloodGroup::create(['name'=>$bloodGroup]);
        }

    }
}
