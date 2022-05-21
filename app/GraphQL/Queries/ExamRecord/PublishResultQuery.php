<?php

namespace App\GraphQL\Queries\ExamRecord;

use App\Models\ExamRecord;

final class PublishResultQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
         return ExamRecord::where(['klase_id'=>$args['klase_id'], 'term_id'=> $args['term_id'],
                        'status'=>$args['status'],'session_id'=> $args['session_id']])->first();
    }
}
