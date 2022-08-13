<?php

namespace App\GraphQL\Mutations\User;

use App\Models\Otp;
use App\Models\User;

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
           
           
            //    $checkOtp =[
            //        'otp'   => $otp,
            //        'email' => $args['email']
            //    ];

            //   Mail::to($email)->send(new \App\Mail\Otp($otp));
            //     return [ Otp::create($checkOtp),
            //     'email' => $email
            // ];

            return $checkOtp;
        }
    }
}
