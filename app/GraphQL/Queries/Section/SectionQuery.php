<?php

namespace App\GraphQL\Queries\Section;

use App\Models\Workspace;

final class SectionQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $section = $workspace->sections()->findOrFail($args['id']);
        return $section;
    }
}
