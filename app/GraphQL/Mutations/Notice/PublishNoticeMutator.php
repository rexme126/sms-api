<?php

namespace App\GraphQL\Mutations\Notice;

use App\Models\Workspace;

final class PublishNoticeMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::where('slug', $args['workspace'])->first();
        $notice = $workspace->notices()->findOrFail($args['id']);
        $notice->published =  !$notice->published;
        $notice->save();
        return $notice;
    }
}
