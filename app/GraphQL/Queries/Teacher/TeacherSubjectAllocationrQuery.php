<?php

namespace App\GraphQL\Queries\Teacher;

use App\Models\Workspace;

final class TeacherSubjectAllocationrQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace= Workspace::findOrFail($args['workspaceId']);
        $assign = $workspace->assignSubjectToTeachers()->where([
            'teacher_id'=> $args['teacherId'],
        ])->get();
        
        return $assign;
    }
}
