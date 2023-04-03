<?php

namespace App\GraphQL\Queries\Workspace;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Support\Facades\Storage;

final class UserWorkspaceQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = User::findOrFail($args['id']);
        $workspace = Workspace::where('id', $user->workspace_id)->first();


        // Specify the path to your image file
        $image_pathLogo = 'public/' . $workspace->id . '/logo' . '/' . $workspace->logo;
        $image_pathStamp = 'public/' . $workspace->id . '/stamp' . '/' . $workspace->stamp;

        // // Read the image file into a string
        $image_dataLogo = Storage::get($image_pathLogo);
        $image_dataStamp = Storage::get($image_pathStamp);

        // // Convert the image data to base64 encoding
        $base64ImageLogo = base64_encode($image_dataLogo);
        $base64ImageStamp = base64_encode($image_dataStamp);


        return [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'workspace' => [
                'id' =>  $user->workspace_id,
                'name' =>  $workspace->name,
                'slug' =>  $workspace->slug,
                'logo' =>  $workspace->logo,
                'stamp' =>  $workspace->stamp,
                'status' =>  $workspace->status,
                'photo' =>  $workspace->photo,
                'gender' =>  $workspace->gender,
                'bank' =>  $workspace->bank,
                'account_no' =>  $workspace->account_no,
                'account_name' =>  $workspace->account_name,
                'logoData' =>  $base64ImageLogo,
                'stampData' =>  $base64ImageStamp,
                'numstudent' => [
                    'id' =>  $workspace->numstudent->id,
                    'name' => $workspace->numstudent->name,
                    'count' => $workspace->numstudent->count
                ],
                'paystack_secret_key' => $workspace->paystack_secret_key
            ]
        ];
    }
}
