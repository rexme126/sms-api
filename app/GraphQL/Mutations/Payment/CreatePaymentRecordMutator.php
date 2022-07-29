<?php

namespace App\GraphQL\Mutations\Payment;

use App\Models\PaymentRecord;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class CreatePaymentRecordMutator
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
        $id = $args['id'];
        $amtPaid =$args['amt_paid'];
        $workspaceId = $args['workspaceId'];

        $paymentRecord = PaymentRecord::findOrfail($id);
        if($paymentRecord->amt_paid == 0){
            $paymentRecord->amt_paid = $amtPaid;
            $paymentRecord->receipt= \mt_rand(1,999999999);
            $paymentRecord->workspace_id = $workspaceId;
            $paymentRecord->save();

            $pRecord =  PaymentRecord::findOrfail($id);

            if($amtPaid != $paymentRecord->amount){
                $balance= $pRecord->amount - $amtPaid;
                $pRecord->balance = $balance;
                $paymentRecord->workspace_id = $workspaceId;
                $pRecord->save(); 
                return PaymentRecord::where('id',$id)->first();
            }else {
                $balance= $pRecord->amount - $amtPaid;
                $pRecord->balance =$balance;
                $pRecord->status = 'Paid';
                $paymentRecord->workspace_id = $workspaceId;
                $pRecord->save(); 
                return PaymentRecord::where('id',$id)->first();
            }
        }elseif ($paymentRecord->amt_paid != $paymentRecord->amount  ) {
                $oldAmt_paid = $paymentRecord->amt_paid + $amtPaid;
            

                if($paymentRecord->amount == $oldAmt_paid){
                    $pRecord =  PaymentRecord::findOrfail($id);
                    $pRecord->amt_paid =  $oldAmt_paid;
                    $pRecord->balance= $pRecord->amount -  $oldAmt_paid;
                    $pRecord->status = 'Paid';
                    $pRecord->receipt= \mt_rand(1,999999999);
                    $paymentRecord->workspace_id = $workspaceId;
                    $pRecord->save(); 
                    return PaymentRecord::where('id',$id)->first();
                }else {
                    $pRecord =  PaymentRecord::findOrfail($id);
                    $pRecord->amt_paid =  $oldAmt_paid;
                    $pRecord->balance= $pRecord->amount -  $oldAmt_paid;
                    $pRecord->receipt= \mt_rand(1,999999999);
                    $paymentRecord->workspace_id = $workspaceId;
                    $pRecord->save();
                    return PaymentRecord::where('id',$id)->first(); 
                }

                return PaymentRecord::where('id',$id)->first();

        }else{
            return;
        }
      
    }
}
