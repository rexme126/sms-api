<?php

namespace App\GraphQL\Mutations\Timetable;

use App\Models\Workspace;

final class DeleteTimetableMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $workspace->timetables()->findOrFail($args['id'])->delete();

    }
}
