<?php

namespace App\GraphQL\Queries\Notice;

final class NoticesQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = auth()->user();
        $workspace= $user->workspace()->where('slug','defaultworkspace')->first();
        $notices = $workspace->notices;
        return $notices;
    }
}
