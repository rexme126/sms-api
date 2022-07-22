<?php

namespace App\GraphQL\Queries\Timetable;

final class TimetableQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = auth()->user();
        $workspace = $user->workspace()->where('slug', $args['slug'])->first();
        $timetable = $workspace->timetables()->findOrFail($args['id']);
        return $timetable;
    }
}
