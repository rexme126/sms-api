<?php

namespace App\GraphQL\Mutations\ExamRecord;

use App\Models\Mark;
use App\Models\ExamRecord;

final class PublishResultMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $term_id = $args['term_id'];
        $session_id = $args['session_id'];
        $section_id = $args['section_id'];
        $klase_id = $args['klase_id'];
        $status = $args['status'];
        $workspaceId = $args['workspaceId'];

        $examPublished = ExamRecord::where([
            'klase_id' => $klase_id, 'term_id' => $term_id, 'session_id' => $session_id,
            'section_id' => $section_id, 'workspace_id' => $workspaceId
        ])->get();

        if (count($examPublished) === 0) {
            return;
        } else {

            ExamRecord::where([
                'klase_id' => $klase_id, 'term_id' => $term_id, 'session_id' => $session_id,
                'section_id' => $section_id, 'workspace_id' => $workspaceId
            ])
                ->update([
                    'status' => $status
                ]);
            Mark::where([
                'klase_id' => $klase_id, 'term_id' => $term_id, 'session_id' => $session_id,
                'section_id' => $section_id, 'workspace_id' => $workspaceId
            ])
                ->update([
                    'status' => $status
                ]);
            return  ExamRecord::where([
                'klase_id' => $klase_id, 'term_id' => $term_id,
                'session_id' => $session_id, 'section_id' => $section_id, 'workspace_id' => $workspaceId
            ])->first();
        }
    }
}
