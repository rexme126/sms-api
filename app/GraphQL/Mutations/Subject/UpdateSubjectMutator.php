<?php

namespace App\GraphQL\Mutations\Subject;

use App\Models\Workspace;

final class UpdateSubjectMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $subject = $workspace->subjects()->findOrFail($args['id']);

        $subject->subject = $args['subject'];
        $subject->subject_code = $args['subject_code'];

        $subject->save();
        return $subject;

    }
}
