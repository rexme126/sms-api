<?php

namespace App\GraphQL\Mutations\Workspace;

use App\Models\Role;
use App\Models\User;
use App\Models\Grade;
use App\Models\Workspace;
use Illuminate\Support\Str;
use App\Models\SetPromotion;
use Illuminate\Support\Facades\Hash;

final class CreateSchoolWorkspace
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = new Workspace();
        $file = $args['photo'];
    
        if ($workspace) {

            

            $workspace->name = $args['name'];
            $workspace->email = $args['email'];
            $workspace->slug = $args['slug'];
            $workspace->gender = $args['gender'];
           
            $workspace->save();

            $workspace = Workspace::findOrFail($workspace->id);

            $name =  Str::random(4) . $file->getClientOriginalName();
            //aws
            // Storage::disk('s3')->put($args['workspaceId'] . '/accountants/'.$name , file_get_contents($file));
            //  $file->storePubliclyAs($args['workspaceId'] . '/accountants', $name, 's3');
            $file->storePubliclyAs('public/' . $workspace->id . '/schools', $name);
            $workspace->photo = $name;
            $workspace->save();

            $user = new User();
            $user->first_name = $args['first_name'];
            $user->last_name = $args['last_name'];
            $user->country_id = $args['country'];
            $user->state_id = $args['state'];
            $user->city = $args['city'];
            $user->lga = $args['lga'];
            $user->email = $args['email'];
            $user->phone = $args['phone'];
            $user->workspace_id = $workspace->id;
            $user->user_type = 'main-admin';
            $user->password = Hash::make('school');
            $user->save();


            $role = Role::where('name', 'main admin')->first();
            $user->assignRole($role->id);

            $setPromotion = new SetPromotion();
            $setPromotion->name = 45;
            $setPromotion->workspace_id = $workspace->id;
            $setPromotion->save();

            $grades = [
                [
                    'name' => 'A',
                    'mark_from' => '70',
                    'mark_to' => '100',
                    'remark' => 'Excellent',
                    'workspace_id' =>  $workspace->id,
                ],
                [
                    'name' => 'B',
                    'mark_from' => '60',
                    'mark_to' => '69',
                    'remark' => 'V.Good',
                    'workspace_id' =>  $workspace->id,
                ],


                [
                    'name' => 'C',
                    'mark_from' => '50',
                    'mark_to' => '59',
                    'remark' => 'Good',
                    'workspace_id' => $workspace->id,
                ],
                [
                    'name' => 'D',
                    'mark_from' => '45',
                    'mark_to' => '49',
                    'remark' => 'Pass',
                    'workspace_id' => $workspace->id,
                ],
                [
                    'name' => 'E',
                    'mark_from' => '40',
                    'mark_to' => '44',
                    'remark' => 'Poor',
                    'workspace_id' => $workspace->id,
                ],
                [
                    'name' => 'F',
                    'mark_from' => '0',
                    'mark_to' => '39',
                    'remark' => 'Fail',
                    'workspace_id' => $workspace->id,
                ]
            ];

            foreach ($grades as $grade) {
                Grade::forceCreate($grade);
            }
        }
    }
}
