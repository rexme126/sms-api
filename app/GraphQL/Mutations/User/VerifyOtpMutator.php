<?php

namespace App\GraphQL\Mutations\User;

use App\Models\Otp;

final class VerifyOtpMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $otp = $args['otp'];
     
        Otp::where(['otp'=> $args['otp'], 'status' => false])->first();
      
        $checkOtp= Otp::where(['otp'=> $args['otp'], 'status' => false, 
                   ['created_at','>=',\date_sub( now(), 
                   \date_interval_create_from_date_string("60 seconds"))] ])->first();
                   
        if(!$checkOtp){
            return null;
        }else{
                $checkOtp->status = true;
                $checkOtp->update();

                return $checkOtp;
        }
    }
}
