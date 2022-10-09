<?php

namespace App\GraphQL\Mutations\Timetable;

use App\Models\Timetable;
use App\Models\Workspace;

final class CreateTimetableMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $timetable = new Timetable();
        $timetable->workspace_id = $workspace->id;
        $timetable->monday = $args['monday'];
        $timetable->tuesday = $args['tuesday'];
        $timetable->wednesday = $args['wednesday'];
        $timetable->thursday = $args['thursday'];
        $timetable->friday = $args['friday'];
        $timetable->time = $args['time'];
        $timetable->klase_id = $args['klase_id'];
        $timetable->section_id = $args['section_id'];
        $timetable->save();

        return $timetable;
    }
}
