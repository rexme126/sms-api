<?php

namespace App\GraphQL\Queries\Workspace;

use App\Models\Workspace;

final class WorkspacesQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return Workspace::where('email', '!=' ,'tojufutughe@gmail.com')->get();
    }
}
