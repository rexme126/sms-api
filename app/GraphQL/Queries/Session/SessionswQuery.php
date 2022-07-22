<?php

namespace App\GraphQL\Queries\Session;

final class SessionswQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = auth()->user();
        $workspace = $user->workspace()->where('slug', $args['slug'])->first();
        $sessions = $workspace->sessions;
        return $sessions;
    }
}
