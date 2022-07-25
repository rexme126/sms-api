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
        $userId =Libarian::find($args['id']);
        Storage::delete('public/'. $args['workspaceId'] . '/libarians' .'/' . $userId->photo);
        $id = $userId->user_id;
        User::find($id)->delete();
        
        return Libarian::find($args['id'])->delete();
    }
}
