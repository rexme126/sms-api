<?php

namespace App\GraphQL\Queries\Teacher;

use App\Models\Workspace;

final class AssignTeachersQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $assignTeachers = $workspace->assignTeachers()->where(
            'klase_id',$args['klase_id'])->get();

        return $assignTeachers;
    }
}
