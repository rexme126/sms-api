<?php

namespace App\GraphQL\Mutations\Teacher;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Facades\Storage;

final class DeleteTeacherMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
     
       $userId =Teacher::find($args['id']);
       Storage::delete('public/'. $args['workspaceId'] . '/teachers' .'/' . $userId->photo);
       $id = $userId->user_id;
       User::find($id)->delete();
       return Teacher::find($args['id'])->delete();
    }
}
