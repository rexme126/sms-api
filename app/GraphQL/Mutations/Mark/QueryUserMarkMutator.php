<?php

namespace App\GraphQL\Mutations\Mark;

use App\Models\Mark;
use App\Models\Student;
use App\Models\ExamRecord;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use App\Models\IntegrationType;

final class QueryUserMarkMutator
{
    /**
     * Return a value for the field.
     *
     * @param  @param  null  $root Always null, since this field has no parent.
     * @param  array{}  $args The field arguments passed by the client.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Shared between all fields.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Metadata for advanced query resolution.
     * @return mixed
     */
    public function __invoke($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $klaseId = $args['klase'];
        $subject = $args['subject'];
        $term = $args['term'];
        $session = $args['session'];
        $section = $args['section'];
        $workspaceId = $args['workspaceId'];



        $students = Student::where([
            'klase_id' => $klaseId, 'session_id' => $session,
            'section_id' => $section, 'workspace_id' => $workspaceId
        ])->get()->pluck('id');


        $currentClass = Student::where([
            'klase_id' => $klaseId, 'section_id' => $section,
            'workspace_id' => $workspaceId
        ])->get()->pluck('klase_id')->take(1);


        $currentSession = Student::where([
            'klase_id' => $klaseId, 'section_id' => $section,
            'workspace_id' => $workspaceId
        ])->get()->pluck('session_id')->take(1);

        if (count($currentClass) == 0) {
            return;
        }
        if (count($currentSession) == 0) {
            return;
        }

        $currnetClassId = $currentClass[0];


        $currentSessionId = $currentSession[0];
        if (count($students) == 0) {
            return;
        } else {
            foreach ($students as $student) {
                // get student class
                $a = Mark::firstOrNew([
                    'klase_id' => $currnetClassId,
                    'student_id' => $student,
                    'subject_id' => $subject,
                    'session_id' => $currentSessionId,
                    'term_id' => $term,
                    'section_id' => $section,
                    'workspace_id' => $workspaceId
                ]);
                $a->save();

                ExamRecord::updateOrCreate([
                    'klase_id' => $currnetClassId,
                    'student_id' => $student,
                    'session_id' => $currentSessionId,
                    'term_id' => $term,
                    'section_id' => $section,
                    'workspace_id' => $workspaceId
                ]);
            }
        }
    }
}
