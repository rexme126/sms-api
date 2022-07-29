<?php

namespace App\GraphQL\Mutations\ExamTimetable;

use App\Models\Workspace;

final class DeleteExamTimetableMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $workspace->examTimetables()->findOrFail($args['id'])->delete();
    }
}
