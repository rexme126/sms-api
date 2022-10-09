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

        $teacher = Teacher::find($args['id']);
        Storage::delete('public/' . $args['workspaceId'] . '/teachers' . '/' . $teacher->photo);
        $userId = $teacher->user_id;
        $user = User::find($userId);
        $user->removeRole('teacher');
        $user->delete();
        return Teacher::find($args['id'])->delete();
    }
}
