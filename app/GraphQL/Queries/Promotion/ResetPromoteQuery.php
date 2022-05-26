<?php

namespace App\GraphQL\Queries\Promotion;

use App\Models\Promotion;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class ResetPromoteQuery
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
       return Promotion::where(['from_class'=>$args['from_class'], 'from_term'=>$args['from_term'],
                        'status'=>$args['status'],'from_session'=> $args['from_session']])->get();
    }
}
