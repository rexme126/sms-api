<?php

namespace App\GraphQL\Mutations\ExamRecord;

use App\Models\ExamRecord;

final class PTResultCommentMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {

        $workspaceId = $args['workspace_id'];

        $examRecord = ExamRecord::where([
            'id' => $args['id'], 'workspace_id' => $workspaceId
        ])->first();

        $examRecord->p_comment = $args['p_comment'];
        $examRecord->t_comment = $args['t_comment'];
        $examRecord->save();

        return $examRecord;
    }
}
