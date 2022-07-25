<?php

namespace App\GraphQL\Queries\Libarian;

use App\Models\Workspace;

final class LibarianQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $libarian = $workspace->libarians()->find($args['id']);

        return $libarian;
    }
}
