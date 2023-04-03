<?php

namespace App\GraphQL\Mutations\Section;

use App\Models\Section;
use Illuminate\Database\QueryException;

final class DeleteSectionMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        try {
            Section::find($args['id'])->delete();
            return;
        } catch (QueryException $e) {
            return;
        }
    }
}
