<?php

namespace App\GraphQL\Mutations\Workspace;

use App\Models\SetPromotion;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Support\Facades\Hash;

final class CreateSchoolWorkspace
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace= new Workspace();
        $workspace->name = $args['name'];
        $workspace->email = $args['email'];
        $workspace->slug = $args['slug'];
        $workspace->save();

        if($workspace){
            $user = new User();
            $user->first_name = $args['first_name'];
            $user->last_name = $args['last_name'];
            $user->country_id = $args['country'];
            $user->state_id = $args['state'];
            $user->city_id = $args['city'];
            $user->lga = $args['lga'];
            $user->email = $args['email'];
            $user->phone = $args['phone'];
            $user->workspace_id = $workspace->id;
            $user->user_type = 'main-admin';
            $user->password = Hash::make('school');
            $user->save();

            $user->assignRole(2);

            $setPromotion = new SetPromotion();
            $setPromotion->name = 45;
            $setPromotion->workspace_id = $workspace->id;
            $setPromotion->save();
        }
    }
}
