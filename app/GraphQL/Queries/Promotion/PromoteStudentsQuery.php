<?php

namespace App\GraphQL\Queries\Promotion;

use App\Models\Student;
use App\Models\Workspace;

final class PromoteStudentsQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);

        $promotions = $workspace->students()->where([
            'klase_id' => $args['klase_id'], 'promotion_term_id' => 3,
            'status' => $args['status'], 'session_id' => $args['session_id']
        ])->get();

        return $promotions;
    }
}
