<?php

namespace App\GraphQL\Queries\Subject;

final class SubjectsQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = auth()->user();
        $workspace = $user->workspace()->where('slug', $args['slug'])->first();
        $subjects = $workspace->subjects;
        return $subjects;
    }
}
