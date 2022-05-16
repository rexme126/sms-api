<?php

namespace App\GraphQL\Mutations\Promotion;

use App\Models\Student;
use App\Models\Promotion;
use App\Models\SetPromotion;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class PromoteStudents
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
        $klase_id = $args['klase_id'];
        $klaseTo = $args['klaseTo'];
        $session_id = $args['session_id'];
        $sessionTo = $args['sessionTo'];

        $setPromotion = SetPromotion::find(1);
        $students= Student::where(['klase_id'=> $klase_id, 'session_id'=>$session_id,
                    'status'=>true])->where('cum_avg','>=', $setPromotion->name)->get()->pluck('id');


        foreach ($students as $student) {
            Promotion::updateOrCreate([
                'student_id' => $student,
                'from_class'=> $klase_id,
                'to_class'=> $klaseTo,
                'from_session'=> $session_id,
                'to_session' => $sessionTo,
                'status' => true
            ]);

          $sss = Student::where(['id'=> $student,'klase_id'=> $klase_id, 'session_id'=> $session_id,
            'status'=> true])->update([
                'klase_id' => $klaseTo,
                'session_id'=> $sessionTo,
                'status'=> false
            ]);
           

        }
        return Student::where(['klase_id'=>$klase_id, 'status'=> true])->get();       
    }
}
