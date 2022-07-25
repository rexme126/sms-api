<?php

namespace App\GraphQL\Queries\Event;

use App\Models\Workspace;

final class EventsQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::where('slug', $args['slug'])->first();
        $events = $workspace->events;
        return $events;
    }
}