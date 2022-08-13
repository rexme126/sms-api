<?php

namespace App\GraphQL\Mutations\Workspace;

use App\Models\Workspace;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

final class UpdateAdminSettingsWorkspace
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        if ($args['logo'] == null && $args['stamp'] !== null) {

            $stampName =  Str::random(4) . $args['stamp']->getClientOriginalName();
            Storage::delete('public/' . $args['workspaceId'] . '/stamp' . '/' . $workspace->stamp);
            $args['stamp']->storePubliclyAs('public/' . $args['workspaceId'] . '/stamp', $stampName);

            $workspace->stamp =  $stampName;
            $workspace->paystack_secret_key = $args['paystack_secret_key'];
            $workspace->save();
        } else if ($args['stamp'] == null && $args['logo'] !== null) {
            $logoName =  Str::random(4) . $args['logo']->getClientOriginalName();
            Storage::delete('public/' . $args['workspaceId'] . '/logo' . '/' . $workspace->logo);
            $args['logo']->storePubliclyAs('public/' . $args['workspaceId'] . '/logo', $logoName);

            $workspace->logo = $logoName;

            $workspace->paystack_secret_key = $args['paystack_secret_key'];
            $workspace->save();
        }else if ($args['stamp'] == null && $args['logo'] == null) {
        
            $workspace->paystack_secret_key = $args['paystack_secret_key'];
            $workspace->save();
        } else {
            $logoName =  Str::random(4) . $args['logo']->getClientOriginalName();
            Storage::delete('public/' . $args['workspaceId'] . '/logo' . '/' . $workspace->logo);
            $args['logo']->storePubliclyAs('public/' . $args['workspaceId'] . '/logo', $logoName);

            $stampName =  Str::random(4) . $args['stamp']->getClientOriginalName();
            Storage::delete('public/' . $args['workspaceId'] . '/stamp' . '/' . $workspace->stamp);
            $args['stamp']->storePubliclyAs('public/' . $args['workspaceId'] . '/stamp', $stampName);

            $workspace->logo = $logoName;
            $workspace->stamp =  $stampName;
            $workspace->paystack_secret_key = $args['paystack_secret_key'];
            $workspace->save();
        }

        return $workspace;
    }
}
