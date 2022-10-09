<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;

class GradesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grades = [
            [
                'name' => 'A',
                'mark_from' => '70',
                'mark_to' => '100',
                'remark' => 'Excellent',
                'workspace_id' =>  2,
            ],
            [
                'name' => 'B',
                'mark_from' => '60',
                'mark_to' => '69',
                'remark' => 'V.Good',
                'workspace_id' =>  2,
            ],


            [
                'name' => 'C',
                'mark_from' => '50',
                'mark_to' => '59',
                'remark' => 'Good',
                'workspace_id' => 2,
            ],
            [
                'name' => 'D',
                'mark_from' => '45',
                'mark_to' => '49',
                'remark' => 'Pass',
                'workspace_id' => 2,
            ],
            [
                'name' => 'E',
                'mark_from' => '40',
                'mark_to' => '44',
                'remark' => 'Poor',
                'workspace_id' => 2,
            ],
            [
                'name' => 'F',
                'mark_from' => '0',
                'mark_to' => '39',
                'remark' => 'Fail',
                'workspace_id' => 2,
            ]
        ];

        foreach ($grades as $grade) {
            Grade::forceCreate($grade);
        }
    }
}
