<?php

namespace App\GraphQL\Mutations\Teacher;

use App\Models\AssignSubjectTeacher as ModelsAssignSubjectTeacher;

final class AssignSubjectTeacher
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $subjectsIds = $args['subjectId'];
        foreach ($subjectsIds as $subjectsId) {
            $a = ModelsAssignSubjectTeacher::firstOrNew([
                'workspace_id' => $args['workspaceId'],
                'klase_id' => $args['klaseId'],
                'section_id' => $args['sectionId'],
                'teacher_id' => $args['teacherId'],
                'subject_id' => $subjectsId,
            ]);
            $a->save();
        }
        return ModelsAssignSubjectTeacher::where([
            'workspace_id' => $args['workspaceId'],
            'klase_id' => $args['klaseId'],
            'section_id' => $args['sectionId'],
        ])->first();
    }
}
