<?php

namespace App\GraphQL\Queries\Admin;

use App\Models\Workspace;

final class SchoolAdminQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $schoolAdmin = $workspace->schoolAdmins()->find($args['id']);

        return $schoolAdmin;
    }
}
