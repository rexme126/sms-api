<?php

namespace App\GraphQL\Queries\Mark;

use App\Models\Mark;

final class StudentExamResultQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
       return Mark::where(['klase_id'=>$args['klase_id'],'student_id'=> $args['student_id'],
                        'term_id'=>$args['term_id'],'session_id'=> $args['session_id']])->get();
    }
}
