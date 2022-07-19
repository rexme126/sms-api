<?php

namespace App\GraphQL\Queries\ExamRecord;

use App\Models\ExamRecord;

final class klaseResultsQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return ExamRecord::where([
            'klase_id' => $args['klase_id'],
            'term_id' => $args['term_id'], 'session_id' => $args['session_id'],
            'section_id' => $args['section_id']
        ])->get();
    }
}
