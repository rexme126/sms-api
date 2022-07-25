<?php

namespace App\GraphQL\Queries\Notice;

use App\Models\Workspace;

final class NoticesWQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::where('slug', $args['slug'])->first();
        $notices = $workspace->notices;
        return $notices;
    }
}
