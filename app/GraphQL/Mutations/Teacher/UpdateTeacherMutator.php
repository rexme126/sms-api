<?php

namespace App\GraphQL\Mutations\Teacher;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class UpdateTeacherMutator
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
        $teacherData =  $args['teacherTable'];
        // $file = $teacherData['photo'];

        $file = $teacherData['photo'];

        //    teacher

        $teacher = Teacher::where('id', $id)->first();
        $userId = $teacher->user_id;
        $user = User::where('id', $userId)->first();

        if ($file != null) {
            $name =  Str::random(4) . $file->getClientOriginalName();
            $path = $file->storePubliclyAs('public/' . $args['workspaceId'] . '/teachers', $name);
           
            Storage::delete('public/'. $args['workspaceId'] . '/teachers' .'/' . $teacher->photo);

            $teacher->first_name = $teacherData['first_name'];
            $teacher->last_name = $teacherData['last_name'];
            $teacher->middle_name = $teacherData['middle_name'];
            $teacher->birthday = $teacherData['birthday'];
            $teacher->employment = $teacherData['employment'];
            $teacher->phone = $teacherData['phone'];
            $teacher->photo = $name;
            $teacher->qualification = $teacherData['qualification'];
            $teacher->gender = $teacherData['gender'];

            // user

            $user->state_id = $userData['state'];
            $user->country_id = $userData['country'];
            $user->blood_group_id = $userData['bloodGroup'];
            $user->city = $userData['city'];
            $user->lga = $userData['lga'];
            $user->email = $userData['email'];
            $user->religion = $userData['religion'];
            $user->first_name = $teacherData['first_name'];

            $user->save();
            $teacher->save();
            return $teacher;
        } else {
            $teacher->first_name = $teacherData['first_name'];
            $teacher->last_name = $teacherData['last_name'];
            $teacher->middle_name = $teacherData['middle_name'];
            $teacher->birthday = $teacherData['birthday'];
            $teacher->employment = $teacherData['employment'];
            $teacher->phone = $teacherData['phone'];
            $teacher->qualification = $teacherData['qualification'];
            $teacher->gender = $teacherData['gender'];

            $user->state_id = $userData['state'];
            $user->email = $userData['email'];
            $user->country_id = $userData['country'];
            $user->blood_group_id = $userData['bloodGroup'];
            $user->city = $userData['city'];
            $user->lga = $userData['lga'];
            $user->religion = $userData['religion'];
            $user->first_name = $teacherData['first_name'];

            $user->save();
            $teacher->save();
            return $teacher;
        }
    }
}
