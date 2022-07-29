<?php

namespace App\GraphQL\Queries\Student;

use App\Models\Workspace;

final class StudentDashboardQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        
        $students = $workspace->students;
       
        return $students;
    }
}
