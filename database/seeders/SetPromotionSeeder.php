<?php

namespace Database\Seeders;

use App\Models\SetPromotion;
use Illuminate\Database\Seeder;

class SetPromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $sp = new SetPromotion();
        $sp->workspace_id = 2;
        $sp->name = 45;
        $sp->save();
    }
}
