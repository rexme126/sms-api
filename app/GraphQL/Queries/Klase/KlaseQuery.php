<?php

namespace App\GraphQL\Queries\Klase;

final class KlaseQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = auth()->user();
        $workspace = $user->workspace()->where('slug', $args['slug'])->first();
        $klase = $workspace->klases()->findOrFail($args['id']);
        return $klase;
    }
}
