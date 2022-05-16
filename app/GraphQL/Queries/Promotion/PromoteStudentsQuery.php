<?php

namespace App\GraphQL\Queries\Promotion;

use App\Models\Student;

final class PromoteStudentsQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return Student::where(['klase_id'=>$args['klase_id'],
                        'status'=>$args['status'],'session_id'=> $args['session_id']])->get();
    }
}
