<?php

namespace App\GraphQL\Queries\Payment;

use App\Models\Payment;
use App\Models\Workspace;
use Illuminate\Support\Facades\DB;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class PaymentsQuery
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
    $workspace = Workspace::findOrFail($args['workspaceId']);
    $payments = $workspace->payments()->orderBy('created_at', 'desc')->get();
    return $payments;
  }
}
