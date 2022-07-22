<?php

namespace App\GraphQL\Mutations\Event;

final class DeleteEventMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = auth()->user();
        $workspace = $user->workspace()->where('slug', $args['workspace'])->first();
        $workspace->events()->findOrFail($args['id'])->delete();
    }
}
