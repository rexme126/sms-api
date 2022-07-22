<?php

namespace App\GraphQL\Queries\Timetable;

final class TimetablesQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = auth()->user();
        $workspace = $user->workspace()->where('slug', $args['slug'])->first();
        $timetables = $workspace->timetables()->where('klase_id', $args['klase_id'])->get();
        return $timetables;
    }
}
