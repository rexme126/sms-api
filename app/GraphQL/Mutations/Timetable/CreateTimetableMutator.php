<?php

namespace App\GraphQL\Mutations\Timetable;

use App\Models\Timetable;

final class CreateTimetableMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = auth()->user();
        $workspace = $user->workspace()->where('slug', $args['workspace'])->first();

        $timetable = new Timetable();
        $timetable->user_id = $user->id;
        $timetable->workspace_id = $workspace->id;
        $timetable->monday = $args['monday'];
        $timetable->tuesday = $args['tuesday'];
        $timetable->wednesday = $args['wednesday'];
        $timetable->thursday = $args['thursday'];
        $timetable->friday = $args['friday'];
        $timetable->time = $args['time'];
        $timetable->klase_id = $args['klase_id'];
        $timetable->save();

        return $timetable;
    }
}
