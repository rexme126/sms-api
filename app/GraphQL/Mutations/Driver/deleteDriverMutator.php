<?php

namespace App\GraphQL\Mutations\Driver;

use App\Models\Driver;
use Illuminate\Support\Facades\Storage;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class deleteDriverMutator
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
        $driver = Driver::findOrFail($id);
      
        Storage::delete('public/driver/'.$driver->photo);
        $driver->delete();
    }
}
