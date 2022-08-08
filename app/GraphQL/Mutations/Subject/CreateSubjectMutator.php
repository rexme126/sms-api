<?php

namespace App\GraphQL\Mutations\Subject;

use App\Models\Subject;
use App\Models\Workspace;

final class CreateSubjectMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);

        $subject = new Subject();
        $subject->workspace_id = $workspace->id;
        $subject->subject = $args['subject'];
        $subject->klase_id = $args['klase_id'];
        $subject->section_id = $args['section_id'];
        $subject->save();

        return $subject;
    }
}
