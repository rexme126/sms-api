<?php

namespace App\GraphQL\Mutations\User;

use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

final class OtpPasswordResetMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $checkEmail = User::where('email', $args['email'])->first();

        if ($checkEmail == null) {
            return $checkEmail;
        }
        if ($checkEmail !== null) {
            $otp = rand(10000, 99999);
            $email = $args['email'];
            $checkOtp = new Otp();
            $checkOtp->email = $email;
            $checkOtp->otp = $otp;
            $checkOtp->save();

            Mail::to($email)->send(new \App\Mail\OtpMail($otp));

            return $checkOtp;
        }
    }
}
