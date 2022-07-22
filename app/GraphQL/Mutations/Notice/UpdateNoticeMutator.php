<?php

namespace App\GraphQL\Mutations\Notice;

final class UpdateNoticeMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = auth()->user();
        $workspace = $user->workspace()->where('slug', $args['workspace'])->first();
        $notice = $workspace->notices()->findOrFail($args['id']);

        $notice->description = $args['description'];
        $notice->date = $args['date'];
        $notice->save();
        return $notice;
    }
}
