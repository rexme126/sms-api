<?php

namespace App\GraphQL\Queries\ExamTimetable;

use App\Models\Workspace;

final class ExamTimetablesQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $timetables = $workspace->examTimetables()->where([
            'klase_id' => $args['klase_id'],
            'section_id' => $args['section_id']
        ])->get();
        return $timetables;
    }
}
