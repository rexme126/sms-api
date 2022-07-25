<?php

namespace App\GraphQL\Queries\Subject;

use App\Models\Workspace;

final class SubjectQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $subject = $workspace->subjects()->findOrFail($args['id']);
        return $subject;
    }
}
