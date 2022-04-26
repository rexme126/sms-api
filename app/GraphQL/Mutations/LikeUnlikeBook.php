<?php

namespace App\GraphQL\Mutations;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\UserHasBook;
use App\Notifications\InvoicePaid;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class LikeUnlikeBook
{
    /**
     * Return a value for the field.
     *
     * @param  @param  null  $root Always null, since this field has no parent.
     * @param  array<string, mixed>  $args The field arguments passed by the client.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Shared between all fields.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Metadata for advanced query resolution.
     * @return mixed
     */
    public function __invoke($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {

        // TODO implement the resolver
        $likeUnlike =$args['likeUnlike'];
        $user= User::find(1);
    //    info($likeUnlike);

     
         $user->notify(new InvoicePaid($likeUnlike ));
     //  info($user->unreadNotifications()->update(['read_at' => now()]));
        // Notification::send('tojurex@yahoo.com', new \App\Listeners\InvoicePaid($likeUnlike ));
         
    }
}
