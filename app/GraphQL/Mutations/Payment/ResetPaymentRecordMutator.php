<?php

namespace App\GraphQL\Mutations\Payment;

use App\Models\PaymentRecord;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class ResetPaymentRecordMutator
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

        $resetP = PaymentRecord::findOrfail($id);
        $resetP->amt_paid = 0;
        $resetP->balance = $resetP->amount;
        $resetP->receipt = null;
        $resetP->save();
        return PaymentRecord::where('id',$id)->first();
    }
}
