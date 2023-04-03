<?php

namespace App\GraphQL\Mutations\Session;

use App\Models\Session;
use Illuminate\Database\QueryException;

final class DeleteSessionMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        try {
            Session::find($args['id'])->delete();
            return;
        } catch (QueryException $e) {
            return;
        }
    }
}
