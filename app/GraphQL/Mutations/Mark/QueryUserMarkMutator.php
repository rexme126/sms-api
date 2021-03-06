<?php

namespace App\GraphQL\Mutations\Mark;

use App\Models\Mark;
use App\Models\Student;
use App\Models\ExamRecord;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

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



        $students = Student::where([
            'klase_id' => $klaseId, 'session_id' => $session,
            'section_id' => $section
        ])->get()->pluck('id');

        $currentClass = Student::where(['klase_id' => $klaseId, 'section_id'=> $section])->get()->pluck('klase_id')->take(1);
        $currentSession = Student::where(['klase_id'=> $klaseId, 'section_id'=> $section])->get()->pluck('session_id')->take(1);
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
                    'section_id' => $section
                ]);
                $a->save();

                ExamRecord::updateOrCreate([
                    'klase_id' => $currnetClassId,
                    'student_id' => $student,
                    'session_id' => $currentSessionId,
                    'term_id' => $term,
                    'section_id' => $section
                ]);
            }
        }
    }
}

// foreach ($types as $type) {
//     // if (!IntegrationType::where('platform', $type['platform'])->where('account_type', $type['account_type'])
//     // ->where('platform_type', $type['platform_type'])->exists()) {
//     //     IntegrationType::insert($type);
//     // }
//     $a = IntegrationType::firstOrNew([
//         'platform' => $type['platform'], 
//         'account_type' => $type['account_type'],
//         'platform_type' => $type['platform_type'],
//     ], $type);
//     $a->save();
// }