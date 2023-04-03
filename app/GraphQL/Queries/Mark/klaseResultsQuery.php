<?php

namespace App\GraphQL\Queries\Mark;

use App\Models\Workspace;

final class klaseResultsQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        
        $marks = $workspace->marks()->where([
            'klase_id' => $args['klase_id'],
            'term_id' => $args['term_id'], 'session_id' => $args['session_id'],
            'section_id' => $args['section_id']
        ])->get();
        return $marks;
        
    }
}
