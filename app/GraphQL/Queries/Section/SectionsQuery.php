<?php

namespace App\GraphQL\Queries\Section;

final class SectionsQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = auth()->user();
        $workspace = $user->workspace()->where('slug', $args['slug'])->first();
        $sections = $workspace->sections;
        return $sections;
    }
}
