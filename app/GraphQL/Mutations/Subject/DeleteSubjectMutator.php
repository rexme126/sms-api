<?php

namespace App\GraphQL\Mutations\Subject;

use App\Models\Subject;
use Illuminate\Database\QueryException;

final class DeleteSubjectMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        try {
            Subject::find($args['id'])->delete();
            return;
        } catch (QueryException $e) {
            return;
        }
    }
}
