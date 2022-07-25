<?php

namespace App\GraphQL\Queries\Guardian;

use App\Models\Workspace;

final class GuardianDashboardQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        info($args['workspaceId']);
        $workspace = Workspace::findOrFail($args['workspaceId']);
        
        $guardians = $workspace->guardians;
       
        return $guardians;
    }
}
