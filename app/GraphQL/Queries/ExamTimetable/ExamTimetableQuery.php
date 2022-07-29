<?php

namespace App\GraphQL\Queries\ExamTimetable;

use App\Models\Workspace;

final class ExamTimetableQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $timetable = $workspace->examTimetables()->findOrFail($args['id']);
        return $timetable;
    }
}
