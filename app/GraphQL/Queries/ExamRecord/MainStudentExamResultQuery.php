<?php

namespace App\GraphQL\Queries\ExamRecord;

use App\Models\ExamRecord;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class MainStudentExamResultQuery
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
         return ExamRecord::where(['klase_id'=>$args['klase_id'],'student_id'=> 
         $args['student_id'],'term_id'=>$args['term_id'],'status'=>$args['status'],
         'session_id'=> $args['session_id']])->get();
    }
}
