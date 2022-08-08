<?php

namespace App\GraphQL\Mutations\Event;

use App\Models\Workspace;

final class DeleteEventMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $workspace->events()->findOrFail($args['id'])->delete();
    }
}
