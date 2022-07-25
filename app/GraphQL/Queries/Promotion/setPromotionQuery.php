<?php

namespace App\GraphQL\Queries\Promotion;

use App\Models\Workspace;

final class setPromotionQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);

        $setPromotion = $workspace->setPromotions()->where('workspace_id', $args['workspaceId'])->first();

        return $setPromotion;
    }
}
