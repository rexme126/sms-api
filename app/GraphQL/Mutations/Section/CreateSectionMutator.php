<?php

namespace App\GraphQL\Mutations\Section;

use App\Models\Section;

final class CreateSectionMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = auth()->user();
        $workspace = $user->workspace()->where('slug', $args['workspace'])->first();

        $section = new Section();
        $section->user_id = $user->id;
        $section->workspace_id = $workspace->id;
        $section->name = $args['name'];
        $section->save();

        return $section;
    }
}
