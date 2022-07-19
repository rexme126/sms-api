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
        return Student::where([
            'klase_id' => $args['klase_id'], 'promotion_term_id' => 3,
            'status' => $args['status'], 'session_id' => $args['session_id'],
            'section_id' => $args['section_id']
        ])->get();
    }
}
