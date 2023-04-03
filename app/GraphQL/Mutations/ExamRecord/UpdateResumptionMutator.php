<?php

namespace App\GraphQL\Mutations\ExamRecord;

use App\Models\ExamRecord;

final class UpdateResumptionMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        ExamRecord::where([
            'term_id' => $args['term_id'], 'session_id' => $args['session_id'],
            'workspace_id' => $args['workspaceId']
        ])->update([
            'term_start'=>  $args['term_start'],
            'term_end'=>  $args['term_end'],
        ]);

       return ExamRecord::where([
            'term_id' => $args['term_id'], 'session_id' => $args['session_id'],
            'workspace_id' => $args['workspaceId']
        ])->get();
    }
}
