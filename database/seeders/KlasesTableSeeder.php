<?php

namespace Database\Seeders;

use App\Models\Klase;
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
            ['name'=>'JSS 1'],
            ['name'=>'JSS 2'],
            ['name'=>'JSS 3'],
            ['name'=>'SSS 1'],
            ['name'=>'SSS 2'],
            ['name'=>'SSS 3']
        ];
        foreach ($klases as $klase) {
            Klase::create($klase);
        }
    }
}
