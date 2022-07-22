<?php

namespace App\GraphQL\Queries\Notice;

final class NoticesWQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = auth()->user();
        $workspace = $user->workspace()->where('slug', $args['slug'])->first();
        $notices = $workspace->notices;
        return $notices;
    }
}
