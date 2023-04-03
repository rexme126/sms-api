<?php

namespace App\GraphQL\Queries\Student;

use App\Models\Workspace;

final class StudentSubjectAllocationrQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace= Workspace::findOrFail($args['workspaceId']);
        $assign = $workspace->assignSubjectToTeachers()->where([
            'klase_id'=> $args['klaseId']
        ])->get();
        
        return $assign;
    }
}
