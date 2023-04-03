<?php

namespace App\GraphQL\Queries\Payment;

use App\Models\Workspace;

final class SingelStudentPaymentRecord
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        if (isset($args['student_id']) && !isset($args['klase_id'])) {
            $paymentRecords = $workspace->paymentRecords()->where([
                'term_id' => $args['term_id'],
                'session_id' => $args['session_id'], 'status' => $args['status'],
                'status' => $args['status'],
                'student_id' => $args['student_id']
            ])->first();
        } else if (!isset($args['student_id']) && isset($args['klase_id'])) {
            $paymentRecords = $workspace->paymentRecords()->where([
                'term_id' => $args['term_id'],
                'session_id' => $args['session_id'], 'status' => $args['status'],
                'klase_id' => $args['klase_id']
            ])->first();
        } else {
            $paymentRecords = $workspace->paymentRecords()->where([
                'term_id' => $args['term_id'],
                'session_id' => $args['session_id'], 'status' => $args['status'],
                'klase_id' => $args['klase_id'],
                'student_id' => $args['student_id']
            ])->first();
        }

        return $paymentRecords;
    }
}
