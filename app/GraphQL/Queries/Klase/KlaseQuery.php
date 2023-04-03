<?php

namespace App\GraphQL\Queries\Klase;

use App\Models\Workspace;

final class KlaseQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $klase = $workspace->klases()->findOrFail($args['id']);
        
        return $klase;
    }
}
