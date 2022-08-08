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
        info($args['klase_id']);
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $subjects = $workspace->subjects()->where([
            'klase_id' => $args['klase_id'],
            'section_id' => $args['section_id']
        ])->get();
        return $subjects;
    }
}
