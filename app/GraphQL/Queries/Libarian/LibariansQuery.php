<?php

namespace App\GraphQL\Queries\Libarian;

use App\Models\Workspace;

final class LibariansQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        
        $libarians = $workspace->libarians;
       
        return $libarians;
    }
}
