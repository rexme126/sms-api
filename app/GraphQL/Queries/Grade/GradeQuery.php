<?php

namespace App\GraphQL\Queries\Grade;

use App\Models\Workspace;

final class GradeQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $grade = $workspace->grades->findOrFail($args['id']);
        return $grade;
    }
}
