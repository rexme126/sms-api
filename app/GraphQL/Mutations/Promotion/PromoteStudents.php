<?php

namespace App\GraphQL\Mutations\Promotion;

use App\Models\Student;
use App\Models\Promotion;
use App\Models\SetPromotion;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class PromoteStudents
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
        $klase_id = $args['klase_id'];
        $klaseTo = $args['klaseTo'];
        $session_id = $args['session_id'];
        $sessionTo = $args['sessionTo'];
        $from_term = $args['from_term'];
        $section_id = $args['section_id'];
        $workspaceId = $args['workspaceId'];

        $setPromotion = SetPromotion::where('workspace_id', $workspaceId)->first();
        $students = Student::where([
            'workspace_id' => $workspaceId, 'klase_id' => $klase_id,
            'session_id' => $session_id,
            'status' => true
        ])->where('cum_avg', '>=', $setPromotion->name)->get();


        foreach ($students as $student) {
            Promotion::updateOrCreate([
                'student_id' => $student->id,
                'from_class' => $klase_id,
                'to_class' => $klaseTo,
                'from_session' => $session_id,
                'to_session' => $sessionTo,
                'status' => true,
                'section_id' => $section_id,
                'cum_avg' => $student->cum_avg,
                'from_term' => $from_term,
                'workspace_id' => $workspaceId
            ]);

            Student::where([
                'id' => $student->id, 'klase_id' => $klase_id, 'session_id' => $session_id,
                'status' => true,
                'workspace_id' => $workspaceId
            ])->update([
                'klase_id' => $klaseTo,
                'session_id' => $sessionTo,
                'status' => false,
                'cum_avg' => null,
                'promotion_term_id' => 0,
                'workspace_id' => $workspaceId
            ]);
        }
        return Student::where([
            'workspace_id' => $workspaceId, 'klase_id' => $klase_id,
            'status' => true
        ])->get();
    }
}
