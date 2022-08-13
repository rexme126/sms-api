<?php

namespace App\GraphQL\Mutations;

use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class OtpEmail
{
    /**
     * Return a value for the field.
     *
     * @param  @param  null  $root Always null, since this field has no parent.
     * @param  array<string, mixed>  $args The field arguments passed by the client.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Shared between all fields.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Metadata for advanced query resolution.
     * @return mixed
     */
    public function __invoke($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $checkEmail = User::where('email', $args['email'])->first();
        if ($checkEmail->email !== $args['email']) {
            return $checkEmail;
        }
        if (count($checkEmail) > 0) {
            $otp = rand(10000, 99999);
            $email = $args['email'];
            $checkOtp = new Otp();
            info($checkOtp);
            $checkOtp->email = $email;
            $checkOtp->otp = $otp;
            $checkOtp->save();
            return [
                'email' => $email
            ];
            //    $checkOtp =[
            //        'otp'   => $otp,
            //        'email' => $args['email']
            //    ];

            //   Mail::to($email)->send(new \App\Mail\Otp($otp));
            //     return [ Otp::create($checkOtp),
            //     'email' => $email
            // ];
        }
    }
}
