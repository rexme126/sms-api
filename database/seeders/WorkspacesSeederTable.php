<?php

namespace Database\Seeders;

use App\Models\Workspace;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class WorkspacesSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $w = new Workspace();
        $w->name = 'defaultWorkspace';
        $w->slug= Str::slug('defaultWorkspace');
        $w->save();
    }
}
