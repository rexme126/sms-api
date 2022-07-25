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
        $id = $args['id'];
        $userData = $args['userTable'];
        $libarianData =  $args['teacherTable'];

        $file = $libarianData['photo'];
      
    //    libarian
    

        $libarian = Libarian::where('id', $id)->first();
        $userId = $libarian->user_id;
        $user = User::where('id', $userId)->first();
        //     info($user);
        

     if($file != null){
            $name=  Str::random(4).$file->getClientOriginalName();
            $path = $file->storePubliclyAs('public/' . $args['workspaceId'] . '/libarians', $name);

            Storage::delete('public/' . $args['workspaceId'] . '/libarians' . '/' . $libarian->photo);

            $libarian->first_name = $libarianData['first_name'];
            $libarian->last_name = $libarianData['last_name'];
            $libarian->middle_name = $libarianData['middle_name'];
            $libarian->birthday = $libarianData['birthday'];
         
            $libarian->phone = $libarianData['phone'];
            $libarian->photo = $name;
            $libarian->qualification = $libarianData['qualification'];
            $libarian->gender = $libarianData['gender'];

            // user

             $user->state_id = $userData['state'];
            $user->country_id = $userData['country'];
            $user->blood_group_id = $userData['bloodGroup'];
            $user->city_id = $userData['city'];
            $user->lga = $userData['lga'];
            $user->email = $userData['email'];
            $user->religion = $userData['religion'];
            $user->first_name = $libarianData['first_name'];

            $user->save();
            $libarian->save();
            return $libarian;
          
        
        }else{
            $libarian->first_name = $libarianData['first_name'];
            $libarian->last_name = $libarianData['last_name'];
            $libarian->middle_name = $libarianData['middle_name'];
            $libarian->birthday = $libarianData['birthday'];
          
            $libarian->phone = $libarianData['phone'];
            $libarian->qualification = $libarianData['qualification'];
            $libarian->gender = $libarianData['gender'];
        
            $user->state_id = $userData['state'];
            $user->country_id = $userData['country'];
            $user->blood_group_id = $userData['bloodGroup'];
            $user->city_id = $userData['city'];
            $user->lga = $userData['lga'];
            $user->email = $userData['email'];
            $user->religion = $userData['religion'];
            $user->first_name = $libarianData['first_name'];
     
            $user->save();
            $libarian->save();
            return $libarian;
            
         
        }
      
      
    }
}
