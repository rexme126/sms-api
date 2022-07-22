<?php

namespace App\GraphQL\Mutations\Subject;

use App\Models\Subject;

final class CreateSubjectMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = auth()->user();
        $workspace = $user->workspace()->where('slug', $args['workspace'])->first();

        $subject = new Subject();
        $subject->user_id = $user->id;
        $subject->workspace_id = $workspace->id;
        $subject->subject = $args['subject'];
        $subject->save();

        return $subject;
    }
}
