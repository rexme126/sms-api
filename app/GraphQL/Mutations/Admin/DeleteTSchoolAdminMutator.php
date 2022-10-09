<?php

namespace App\GraphQL\Mutations\Admin;

use App\Models\Role;
use App\Models\SchoolAdmin;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

final class DeleteTSchoolAdminMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {

        $admin = SchoolAdmin::find($args['id']);
        Storage::delete('public/' . $args['workspaceId'] . '/admin' . '/' . $admin->photo);
        $userId = $admin->user_id;
        $user = User::find($userId);
        $role = Role::where('name', 'admin')->first();
        $user->removeRole($role->name);
        $user->delete();
        return SchoolAdmin::find($args['id'])->delete();
    }
}
