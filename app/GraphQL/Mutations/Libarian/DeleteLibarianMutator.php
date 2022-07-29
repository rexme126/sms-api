<?php

namespace App\GraphQL\Mutations\Libarian;

use App\Models\User;
use App\Models\Libarian;
use Illuminate\Support\Facades\Storage;

final class DeleteLibarianMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $libarianId = Libarian::find($args['id']);
        Storage::delete('public/' . $args['workspaceId'] . '/libarians' . '/' . $libarianId->photo);
        $id = $libarianId->user_id;
        $userId = User::find($id);
        $userId->removeRole(6);
        $userId->delete();

        return Libarian::find($args['id'])->delete();
    }
}
