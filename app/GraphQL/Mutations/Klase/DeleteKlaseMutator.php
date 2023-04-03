<?php

namespace App\GraphQL\Mutations\Klase;

use App\Models\Klase;
use Illuminate\Database\QueryException;

final class DeleteKlaseMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        try {
            Klase::find($args['id'])->delete();
            return;
        } catch (QueryException $e) {
            return;
        }
    }
}
