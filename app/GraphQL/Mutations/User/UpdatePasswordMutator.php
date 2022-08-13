<?php

namespace App\GraphQL\Mutations\User;

use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class UpdatePasswordMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $email = $args['email'];
        $password = $args['password'];
        $checkStatus = Otp::where(['email' => $email, 'status' => true])->first();

        if ($checkStatus !== null) {
            $updatePassword = User::where('email', $email)->first();
            $updatePassword->password = Hash::make($password);
            $updatePassword->save();
        } else {
            return;
        }
    }
}
