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
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $event = $workspace->events()->findOrFail($args['id']);
        $event->status =  !$event->status;
        $event->save();
        
        return $event;
    }
}
