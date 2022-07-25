<?php

namespace App\GraphQL\Queries\Session;

use App\Models\Workspace;

final class SessionQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $session = $workspace->sessions()->findOrFail($args['id']);
        return $session;
    }
}
