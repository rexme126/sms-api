<?php

namespace App\GraphQL\Mutations\Event;

use App\Models\Workspace;

final class BulkDeleteEventMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $events = $workspace->events()->whereIn('id', $args['ids'])->delete();

        return $events;
    }
}
