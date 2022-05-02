<?php

namespace App\GraphQL\Mutations\Libarian;

use App\Models\User;
use App\Models\Libarian;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class UpdateLibarianMutator
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

        $id= $args['id'];
        $userData =$args['userLib'];
        $libData =  $args['lib'];
         
         $file = $libData['image'];
      
    //    libarian
    

        $libarian = Libarian::where('id', $id)->first();
        $userId = $libarian->user_id;
        $user = User::where('id', $userId)->first();
        //     info($user);
        

     if($file != null){
            $name=  Str::random(4).$file->getClientOriginalName();
            $path = $file->storePubliclyAs('public/libarian', $name);
            Storage::delete('public/libarian/'.$libarian->photo);

            $libarian->first_name = $libData['first_name'];
            $libarian->last_name = $libData['last_name'];
            $libarian->middle_name = $libData['middle_name'];
            $libarian->birthday = $libData['birthday'];
         
            $libarian->phone = $libData['phone'];
            $libarian->photo = $name;
            $libarian->qualification = $libData['qualification'];
            $libarian->gender = $libData['gender'];

            // user

             $user->state_id = $userData['state'];
            $user->country_id = $userData['country'];
            $user->blood_group_id = $userData['bloodGroup'];
            $user->city_id = $userData['city'];
            $user->lga = $userData['lga'];
            $user->email = $userData['email'];
            $user->religion = $userData['religion'];

            $user->save();
            $libarian->save();
            return $libarian;
          
        
        }else{
            $libarian->first_name = $libData['first_name'];
            $libarian->last_name = $libData['last_name'];
            $libarian->middle_name = $libData['middle_name'];
            $libarian->birthday = $libData['birthday'];
          
            $libarian->phone = $libData['phone'];
            $libarian->qualification = $libData['qualification'];
            $libarian->gender = $libData['gender'];
        
            $user->state_id = $userData['state'];
            $user->country_id = $userData['country'];
            $user->blood_group_id = $userData['bloodGroup'];
            $user->city_id = $userData['city'];
            $user->lga = $userData['lga'];
            $user->email = $userData['email'];
            $user->religion = $userData['religion'];
     
            $user->save();
            $libarian->save();
            return $libarian;
            
         
        }
      
      
    }
}
