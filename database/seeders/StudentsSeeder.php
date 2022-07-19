<?php

namespace Database\Seeders;

use App\Models\SetPromotion;
use App\Models\User;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $user = User::create();
        // Student::factory()->count(20)->create([
        //     'user_id'=> $user->id,
        //     'klase_id'=> $klase->id,
        // ]);

        $sp = new SetPromotion;
        $sp->name = 45;
        $sp->save();
    }
}
