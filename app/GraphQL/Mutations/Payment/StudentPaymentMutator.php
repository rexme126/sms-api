<?php

namespace App\GraphQL\Mutations\Payment;

use App\Models\PaymentRecord;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class StudentPaymentMutator
{
    /**
     * Return a value for the field.
     *
     * @param  @param  null  $root Always null, since this field has no parent.
     * @param  array{}  $args The field arguments passed by the client.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Shared between all fields.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Metadata for advanced query resolution.
     * @return mixed
     */
    public function __invoke($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $student_id = $args['student_id'];
        $term_id = $args['term_id'];
        $session_id = $args['session_id'];
        $amtPaid= $args['amt_paid']/100;
        info($amtPaid);

        
        $paymentRecord = PaymentRecord::where(['student_id'=>$student_id,'term_id'=>$term_id,
        'session_id'=>$session_id])->first();
        info($paymentRecord);
        if($paymentRecord->amt_paid == 0){
            $paymentRecord->amt_paid = $amtPaid;
            $paymentRecord->receipt= \mt_rand(1,999999999);
            $paymentRecord->save();

            $pRecord =  PaymentRecord::where(['student_id'=>$student_id,'term_id'=>$term_id,
                        'session_id'=>$session_id])->first();

            if($amtPaid != $paymentRecord->amount){
                $balance= $pRecord->amount - $amtPaid;
                $pRecord->balance = $balance;
                $pRecord->save(); 
                return PaymentRecord::where(['student_id'=>$student_id,' term_id'=>$term_id,
                'session_id'=>$session_id])->first();
            }else {
                $balance= $pRecord->amount - $amtPaid;
                $pRecord->balance =$balance;
                $pRecord->status = 'Paid';
                $pRecord->save(); 
                return PaymentRecord::where(['student_id'=>$student_id,'term_id'=>$term_id,
                'session_id'=>$session_id])->first();
            }
        }elseif ($paymentRecord->amt_paid != $paymentRecord->amount  ) {
            $oldAmt_paid = $paymentRecord->amt_paid + $amtPaid;
        

            if($paymentRecord->amount == $oldAmt_paid){
                $pRecord =  PaymentRecord::where(['student_id'=>$student_id,'term_id'=>$term_id,
                    'session_id'=>$session_id])->first();

                $pRecord->amt_paid =  $oldAmt_paid;
                $pRecord->balance= $pRecord->amount -  $oldAmt_paid;
                $pRecord->status = 'Paid';
                $pRecord->receipt= \mt_rand(1,999999999);
                $pRecord->save(); 
                return PaymentRecord::where(['student_id'=>$student_id,'
                term_id'=>$term_id,'session_id'=>$session_id])->first();
            }else {
                $pRecord =  PaymentRecord::where(['student_id'=>$student_id,'term_id'=>$term_id,
                    'session_id'=>$session_id])->first();
                $pRecord->amt_paid =  $oldAmt_paid;
                $pRecord->balance= $pRecord->amount -  $oldAmt_paid;
                $pRecord->receipt= \mt_rand(1,999999999);
                $pRecord->save();
                return PaymentRecord::where(['student_id'=>$student_id,'term_id'=>$term_id,
                'session_id'=>$session_id])->first();
            }

                return PaymentRecord::where(['student_id'=>$student_id,'term_id'=>$term_id,
                'session_id'=>$session_id])->first();

        }else{
            return;
        }
    }
}
