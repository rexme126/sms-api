<?php

namespace App\GraphQL\Mutations\Event;

final class PublishEventMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = auth()->user();
        $workspace = $user->workspace()->where('slug', $args['workspace'])->first();
        $event = $workspace->events()->findOrFail($args['id']);
        $event->published =  !$event->published;
        $event->save();
        return $event;
    }
}
