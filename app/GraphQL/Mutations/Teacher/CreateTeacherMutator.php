<?php

namespace App\GraphQL\Mutations\Teacher;

use App\Models\Role;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Workspace;
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

        $userData = $args['userTable'];
        $teacherData =  $args['teacherTable'];
        $file = $teacherData['photo'];


        $user = User::create([
            'email' => $userData['email'],
            'state_id' => $userData['state'],
            'city' => $userData['city'],
            'country_id' => $userData['country'],
            'blood_group_id' => $userData['bloodGroup'],
            'lga' => $userData['lga'],
            'user_type' => 'teacher',
            'religion' => $userData['religion'],
            'password' => Hash::make('school'),
            'first_name' => $teacherData['first_name'],
            'workspace_id' => $args['workspaceId']
        ]);

        $role = Role::where('name', 'teacher')->first();
        $user->assignRole($role->name);

        // $file = $args['photo'];


        if ($file != null) {
            $name =  Str::random(4) . $file->getClientOriginalName();
            $path = $file->storePubliclyAs('public/' . $args['workspaceId'] . '/teachers', $name);
            Teacher::create([
                'first_name' => $teacherData['first_name'],
                'last_name' => $teacherData['last_name'],
                'middle_name' => $teacherData['middle_name'],
                'phone' => $teacherData['phone'],
                'qualification' => $teacherData['qualification'],
                'gender' => $teacherData['gender'],
                'user_id' => $user->id,
                'photo' => $name,
                'code' => strtoupper(Str::random(8)),
                'birthday' => $teacherData['birthday'],
                'employment' => $teacherData['employment'],
                'slug' => Str::slug($teacherData['first_name'] . Str::random(8)),
                'workspace_id' => $args['workspaceId']
            ]);
        } else {
            return  Teacher::create([
                'first_name' => $teacherData['first_name'],
                'last_name' => $teacherData['last_name'],
                'middle_name' => $teacherData['middle_name'],
                'phone' => $teacherData['phone'],
                'qualification' => $teacherData['qualification'],
                'gender' => $teacherData['gender'],
                'user_id' => $user->id,
                'code' => strtoupper(Str::random(8)),
                'birthday' => $teacherData['birthday'],
                'employment' => $teacherData['employment'],
                'slug' => Str::slug($teacherData['first_name'] . Str::random(8)),
                'workspace_id' => $args['workspaceId']

            ]);
        }
    }
}
