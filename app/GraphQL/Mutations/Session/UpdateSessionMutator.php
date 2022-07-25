<?php

namespace App\GraphQL\Mutations\Session;

use App\Models\Workspace;

final class UpdateSessionMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $session = $workspace->sessions()->findOrFail($args['id']);

        $session->name = $args['name'];

        $session->save();
        return $session;
    }
}
