<?php

namespace App\GraphQL\Queries\Section;

final class SectionQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = auth()->user();
        $workspace = $user->workspace()->where('slug', $args['slug'])->first();
        $section = $workspace->sections()->findOrFail($args['id']);
        return $section;
    }
}
