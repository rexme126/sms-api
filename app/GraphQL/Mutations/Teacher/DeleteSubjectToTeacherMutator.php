<?php

namespace App\GraphQL\Mutations\Teacher;

use App\Models\AssignSubjectTeacher;

final class DeleteSubjectToTeacherMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return AssignSubjectTeacher::find($args['id'])->delete();
        
    }
}
