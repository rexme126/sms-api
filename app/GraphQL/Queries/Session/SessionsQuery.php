<?php

namespace App\GraphQL\Queries\Session;

use App\Models\Workspace;

final class SessionsQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $sessions = $workspace->sessions;
        return $sessions;
    }
}
