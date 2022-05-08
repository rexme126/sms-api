<?php

namespace App\GraphQL\Mutations\Event;

use App\Models\User;
use App\Models\Event;
use App\Notifications\SchoolEvent;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class CreateEventMutator
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
         $event = Event::create([
            'description'=> $args['description'],
            'date' => $args['date']
        ]);
        $users = User::all();
        foreach ($users as $user) {
             $user->notify(new SchoolEvent($event));
        }

    }
}
