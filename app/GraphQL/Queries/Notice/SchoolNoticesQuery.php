<?php

namespace App\GraphQL\Queries\Notice;

use App\Models\Workspace;

final class SchoolNoticesQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $notices = $workspace->notices()->where('status', true)->orderBy('created_at', 'desc')->get();
        return $notices;
    }
}
