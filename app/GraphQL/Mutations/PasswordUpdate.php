<?php

namespace App\GraphQL\Mutations;

use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class PasswordUpdate
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
        $email= $args['email'];
        $password= $args['password'];
        $checkStatus=Otp::where(['email'=>$email,'status'=>true])->first();
        if($checkStatus){
            $updatePassword = User::where('email', $email)->first();
            $updatePassword->password = Hash::make($password);
            $updatePassword->save();
        }else {
            return 'failed';
        }
    }
}
