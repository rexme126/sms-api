<?php

namespace App\GraphQL\Mutations\Section;

use App\Models\Workspace;

final class UpdateSectionMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $section = $workspace->sections()->findOrFail($args['id']);

        $section->name = $args['name'];

        $section->save();
        return $section;
    }
}
