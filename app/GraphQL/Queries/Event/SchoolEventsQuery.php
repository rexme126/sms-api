<?php

namespace App\GraphQL\Queries\Event;

use App\Models\Workspace;

final class SchoolEventsQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $events = $workspace->events()->where('status', true)->orderBy('created_at', 'desc')->get();
        return $events;
    }
}
