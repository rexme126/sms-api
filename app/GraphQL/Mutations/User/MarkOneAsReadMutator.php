<?php

namespace App\GraphQL\Mutations\User;

use App\Models\Notification;

final class MarkOneAsReadMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $id= $args['id'];
        $notification= Notification::find($id);
      
       $notification->delete();
    }
}
