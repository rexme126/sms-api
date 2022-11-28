<?php

namespace App\GraphQL\Mutations\Workspace;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

final class UpdateSchoolWorkspace
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $file = $args['photo'];
        $workspace = Workspace::findOrFail($args['id']);
        
        if ($file != null) {
            $name =  Str::random(4) . $file->getClientOriginalName();
            $file->storePubliclyAs('public/' . $workspace->id . '/schools', $name);

            Storage::delete('public/' . $workspace->id . '/schools' . '/' . $workspace->photo);
            $workspace->name = $args['name'];
            $workspace->email = $args['email'];
            $workspace->slug = $args['slug'];
            $workspace->gender = $args['gender'];
            $workspace->photo = $name;
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
        } else {
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
        }
        return $workspace;
    }
}
