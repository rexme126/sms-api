<?php

namespace App\GraphQL\Queries\Payment;

use App\Models\Workspace;

final class PaymentQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $payment = $workspace->payments()->findOrFail($args['id']);

        return $payment;
    }
}
