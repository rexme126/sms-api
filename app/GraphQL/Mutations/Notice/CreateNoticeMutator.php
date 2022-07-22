<?php

namespace App\GraphQL\Mutations\Notice;

use App\Models\User;
use App\Models\Notice;
use Illuminate\Support\Str;
use App\Notifications\SchoolNotice;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class CreateNoticeMutator
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

        $user = auth()->user();
        $workspace = $user->workspace()->where('slug', $args['workspace'])->first();

        $notice = Notice::create([
            'user_id' => $user->id,
            'workspace_id' => $workspace->id,
            'description' => $args['description'],
            'date' => $args['date']
        ]);
        $users = User::all();
        foreach ($users as $user) {
            $user->notify(new SchoolNotice($notice));
        }
        return $notice;
    }
}
