<?php

namespace App\GraphQL\Mutations\Notice;

final class PublishNoticeMutator
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
        $notice->published =  !$notice->published;
        $notice->save();
        return $notice;
    }
}
