<?php

namespace App\GraphQL\Mutations\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class UpdateUserPasswordMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = User::findOrFail($args['id']);

        $user->password = Hash::make($args['confirmPassword']);
        $user->save();

        return $user;
    }
}
