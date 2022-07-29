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
                'slug' => Str::slug('defaultWorkspace')
            ],
            [
                'name' => 'ronazonWorkspace',
                'slug' => Str::slug('ronazonWorkspace')
            ],
        ];
        foreach ($worksapces as $worksapce) {
           $wp=  Workspace::firstOrNew([
                'name' => $worksapce['name'],
                'slug' => $worksapce['slug'],
            ]);
            $wp->save();

        }
    }
}
