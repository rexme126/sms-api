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

       

        $students = Student::where('klase_id', $klaseId)->get()->pluck('id');
        foreach ($students as $student) {
           $a = Mark::firstOrNew([
            'klase_id'=> $klaseId,
            'student_id'=> $student,
            'subject_id' => $subject,
            'session' => $session
             ]);
             $a->save();
            
             ExamRecord::updateOrCreate([
                'klase_id'=> $klaseId,
                'student_id'=> $student,
                'session_id' => $session,
                'term_id' => $term
             ]);
        }

        
    }
}
