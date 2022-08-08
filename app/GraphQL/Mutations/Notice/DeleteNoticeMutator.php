<?php

namespace App\GraphQL\Mutations\Notice;

use App\Models\Workspace;

final class DeleteNoticeMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $workspace->notices()->findOrFail($args['id'])->delete();
    }
}
