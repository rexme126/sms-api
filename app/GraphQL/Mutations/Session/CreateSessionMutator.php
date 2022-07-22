<?php

namespace App\GraphQL\Mutations\Session;

use App\Models\Session;

final class CreateSessionMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {

        $user = auth()->user();
        $workspace = $user->workspace()->where('slug', $args['workspace'])->first();

        $session = new Session;
        $session->user_id = $user->id;
        $session->workspace_id = $workspace->id;
        $session->name = $args['name'];
        $session->save();

        return $session;
    }
}
