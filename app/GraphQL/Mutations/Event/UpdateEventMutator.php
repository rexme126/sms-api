<?php

namespace App\GraphQL\Mutations\Event;

use App\Models\Workspace;

final class UpdateEventMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::where('slug', $args['workspace'])->first();
        $event = $workspace->events()->findOrFail($args['id']);

        $event->description = $args['description'];
        $event->date = $args['date'];
        $event->save();
        return $event;
    }
}
