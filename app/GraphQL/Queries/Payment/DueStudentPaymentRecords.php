<?php

namespace App\GraphQL\Queries\Payment;

use App\Models\Workspace;

final class DueStudentPaymentRecords
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $paymentRecords = $workspace->paymentRecords()->where([
            'klase_id' => $args['klase_id'], 'term_id' => $args['term_id'],
            'session_id' => $args['session_id'], 'status' => $args['status'],
            'student_id' => $args['student_id']
        ])->first();

        return $paymentRecords;
    }
}
