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
        $worksapces = [
            [
                'name' => 'defaultWorkspace',
                'slug' => Str::slug('defaultWorkspace'),
                'email' => 'tojufutughe@gmail.com',
                'status' => 1,
            ],
            [
                'name' => 'ronazonWorkspace',
                'slug' => Str::slug('ronazonWorkspace'),
                'email' => 'ronazon.ltd@gmail.com',
                'status' => 1,
            ],
        ];
        foreach ($worksapces as $worksapce) {
            Workspace::create($worksapce);
        }
    }
}
