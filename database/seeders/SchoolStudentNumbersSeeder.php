<?php

namespace Database\Seeders;

use App\Models\Numstudent;
use Illuminate\Database\Seeder;

class SchoolStudentNumbersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numberOfSudents = [
            [
                'name' => '50 - 250',
                'count' => 250
            ],
            [
                'name' => '300 - 550',
                'count' => 550
            ],
            [
                'name' => '600 - 850',
                'count' => 850
            ],
            [
                'name' => '900 - 1250',
                'count' => 1250
            ],
            [
                'name' => '1300 - Above',
                'count' => 2500
            ],

        ];

        foreach ($numberOfSudents as $student) {
            Numstudent::create($student);
        }
    }
}
