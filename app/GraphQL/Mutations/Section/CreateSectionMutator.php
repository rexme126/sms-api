<?php

namespace App\GraphQL\Mutations\Section;

use App\Models\Section;
use App\Models\Workspace;

final class CreateSectionMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);

        $section = new Section();
        $section->workspace_id = $workspace->id;
        $section->name = $args['name'];
        $section->klase_id = $args['klase_id'];
        $section->save();

        return $section;
    }
}
