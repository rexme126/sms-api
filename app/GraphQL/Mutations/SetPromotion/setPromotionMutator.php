<?php

namespace App\GraphQL\Mutations\SetPromotion;

use App\Models\Workspace;

final class setPromotionMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
       $workspace= Workspace::findOrFail($args['workspaceId']);
       $setPromotion= $workspace->setPromotions()->where('workspace_id',$args['workspaceId'])->first();
       $setPromotion->name = $args['name'];
       $setPromotion->workspace_id = $args['workspaceId'];
       $setPromotion->save();

       return $setPromotion;
    }
}
