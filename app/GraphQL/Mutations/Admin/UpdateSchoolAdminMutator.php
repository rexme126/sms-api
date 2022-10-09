<?php

namespace App\GraphQL\Mutations\Admin;

use App\Models\User;
use App\Models\SchoolAdmin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

final class UpdateSchoolAdminMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $id = $args['id'];
        $userData = $args['userTable'];
        $schoolAdminTable =  $args['schoolAdminTable'];
        // $file = $schoolAdminTable['photo'];

        $file = $schoolAdminTable['photo'];

        //    admin

        $admin = SchoolAdmin::where('id', $id)->first();
        $userId = $admin->user_id;
        $user = User::where('id', $userId)->first();

        if ($file != null) {
            $name =  Str::random(4) . $file->getClientOriginalName();
            $path = $file->storePubliclyAs('public/' . $args['workspaceId'] . '/admin', $name);
           
            Storage::delete('public/'. $args['workspaceId'] . '/admin' .'/' . $admin->photo);

            $admin->first_name = $schoolAdminTable['first_name'];
            $admin->last_name = $schoolAdminTable['last_name'];
            $admin->middle_name = $schoolAdminTable['middle_name'];
            $admin->birthday = $schoolAdminTable['birthday'];
            $admin->phone = $schoolAdminTable['phone'];
            $admin->photo = $name;
            $admin->qualification = $schoolAdminTable['qualification'];
            $admin->gender = $schoolAdminTable['gender'];

            // user

            $user->state_id = $userData['state'];
            $user->country_id = $userData['country'];
            $user->blood_group_id = $userData['bloodGroup'];
            $user->city = $userData['city'];
            $user->lga = $userData['lga'];
            $user->email = $userData['email'];
            $user->religion = $userData['religion'];
            $user->first_name = $schoolAdminTable['first_name'];

            $user->save();
            $admin->save();
            return $admin;
        } else {
            $admin->first_name = $schoolAdminTable['first_name'];
            $admin->last_name = $schoolAdminTable['last_name'];
            $admin->middle_name = $schoolAdminTable['middle_name'];
            $admin->birthday = $schoolAdminTable['birthday'];

            $admin->phone = $schoolAdminTable['phone'];
            $admin->qualification = $schoolAdminTable['qualification'];
            $admin->gender = $schoolAdminTable['gender'];

            $user->state_id = $userData['state'];
            $user->email = $userData['email'];
            $user->country_id = $userData['country'];
            $user->blood_group_id = $userData['bloodGroup'];
            $user->city = $userData['city'];
            $user->lga = $userData['lga'];
            $user->religion = $userData['religion'];
            $user->first_name = $schoolAdminTable['first_name'];

            $user->save();
            $admin->save();
            return $admin;
        }
    }
}
