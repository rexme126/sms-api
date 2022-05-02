<?php

namespace App\GraphQL\Mutations\Klase;

final class DeleteKlaseMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $klaseId= $args['id'];
        $klase = Klase::where('id', $klaseId)->first();
        
    }
}
