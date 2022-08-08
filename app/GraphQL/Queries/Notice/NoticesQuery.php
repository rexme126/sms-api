<?php

namespace App\GraphQL\Queries\Notice;

use App\Models\Workspace;

final class NoticesQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $notices = $workspace->notices;
        return $notices;
    }
}
