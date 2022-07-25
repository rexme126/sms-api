<?php

namespace App\GraphQL\Mutations\Event;

use App\Models\Workspace;

final class PublishEventMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::where('slug', $args['workspace'])->first();
        $event = $workspace->events()->findOrFail($args['id']);
        $event->published =  !$event->published;
        $event->save();
        return $event;
    }
}
