<?php

namespace App\GraphQL\Mutations\Timetable;

final class DeleteTimetableMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = auth()->user();
        $workspace = $user->workspace()->where('slug', $args['workspace'])->first();
        $workspace->timetables()->findOrFail($args['id'])->delete();

    }
}
