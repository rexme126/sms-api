<?php

namespace App\GraphQL\Mutations\Klase;

use App\Models\Workspace;

final class UpdateKlaseMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $klase = $workspace->klases()->findOrFail($args['id']);

        $klase->name = $args['name'];

        $klase->save();
        return $klase;
    }
}
