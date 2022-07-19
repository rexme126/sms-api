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
        $userId =Accountant::find($args['id']);
        $id = $userId->user_id;
        User::find($id)->delete();
        Storage::delete('public/accountant/'.$userId->photo);
        return Accountant::find($args['id'])->delete();
    }
}
