<?php

namespace App\GraphQL\Queries\Subject;

use App\Models\Workspace;

final class SubjectsQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $subjects = $workspace->subjects;
        return $subjects;
    }
}
