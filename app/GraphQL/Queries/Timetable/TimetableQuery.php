<?php

namespace App\GraphQL\Queries\Timetable;

use App\Models\Workspace;

final class TimetableQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
       
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $timetable = $workspace->timetables()->findOrFail($args['id']);
        return $timetable;
    }
}
