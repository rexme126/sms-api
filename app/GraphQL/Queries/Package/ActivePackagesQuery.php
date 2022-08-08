<?php

namespace App\GraphQL\Queries\Package;

use App\Models\Package;
use App\Models\Workspace;

final class ActivePackagesQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        
        $activePackages = Package::where('payment_method',true)->get();
        return $activePackages;
    }
}
