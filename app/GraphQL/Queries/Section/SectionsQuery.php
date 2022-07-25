<?php

namespace App\GraphQL\Queries\Section;

use App\Models\Workspace;

final class SectionsQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $sections = $workspace->sections;
        return $sections;
    }
}
