<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        // Permission
         
        $permissions = [
            [
                'name' => 'assign-main-admin'
            ],
             [
                'name' => 'assign-admin'
            ],
            [
                'name' => 'create'
            ],
            [
                'name' => 'update'
            ],
            [
                'name' => 'delete'
            ]
        ];

        // Roles
        $roles = [
            [
                'name' => 'super admin',
                'permissions' => [
                    'assign-main-admin',
                    'assign-admin',
                    'delete',
                    'update',
                    
                ],
            ],
             [
                'name' => 'main admin',
                'permissions' => [
                    'assign-admin',
                    'delete',
                    'update',
                   
                ]
            ],
             [
                'name' => 'admin',
                'permissions' => [
                    'delete',
                    'update',
                    
                ]
            ],
             [
                'name' => 'teacher',
                'permissions' => [
                   'delete',
                    'update',
                    'create'
                ]
            ],
            [
                'name' => 'accountant',
                'permissions' => [
                      'delete',
                    'update',
                  
                    
                ]
            ]
            ,
            [
                'name' => 'libarian',
                'permissions' => [
                     'delete',
                    'update',
                    
                    
                ]
            ]
            ,
            [
                'name' => 'student',
                'permissions' => [
                    ''        
                ]
            ],
             [
                'name' => 'guardian',
                'permissions' => [
                    ''        
                ]
            ]
        ];

        foreach ($permissions as $permission) {
           Permission::forceCreate($permission);
        }

        foreach ($roles as $role) {
            $permissions = $role['permissions'];
            // info($permissions);
             unset($role['permissions']);
            $role = Role::forceCreate($role);
            $role->givePermissionTo($permissions);
        }

          $user= User::create([
            'first_name'=> 'Rex',
            'email'=> 'tojurex@yahoo.com',
            'country_id'=> 1,
            'state_id'=> 1,
            'city_id'=>1,
            'lga'=> 'Obio-Akpor',
            'blood_group_id'=> 1,
            'password' => Hash::make('destiny12')
        ]);
        $user->assignRole(2);
    
    }
}
