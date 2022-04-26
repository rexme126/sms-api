<?php

namespace App\GraphQL\Mutations;

use Carbon\Carbon;
use App\Models\Otp;
use Illuminate\Support\Facades\DB;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class VerifyOtp
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
        // TODO implement the resolver
        $otp = $args['otp'];
     
        $checkCreatedAt = Otp::where(['otp'=> $args['otp'], 'status' => false])->first();
      
        $checkOtp= Otp::where(['otp'=> $args['otp'], 'status' => false, 
                   ['created_at','>=',\date_sub( now(), 
                   \date_interval_create_from_date_string("60 seconds"))] ])->first();
                   
        if(!$checkOtp){
            info('Expired OTP code');
        }else{
                $checkOtp->status = true;
                $checkOtp->update();

                return [
                    'status' => true,
                    'email'  => $checkCreatedAt->email
                ];
        }

      
    }
}
