<?php

namespace App\GraphQL\Mutations\Notice;

final class DeleteNoticeMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = auth()->user();
        $workspace = $user->workspace()->where('slug', $args['workspace'])->first();
        $workspace->notices()->findOrFail($args['id'])->delete();
    }
}
