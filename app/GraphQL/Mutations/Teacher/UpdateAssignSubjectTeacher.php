<?php

namespace App\GraphQL\Mutations\Teacher;

use App\Models\AssignSubjectTeacher;

final class UpdateAssignSubjectTeacher
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $assigns = AssignSubjectTeacher::findOrFail($args['id']);

        $assigns->teacher_id = $args['teacherId'];
        $assigns->subject_id = $args['subjectId'];

        $assigns->save();

        return $assigns;
    }
}
