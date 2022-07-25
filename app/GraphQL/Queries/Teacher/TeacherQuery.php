<?php

namespace App\GraphQL\Queries\Teacher;

use App\Models\Workspace;

final class TeacherQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $teacher = $workspace->teachers()->find($args['id']);

        return $teacher;
    }
}
