<?php

namespace App\GraphQL\Queries\Timetable;

use App\Models\Workspace;

final class TimetablesQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $timetables = $workspace->timetables()->where('klase_id', $args['klase_id'])->get();
        return $timetables;
    }
}
