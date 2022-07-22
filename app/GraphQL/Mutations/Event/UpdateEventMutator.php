<?php

namespace App\GraphQL\Mutations\Event;

final class UpdateEventMutator
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

        $event->description = $args['description'];
        $event->date = $args['date'];
        $event->save();
        return $event;
    }
}
