<?php

namespace App\GraphQL\Mutations\Notice;

use App\Models\Workspace;

final class BulkDeleteNoticesMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
      
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $notices = $workspace->notices()->whereIn('id', $args['ids'])->delete();

        return $notices;
    }
}
