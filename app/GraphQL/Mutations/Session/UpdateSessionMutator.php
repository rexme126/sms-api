<?php

namespace App\GraphQL\Mutations\Session;

final class UpdateSessionMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = auth()->user();
        $workspace = $user->workspace()->where('slug', $args['workspace'])->first();
        $session = $workspace->sessions()->findOrFail($args['id']);

        $session->name = $args['name'];

        $session->save();
        return $session;
    }
}
