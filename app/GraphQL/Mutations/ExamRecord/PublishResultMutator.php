<?php

namespace App\GraphQL\Mutations\ExamRecord;

use App\Models\Mark;
use App\Models\ExamRecord;

final class PublishResultMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
       $term_id = $args['term_id'];
       $session_id = $args['session_id'];
       $klase_id= $args['klase_id'];
     
           $status = $args['status'];
           $examPublished= ExamRecord::where(['klase_id'=> $klase_id, 'term_id'=>$term_id,'session_id'=>$session_id])->get();
         
           if(count($examPublished) === 0){
               return;
           }else {
               info('no');
                ExamRecord::where(['klase_id'=> $klase_id, 'term_id'=>$term_id,'session_id'=>$session_id])
                    ->update([
                    'status'=> $status
                ]);
                Mark::where(['klase_id'=> $klase_id, 'term_id'=>$term_id,'session_id'=>$session_id])
                    ->update([
                        'status'=> $status
                    ]);
                return  ExamRecord::where(['klase_id'=> $klase_id, 'term_id'=>$term_id,
                    'session_id'=>$session_id])->first();
           }

           
            
       
    }
}
