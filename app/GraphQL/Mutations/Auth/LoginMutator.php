<?php

namespace App\GraphQL\Mutations\Auth;

use GraphQL\Type\Definition\ResolveInfo;
use App\Exceptions\RuntimeValidationException;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class LoginMutator
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
         // TODO implement the resolver
         $credentials = [
            'email' => $args['email'],
            'password' => $args['password']
        ];
        
        $token = auth('api')->attempt($credentials);

        if (! $token) {
            throw new RuntimeValidationException('Login failed', 'InvalidCredentials');
        }

        return [
            'token' => $token,
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
}
