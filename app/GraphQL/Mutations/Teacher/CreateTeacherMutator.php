<?php

namespace App\GraphQL\Mutations\Teacher;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class CreateTeacherMutator
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
         $user = User::create([
            'email' => $args['email'],
            'state_id'=> $args['state_id'],
            'city_id'=> $args['city_id'],
            'country_id'=> $args['country_id'],
            'blood_group_id'=> $args['blood_group_id'],
            'lga'=> $args['lga'],
            'user_type' => 'teacher',
            'religion'=> $args['religion'],
            'password'=> Hash::make('destiny12'),
        ]);

        $user->assignRole(4);
       
        $file = $args['photo'];
     
        
        if($file != null){
            $name=  Str::random(4).$file->getClientOriginalName();
            $path = $file->storePubliclyAs('public/teacher',$name);
            Teacher::create([
            'first_name'=> $args['first_name'],
            'last_name'=> $args['last_name'],
            'middle_name'=> $args['middle_name'],
            'phone'=> $args['phone'],
            'qualification'=> $args['qualification'],
            'gender'=> $args['gender'],
            'user_id' => $user->id,
            'photo' => $name,
            'code' => strtoupper(Str::random(8)),
            'birthday' => $args['birthday'],  
            'slug'=> Str::slug($args['first_name'].Str::random(8))
        ]);
        }else{
          return  Teacher::create([
            'first_name'=> $args['first_name'],
            'last_name'=> $args['last_name'],
            'middle_name'=> $args['middle_name'],
            'phone'=> $args['phone'],
            'qualification'=> $args['qualification'],
            'gender'=> $args['gender'],
            'user_id' => $user->id,
            'code' => strtoupper(Str::random(8)),
            'birthday' => $args['birthday'],  
            'slug'=> Str::slug($args['first_name'].Str::random(8))
            ]);
        }

    }
}
