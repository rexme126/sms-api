<?php

namespace App\GraphQL\Queries\Klase;

final class KlasesQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = auth()->user();
        $workspace = $user->workspace()->where('slug', $args['slug'])->first();
        $klases = $workspace->klases;

        return $klases;
    }
}
