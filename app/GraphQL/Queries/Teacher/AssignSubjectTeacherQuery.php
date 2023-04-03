<?php

namespace App\GraphQL\Queries\Teacher;

use App\Models\Workspace;

final class AssignSubjectTeacherQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace= Workspace::findOrFail($args['workspaceId']);
        $assign = $workspace->assignSubjectToTeachers()->where([
            'klase_id'=> $args['klaseId'],
            'section_id'=> $args['sectionId'],
        ])->get();
        
        return $assign;
    }
}
