<?php

namespace App\GraphQL\Queries\Payment;

use App\Models\Workspace;

final class SingelStudentPaymentRecords
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);

        $paymentRecords = $workspace->paymentRecords()->where([
            'status' => $args['status'],
            'student_id' => $args['student_id']
        ])->get();


        return $paymentRecords;
    }
}
