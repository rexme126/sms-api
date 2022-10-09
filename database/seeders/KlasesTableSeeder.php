<?php

namespace Database\Seeders;

use App\Models\Term;
use App\Models\Klase;
use App\Models\Session;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KlasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $klases = [
            ['name' => 'JSS 1', 'workspace_id' => '2'],
            ['name' => 'JSS 2', 'workspace_id' => '2'],
            ['name' => 'JSS 3', 'workspace_id' => '2'],
            ['name' => 'SSS 1', 'workspace_id' => '2'],
            ['name' => 'SSS 2', 'workspace_id' => '2'],
            ['name' => 'SSS 3', 'workspace_id' => '2']
        ];
        foreach ($klases as $klase) {
            Klase::create($klase);
        }

        $terms = ['First Term', 'Second Term', 'Third Term'];
        foreach ($terms as $term) {
            Term::create(['name' => $term]);
        }
    }
}
