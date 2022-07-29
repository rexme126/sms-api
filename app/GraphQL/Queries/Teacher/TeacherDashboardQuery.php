<?php

namespace App\GraphQL\Queries\Teacher;

use App\Models\Workspace;

final class TeacherDashboardQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        
        $teachers = $workspace->teachers;
       
        return $teachers;
    }
}
