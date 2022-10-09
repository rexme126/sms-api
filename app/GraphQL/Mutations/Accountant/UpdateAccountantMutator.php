<?php

namespace App\GraphQL\Mutations\Accountant;

use App\Models\User;
use App\Models\Accountant;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class UpdateAccountantMutator
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
        $accountantData =  $args['accountantTable'];

        $file = $accountantData['photo'];


        //    accountant


        $accountant = Accountant::where('id', $id)->first();
        $userId = $accountant->user_id;
        $user = User::where('id', $userId)->first();
        //     info($user);


        if ($file != null) {
            $name =  Str::random(4) . $file->getClientOriginalName();
            $path = $file->storePubliclyAs('public/' . $args['workspaceId'] . '/accountants', $name);

            Storage::delete('public/' . $args['workspaceId'] . '/accountants' . '/' . $accountant->photo);


            $accountant->first_name = $accountantData['first_name'];
            $accountant->last_name = $accountantData['last_name'];
            $accountant->middle_name = $accountantData['middle_name'];
            $accountant->birthday = $accountantData['birthday'];
            $accountant->employment = $accountantData['employment'];
            $accountant->phone = $accountantData['phone'];
            $accountant->photo = $name;
            $accountant->qualification = $accountantData['qualification'];
            $accountant->gender = $accountantData['gender'];

            // user

            $user->state_id = $userData['state'];
            $user->country_id = $userData['country'];
            $user->blood_group_id = $userData['bloodGroup'];
            $user->city = $userData['city'];
            $user->lga = $userData['lga'];
            $user->email = $userData['email'];
            $user->religion = $userData['religion'];
            $user->first_name = $accountantData['first_name'];

            $user->save();
            $accountant->save();
            return $accountant;
        } else {
            $accountant->first_name = $accountantData['first_name'];
            $accountant->last_name = $accountantData['last_name'];
            $accountant->middle_name = $accountantData['middle_name'];
            $accountant->birthday = $accountantData['birthday'];
            $accountant->employment = $accountantData['employment'];
            $accountant->phone = $accountantData['phone'];
            $accountant->qualification = $accountantData['qualification'];
            $accountant->gender = $accountantData['gender'];

            $user->state_id = $userData['state'];
            $user->country_id = $userData['country'];
            $user->blood_group_id = $userData['bloodGroup'];
            $user->city = $userData['city'];
            $user->lga = $userData['lga'];
            $user->email = $userData['email'];
            $user->religion = $userData['religion'];
            $user->first_name = $accountantData['first_name'];

            $user->save();
            $accountant->save();
            return $accountant;
        }
    }
}
