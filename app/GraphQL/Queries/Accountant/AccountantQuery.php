<?php

namespace App\GraphQL\Queries\Accountant;

use App\Models\Workspace;

final class AccountantQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $accountant = $workspace->accountants()->find($args['id']);

        return $accountant;
    }
}
