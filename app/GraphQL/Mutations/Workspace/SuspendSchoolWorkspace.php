<?php

namespace App\GraphQL\Mutations\Workspace;

use App\Models\Workspace;

final class SuspendSchoolWorkspace
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);

        $workspace->status = $args['status'];

        $workspace->save();

        return $workspace;
    }
}
