<?php

namespace App\GraphQL\Mutations\Mark;

use App\Models\Mark;
use App\Models\ExamRecord;
use Illuminate\Support\Facades\DB;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class UpdateMarkMutator
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
        $marks =$args['marks'];

      $id= [];
      $caa1 = [];
      $caa2 = [];
      $examm = [];
      $examTotall = [];
        
          
        foreach ($marks as $mark) {
           $markid = $mark['markId'];
           $ca1 = $mark['ca1'];
           $ca2 =$mark['ca2'];
           $exam = $mark['exam'];
           $tca = $ca1+ $ca2;
           $examTotal = $ca1 + $ca2 + $exam;

             $id =  $markid;
               $caa1 =  $ca1;
               $caa2 =  $ca2;
               $examm = $exam;
               $examTotall= $examTotal;

            if(!empty($id)){
              Mark::where('id',$id )->update([
                 'ca1'=>$caa1,
               'ca2'=> $caa2,
               'exam'=>$examm,
               'tca'=> $tca,
               'exam_total'=>$examTotall
                ]);
      
            }

        }
        $studentMarks = Mark::where('klase_id',1)->get()
          ->groupBy('subject_id')->map(function($subject){
              $rank = 0; $score =-1;
            
              return $subject->sortByDesc('exam_total')
              ->map(function($record) use (&$rank, &$score){
                
              if($score != $record->getAttribute('exam_total')){
                  $score = $record->getAttribute('exam_total');
                  $rank++;
              }
                $record->setAttribute('sub_position',$rank)->save();
              return $record->getAttributes();
              });
          });
          $studentM = Mark::where('klase_id',1)->get()
          ->groupBy('klase_id')->map(function($subject){
              $rank = 0; $score =-1;
            
              return $subject->sortByDesc('exam_total')
              ->map(function($record) use (&$rank, &$score){
                
              if($score != $record->getAttribute('exam_total')){
                  $score = $record->getAttribute('exam_total');
                  $rank++;
              }
              $record->setAttribute('position', $rank)->save();
              return $record->getAttributes();
              });
          });

          $stud = DB::table('marks')->get()->pluck('student_id')->unique();

      foreach ($stud as $num) {
        $stu=  Mark::where('student_id',$num)->get();
      //  info($stu->sum('exam_total'));

        //  $students = ExamRecord::where('student_id', $stud)->get();

          info($num);

            ExamRecord::where('student_id',$num)->update([
                'klase_id'=> 1,
                'student_id'=> $num,
                'session_id' => 1,
                'term_id' => 1,
                'total'=> $stu->sum('exam_total')
             ]);

      }

    }
}
