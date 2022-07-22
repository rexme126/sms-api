<?php

namespace App\GraphQL\Mutations\Subject;

final class UpdateSubjectMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = auth()->user();
        $workspace = $user->workspace()->where('slug', $args['workspace'])->first();
        $subject = $workspace->subjects()->findOrFail($args['id']);

        $subject->subject = $args['subject'];

        $subject->save();
        return $subject;

    }
}
