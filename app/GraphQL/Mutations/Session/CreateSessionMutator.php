<?php

namespace App\GraphQL\Mutations\Session;

use App\Models\Session;
use App\Models\Workspace;

final class CreateSessionMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {

        $workspace = Workspace::findOrFail($args['workspaceId']);

        $session = new Session;
        $session->workspace_id = $workspace->id;
        $session->name = $args['name'];
        $session->save();

        return $session;
    }
}
