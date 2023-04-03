<?php

namespace App\GraphQL\Mutations\ExamRecord;

use App\Models\ExamRecord;
use App\Models\SetPromotion;
use App\Models\Student;

final class GraduateStudentsMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $set_promotion_mark = SetPromotion::where('workspace_id', $args['workspaceId'])->first();



        $exams =  ExamRecord::where([
            'klase_id' => $args['klase_id'],
            'session_id' => $args['session_id'],
            'term_id' => 3, 'workspace_id' => $args['workspaceId']
        ])->get();

        foreach ($exams as $exam) {
            $exam->status = $exam->status == 'published' ? 'unpublished' : 'published';
            $exam->ps =  $exam->cum_avg >=  $set_promotion_mark->name ? $args['status'] : 'Fail';
            $exam->save();
        }
        if (count($exams) > 0 && $args['status'] == 'graduated') {
            Student::where([
                'klase_id' => $args['klase_id'],
                'session_id' => $args['session_id'],
                'workspace_id' => $args['workspaceId']
            ])->update([
                'status' => 1,
                'klase_id' => null
            ]);
        } else if (count($exams) > 0 && $args['status'] != 'graduated') {
            Student::where([
                'klase_id' => null,
                'session_id' => $args['session_id'],
                'workspace_id' => $args['workspaceId']
            ])->update([
                'status' => 1,
                'klase_id' => $args['klase_id']
            ]);
        }
        return $exams;
    }
}
