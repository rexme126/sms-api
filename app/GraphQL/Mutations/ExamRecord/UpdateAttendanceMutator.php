<?php

namespace App\GraphQL\Mutations\ExamRecord;

use App\Models\ExamRecord;

final class UpdateAttendanceMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $classExamRecords = collect($args['attendances']);
        $klase_id = $args['klase_id'];
        $term_id = $args['term_id'];
        $session_id = $args['session_id'];
        $section_id = $args['section_id'];
        $workspaceId = $args['workspaceId'];

        $checkExamRecord = ExamRecord::where([
            'klase_id' => $klase_id, 'term_id' => $term_id,
            'session_id' => $session_id, 'section_id' => $section_id, 'workspace_id' => $workspaceId
        ])->get();


        if (count($checkExamRecord) > 0) {
            // classExamRecords
            foreach ($classExamRecords as $classExamRecord) {
                $classExamRecordId = $classExamRecord['classAttendanceId'];

                $update = $classExamRecord;
                // return;
                unset($update['classAttendanceId']);


                if (!empty($classExamRecordId)) {
                    $classExamRecordModel = ExamRecord::findOrFail($classExamRecordId);

                    $classExamRecordModel->update($update);
                }
            }

            ExamRecord::where([
                'klase_id' => $klase_id, 'term_id' => $term_id,
                'session_id' => $session_id, 'section_id' => $section_id, 'workspace_id' => $workspaceId
            ])->update([
                'num_total' => $args['num_total']
            ]);

            $classExamRecords = ExamRecord::where([
                'klase_id' => $klase_id, 'term_id' => $term_id,
                'session_id' => $session_id, 'section_id' => $section_id, 'workspace_id' => $workspaceId
            ])->get();

            foreach ($classExamRecords as  $classExamRecord) {
                if (
                    $classExamRecord->num_present == null && $classExamRecord->num_absent == null
                    && $classExamRecord->num_total == null
                ) {
                    continue;
                } else {

                    $classExamRecord->num_absent = $classExamRecord->num_total - $classExamRecord->num_present;
                    $classExamRecord->save();
                }
            }
        }
    }
}
