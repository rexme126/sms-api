<?php

namespace App\GraphQL\Mutations\Payment;

use App\Models\PaymentRecord;
use App\Models\Payment;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class UpdatePaymentMutator
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
        $amount= $args['amount'];

        $payment= Payment::findorFail($id);
        $payment->amount = $amount;
        $payment->save();

        $paymentRecords = PaymentRecord::where('payment_id',$payment->id)->update([
            'amount'=> $amount
        ]);
        return Payment::where('id',$id)->first();
    }
}
