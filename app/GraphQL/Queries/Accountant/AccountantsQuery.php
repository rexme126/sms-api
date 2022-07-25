<?php

namespace App\GraphQL\Queries\Accountant;

use App\Models\Workspace;

final class AccountantsQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        
        $accountants = $workspace->accountants;
       
        return $accountants;
    }
}
