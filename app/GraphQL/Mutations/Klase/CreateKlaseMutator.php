<?php

namespace App\GraphQL\Mutations\Klase;

use App\Models\Klase;

final class CreateKlaseMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = auth()->user();
        $workspace = $user->workspace()->where('slug', $args['workspace'])->first();

        $klase = new Klase;
        $klase->user_id = $user->id;
        $klase->workspace_id = $workspace->id;
        $klase->name = $args['name'];
        $klase->save();

        return $klase;
    }
}
