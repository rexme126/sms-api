<?php

namespace App\GraphQL\Queries\Promotion;

use App\Models\Workspace;

final class ResetKlaseQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);

        $promotionKlase = $workspace->klases()->findOrFail($args['id']);

        return $promotionKlase;
    }
}
