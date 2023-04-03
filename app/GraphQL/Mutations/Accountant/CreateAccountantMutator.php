<?php

namespace App\GraphQL\Mutations\Accountant;

use App\Models\User;
use App\Models\Accountant;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Storage;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class CreateAccountantMutator
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
       
        $userData = $args['userTable'];
        $accountantData =  $args['accountantTable'];
        $file = $accountantData['photo'];


        $user = User::create([
            'email' => $userData['email'],
            'state_id' => $userData['state'],
            'city' => $userData['city'],
            'country_id' => $userData['country'],
            'blood_group_id' => $userData['bloodGroup'],
            'lga' => $userData['lga'],
            'user_type' => 'accountant',
            'religion' => strtoupper($userData['religion']),
            'password' => Hash::make('school'),
            'first_name' => strtoupper($accountantData['first_name']),
            'workspace_id' => $args['workspaceId']
        ]);


        $user->assignRole('accountant');

        if ($file != null) {
            $name =  Str::random(4) . $file->getClientOriginalName();
            //aws
            // Storage::disk('s3')->put($args['workspaceId'] . '/accountants/'.$name , file_get_contents($file));
          //  $file->storePubliclyAs($args['workspaceId'] . '/accountants', $name, 's3');
            $path = $file->storePubliclyAs('public/' . $args['workspaceId'] . '/accountants', $name);
            
            Accountant::create([
                'first_name' => strtoupper($accountantData['first_name']),
                'last_name' => strtoupper($accountantData['last_name']),
                'middle_name' => strtoupper($accountantData['middle_name']),
                'phone' => $accountantData['phone'],
                'qualification' => $accountantData['qualification'],
                'gender' => $accountantData['gender'],
                'user_id' => $user->id,
                'photo' => $name,
                'code' => strtoupper(Str::random(8)),
                'birthday' => $accountantData['birthday'],
                'employment' => $accountantData['employment'],
                'slug' => Str::slug($accountantData['first_name'] . Str::random(8)),
                'workspace_id' => $args['workspaceId']
            ]);
        } else {
            return  Accountant::create([
                'first_name' => strtoupper($accountantData['first_name']),
                'last_name' => strtoupper($accountantData['last_name']),
                'middle_name' => strtoupper($accountantData['middle_name']),
                'phone' => $accountantData['phone'],
                'qualification' => $accountantData['qualification'],
                'gender' => $accountantData['gender'],
                'user_id' => $user->id,
                'code' => strtoupper(Str::random(8)),
                'birthday' => $accountantData['birthday'],
                'employment' => $accountantData['employment'],
                'slug' => Str::slug($accountantData['first_name'] . Str::random(8)),
                'workspace_id' => $args['workspaceId']

            ]);
        }
    }
}
