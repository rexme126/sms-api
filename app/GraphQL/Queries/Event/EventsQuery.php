<?php

namespace App\GraphQL\Queries\Event;

final class EventsQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = auth()->user();
        $workspace = $user->workspace()->where('slug', $args['slug'])->first();
        $events = $workspace->events;
        return $events;
    }
}
