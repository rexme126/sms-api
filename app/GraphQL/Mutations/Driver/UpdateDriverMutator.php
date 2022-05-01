<?php

namespace App\GraphQL\Mutations\Driver;

use App\Models\Driver;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class UpdateDriverMutator
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
        $id = $args['id'];
 
        
         $file = $args['photo'];

        $updateDriver = Driver::where('id', $id)->first();

        if($file != null){
            $name=  Str::random(4).$file->getClientOriginalName();
            $path = $file->storePubliclyAs('public/driver', $name);
            Storage::delete('public/driver/'.$updateDriver->photo);

            $updateDriver->first_name = $args['first_name'];
            $updateDriver->last_name = $args['last_name'];
            $updateDriver->route = $args['route'];
            $updateDriver->lga = $args['lga'];
            $updateDriver->gender = $args['gender'];
            $updateDriver->phone = $args['phone'];
            $updateDriver->photo = $name;
            $updateDriver->vehicle_number = $args['vehicle_number'];
            $updateDriver->driver_license = $args['driver_license'];
            $updateDriver->religion = $args['religion'];
            $updateDriver->state_id = $args['state_id'];
            $updateDriver->city_id = $args['city_id'];
            $updateDriver->birthday = $args['birthday'];
            $updateDriver->country_id = $args['country_id'];
            // $updateDriver->blood_group_id = $args['blood_group_id'];
            $updateDriver->save();
            return $updateDriver;
        
        }else{
            $updateDriver->first_name = $args['first_name'];
            $updateDriver->last_name = $args['last_name'];
            $updateDriver->route = $args['route'];
            $updateDriver->lga = $args['lga'];
            $updateDriver->gender = $args['gender'];
            $updateDriver->phone = $args['phone'];
            $updateDriver->vehicle_number = $args['vehicle_number'];
            $updateDriver->driver_license = $args['driver_license'];
            $updateDriver->religion = $args['religion'];
            $updateDriver->state_id = $args['state_id'];
            $updateDriver->city_id = $args['city_id'];
            $updateDriver->birthday = $args['birthday'];
            $updateDriver->country_id = $args['country_id'];
            // $updateDriver->blood_group_id = $args['blood_group_id'];
            $updateDriver->save();
            return $updateDriver;
        }

    }
}
