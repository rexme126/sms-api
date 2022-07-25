<?php

namespace App\GraphQL\Queries\Student;

use App\Models\Workspace;

final class StudentQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $student = $workspace->students()->find($args['id']);

        return $student;
    }
}
