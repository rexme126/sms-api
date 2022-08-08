<?php

namespace App\GraphQL\Mutations\Notice;

use App\Models\Workspace;

final class UpdateNoticeMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $notice = $workspace->notices()->findOrFail($args['id']);

        $notice->description = $args['description'];
        $notice->date = $args['date'];
        $notice->save();
        return $notice;
    }
}
