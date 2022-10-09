<?php

namespace App\GraphQL\Queries\Admin;

use App\Models\Workspace;

final class SchoolAdminsQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
       
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $schoolAdmins = $workspace->schoolAdmins;
        return $schoolAdmins;
    }
}
