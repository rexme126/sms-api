<?php

namespace App\GraphQL\Mutations\Admin;

use App\Models\Role;
use App\Models\SchoolAdmin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class CreateSchoolAdminMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $userData = $args['userTable'];
        $schoolAdminTable =  $args['schoolAdminTable'];
        $file = $schoolAdminTable['photo'];


        $user = User::create([
            'email' => $userData['email'],
            'state_id' => $userData['state'],
            'city' => $userData['city'],
            'country_id' => $userData['country'],
            'blood_group_id' => $userData['bloodGroup'],
            'lga' => $userData['lga'],
            'user_type' => 'admin',
            'religion' => $userData['religion'],
            'password' => Hash::make('school'),
            'first_name' => strtoupper($schoolAdminTable['first_name']),
            'workspace_id' => $args['workspaceId']
        ]);

        $role = Role::where('name', 'admin')->first();
        $user->assignRole($role->name);

        if ($file != null) {
            $name =  Str::random(4) . $file->getClientOriginalName();
            $path = $file->storePubliclyAs('public/' . $args['workspaceId'] . '/admin', $name);
            SchoolAdmin::create([
                'first_name' => strtoupper($schoolAdminTable['first_name']),
                'last_name' => strtoupper($schoolAdminTable['last_name']),
                'middle_name' => strtoupper($schoolAdminTable['middle_name']),
                'phone' => $schoolAdminTable['phone'],
                'qualification' => $schoolAdminTable['qualification'],
                'gender' => $schoolAdminTable['gender'],
                'user_id' => $user->id,
                'photo' => $name,
                'code' => strtoupper(Str::random(8)),
                'birthday' => $schoolAdminTable['birthday'],
                'slug' => Str::slug($schoolAdminTable['first_name'] . Str::random(8)),
                'workspace_id' => $args['workspaceId']
            ]);
        } else {
            return  SchoolAdmin::create([
                'first_name' => strtoupper($schoolAdminTable['first_name']),
                'last_name' => strtoupper($schoolAdminTable['last_name']),
                'middle_name' => strtoupper($schoolAdminTable['middle_name']),
                'phone' => $schoolAdminTable['phone'],
                'qualification' => $schoolAdminTable['qualification'],
                'gender' => $schoolAdminTable['gender'],
                'user_id' => $user->id,
                'code' => strtoupper(Str::random(8)),
                'birthday' => $schoolAdminTable['birthday'],
                'slug' => Str::slug($schoolAdminTable['first_name'] . Str::random(8)),
                'workspace_id' => $args['workspaceId']

            ]);
        }
    }
}
