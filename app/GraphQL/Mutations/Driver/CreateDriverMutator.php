<?php

namespace App\GraphQL\Mutations\Driver;

use App\Models\Driver;
use Illuminate\Http\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class CreateDriverMutator
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

     
        $file = $args['photo'];
        
        if($file != null){
            $name=  Str::random(4).$file->getClientOriginalName();
            // $path = Storage::putFileAs('public/img',$file,$name);
            $path = $file->storePubliclyAs('public/driver',$name);
             return  Driver::create([
            'first_name'=> $args['first_name'],
            'last_name'=> $args['last_name'],
            'route'=> $args['route'],
            'lga'=> $args['lga'],
            'phone'=> $args['phone'],
            'vehicle_number'=> $args['vehicle_number'],
            'driver_license'=> $args['driver_license'],
            'gender'=> $args['gender'],
            'religion'=> $args['religion'],
            'state_id'=> $args['state_id'],
            'city_id'=> $args['city_id'],
            'photo' => $name,
            'birthday' => $args['birthday'],
            'country_id'=> $args['country_id'],
            'blood_group_id'=> $args['blood_group_id'],
            'slug'=> Str::slug($args['first_name'].Str::random(8))
        ]);
        }else{
            return  Driver::create([
                'first_name'=> $args['first_name'],
                'last_name'=> $args['last_name'],
                'route'=> $args['route'],
                'lga'=> $args['lga'],
                'phone'=> $args['phone'],
                'vehicle_number'=> $args['vehicle_number'],
                'driver_license'=> $args['driver_license'],
                'gender'=> $args['gender'],
                'religion'=> $args['religion'],
                'state_id'=> $args['state_id'],
                'city_id'=> $args['city_id'],
                'birthday' => $args['birthday'],
                'country_id'=> $args['country_id'],
                'blood_group_id'=> $args['blood_group_id'],
                'slug'=> Str::slug($args['first_name'].Str::random(8))
            ]);
        }

    }
}
