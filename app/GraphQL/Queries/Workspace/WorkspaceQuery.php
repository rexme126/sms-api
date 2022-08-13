<?php

namespace App\GraphQL\Queries\Workspace;

use App\Models\Workspace;

final class WorkspaceQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return Workspace::where(['id' => $args['workspaceId'], 'status' => $args['status']])->first();
    }
}
