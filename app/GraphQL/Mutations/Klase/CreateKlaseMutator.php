<?php

namespace App\GraphQL\Mutations\Klase;

use App\Models\Klase;
use App\Models\Workspace;

final class CreateKlaseMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);

        $klase = new Klase;
        $klase->workspace_id = $workspace->id;
        $klase->name = $args['name'];
        $klase->save();

        return $klase;
    }
}
