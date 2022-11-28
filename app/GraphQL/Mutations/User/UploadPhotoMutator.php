<?php

namespace App\GraphQL\Mutations\User;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

final class UploadPhotoMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $file = $args['photo'];

        $user = User::where('id', $args['id'])->first();

        if ($file != null) {
            $name =  Str::random(4) . $file->getClientOriginalName();
            $file->storePubliclyAs('public/' . $args['workspaceId'] . '/guardians', $name);

            Storage::delete('public/' . $args['workspaceId'] . '/guardians' . '/' . $user->photo);

            $user->photo = $name;

            $user->save();

            return $user;
        } else {
            return $user;
        }
    }
}
