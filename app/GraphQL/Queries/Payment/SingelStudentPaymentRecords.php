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
        if (!isset($args['term_id']) && !isset($args['session_id'])) {
            $paymentRecords = $workspace->paymentRecords()->where([
                'status' => $args['status'],
                'student_id' => $args['student_id']
            ])->first();
        }else{
            $paymentRecords = $workspace->paymentRecords()->where([
                'term_id' => $args['term_id'],
                'session_id' => $args['session_id'], 'status' => $args['status'],
                'student_id' => $args['student_id']
            ])->first();
        }
       

        return $paymentRecords;
    }
}
