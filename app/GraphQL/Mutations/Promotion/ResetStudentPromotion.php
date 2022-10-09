<?php

namespace App\GraphQL\Mutations\Promotion;

use App\Models\ExamRecord;
use App\Models\Promotion;
use App\Models\Student;

final class ResetStudentPromotion
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $classFromId = $args['from_class'];
        $sessionFromId = $args['from_session'];
        $workspaceId = $args['workspaceId'];

        $promotion = Promotion::where([
            'id' => $args['promotion_id'], 'workspace_id' => $workspaceId
        ])->first();

        ExamRecord::where([
            'klase_id' =>  $classFromId, 'term_id' => 3, 'session_id' => $sessionFromId,
            'workspace_id' => $workspaceId, 'student_id' => $promotion->student_id
        ])->update([
            'promoted_to' => null,
            'status' => 'unpublished'
        ]);


        Student::where(['id' => $promotion->student_id, 'status' => false,  'workspace_id' => $workspaceId])
            ->update([
                'klase_id' => $classFromId,
                'session_id' => $sessionFromId,
                'status' => true,
                'cum_avg' => $promotion->cum_avg,
                'promotion_term_id' => 3,
                'workspace_id' => $workspaceId
            ]);


        Promotion::where([
            'id' => $args['promotion_id'], 'workspace_id' => $workspaceId
        ])->delete();
    }
}
