<?php

namespace App\GraphQL\Queries\Session;

final class SessionwQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        
    }$user = auth()->user();
        $workspace = $user->workspace()->where('slug', $args['slug'])->first();
        $session = $workspace->sessions()->findOrFail($args['id']);
        return $session;
}
