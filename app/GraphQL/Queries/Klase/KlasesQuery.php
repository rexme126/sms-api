<?php

namespace App\GraphQL\Queries\Klase;

use App\Models\Workspace;

final class KlasesQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $klases = $workspace->klases;

        return $klases;
    }
}
