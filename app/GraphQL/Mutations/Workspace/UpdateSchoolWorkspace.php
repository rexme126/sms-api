<?php

namespace App\GraphQL\Mutations\Workspace;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Support\Facades\Hash;

final class UpdateSchoolWorkspace
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {

        $workspace = Workspace::findOrFail($args['id']);
        $workspace->name = $args['name'];
        $workspace->email = $args['email'];
        $workspace->slug = $args['slug'];
        $workspace->gender = $args['gender'];
        $workspace->save();

        if ($workspace) {
            $user = User::where('workspace_id', $args['id'])->first();
            $user->first_name = $args['first_name'];
            $user->last_name = $args['last_name'];
            $user->country_id = $args['country'];
            $user->state_id = $args['state'];
            $user->city = $args['city'];
            $user->lga = $args['lga'];
            $user->email = $args['email'];
            $user->phone = $args['phone'];
            $user->save();
        }

        return $workspace;
    }
}
