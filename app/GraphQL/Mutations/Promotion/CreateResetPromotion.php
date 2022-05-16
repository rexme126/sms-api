<?php

namespace App\GraphQL\Mutations\Promotion;

use App\Models\Student;
use App\Models\Promotion;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class CreateResetPromotion
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
        $classId =$args['from_class'];
        $sessionId =$args['from_session'];
        $status = $args['status'];

        $promotions= Promotion::where(['from_class'=> $classId,
                    'from_session'=>$sessionId, 'status'=>true])->get()->pluck('student_id');

        foreach ($promotions as $studentId) {
            Student::where(['id'=>$studentId,'status'=>false])->update([
                'klase_id'=> $classId,
                'session_id'=> $sessionId,
                'status'=> true
            ]);
        }

         $p=Promotion::where(['from_class'=> $classId,
                    'from_session'=>$sessionId, 'status'=>true])->get()->pluck('id');
                    Promotion::destroy($p);
    }
}
