<?php

namespace App\GraphQL\Mutations\Libarian;

use App\Models\User;
use App\Models\Libarian;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class CreateLibarianMutator
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
        // create user

        $userData = $args['userTable'];
        $libarianData =  $args['teacherTable'];
        $file = $libarianData['photo'];


        $user = User::create([
            'email' => $userData['email'],
            'state_id' => $userData['state'],
            'city_id' => $userData['city'],
            'country_id' => $userData['country'],
            'blood_group_id' => $userData['bloodGroup'],
            'lga' => $userData['lga'],
            'user_type' => 'student',
            'religion' => $userData['religion'],
            'password' => Hash::make('destiny12'),
            'first_name' => $libarianData['first_name'],
            'workspace_id' => $args['workspaceId']
        ]);


        $user->assignRole(6);

        // $file = $args['photo'];


        if ($file != null) {
            $name =  Str::random(4) . $file->getClientOriginalName();
            $path = $file->storePubliclyAs('public/' . $args['workspaceId'] . '/libarians', $name);
            Libarian::create([
                'first_name' => $libarianData['first_name'],
                'last_name' => $libarianData['last_name'],
                'middle_name' => $libarianData['middle_name'],
                'phone' => $libarianData['phone'],
                'qualification' => $libarianData['qualification'],
                'gender' => $libarianData['gender'],
                'user_id' => $user->id,
                'photo' => $name,
                'code' => strtoupper(Str::random(8)),
                'birthday' => $libarianData['birthday'],
                'slug' => Str::slug($libarianData['first_name'] . Str::random(8)),
                'workspace_id' => $args['workspaceId']
            ]);
        } else {
            return  Libarian::create([
                'first_name' => $libarianData['first_name'],
                'last_name' => $libarianData['last_name'],
                'middle_name' => $libarianData['middle_name'],
                'phone' => $libarianData['phone'],
                'qualification' => $libarianData['qualification'],
                'gender' => $libarianData['gender'],
                'user_id' => $user->id,
                'code' => strtoupper(Str::random(8)),
                'birthday' => $libarianData['birthday'],
                'slug' => Str::slug($libarianData['first_name'] . Str::random(8)),
                'workspace_id' => $args['workspaceId']

            ]);
        }
    }
}
