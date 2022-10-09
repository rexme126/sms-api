<?php

namespace App\GraphQL\Mutations\Accountant;

use App\Models\User;
use App\Models\Accountant;
use Illuminate\Support\Facades\Storage;

final class DeleteAccountantMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $accountantId = Accountant::find($args['id']);
        $userId = $accountantId->user_id;

        $user =  User::find($userId);
        $user->removeRole('accountant');
        $user->delete();
        Storage::delete('public/' . $args['workspaceId'] . '/accountants' . '/' . $accountantId->photo);
        return Accountant::find($args['id'])->delete();
    }
}
