<?php

namespace App\GraphQL\Mutations\ExamTimetable;

use App\Models\ExamTimetable;
use App\Models\Workspace;

final class CreateExamTimetableMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $timetable = new ExamTimetable();
        $timetable->workspace_id = $workspace->id;
        $timetable->monday = $args['monday'];
        $timetable->tuesday = $args['tuesday'];
        $timetable->wednesday = $args['wednesday'];
        $timetable->thursday = $args['thursday'];
        $timetable->friday = $args['friday'];
        $timetable->time = $args['time'];
        $timetable->date = $args['date'];
        $timetable->klase_id = $args['klase_id'];
        $timetable->section_id = $args['section_id'];
        $timetable->save();

        return $timetable;
    }
}
