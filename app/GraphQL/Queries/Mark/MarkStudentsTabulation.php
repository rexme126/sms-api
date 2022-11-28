<?php

namespace App\GraphQL\Queries\Mark;

use App\Models\Workspace;
use App\Repositories\Setup;

final class MarkStudentsTabulation
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    protected $setup;
    public function __construct(Setup $setup)
    {
        $this->setup = $setup;
    }
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);

        $marks = $workspace->marks()->where([
            'klase_id' => $args['klase_id'],
            'term_id' => $args['term_id'], 'session_id' => $args['session_id'],
            'section_id' => $args['section_id']
        ])->get()->pluck('student_id')->unique()->values();

        $students = $this->setup->getStudentsByIds($marks);

        return $students;
    }
}
