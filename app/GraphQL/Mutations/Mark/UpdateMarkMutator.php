<?php

namespace App\GraphQL\Mutations\Mark;

use App\Models\Mark;
use App\Models\Grade;
use App\Models\Student;
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
        $marks = collect($args['marks']);
        $klase_id = $args['klase_id'];
        $subject_id= $args['subject_id'];
        $term_id = $args['term_id'];
        $session_id= $args['session_id'];

        
      
        // marks
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

        // subject ranking
        $studentMarks = Mark::where(['klase_id'=>$klase_id,'term_id'=> $term_id,
        'session_id'=> $session_id])->get()->groupBy('subject_id')->map(function($subject){
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

        // total and avg score

        $stud = DB::table('marks')->where(['klase_id'=>$klase_id,'term_id'=> $term_id,
        'session_id'=> $session_id])->get()->pluck('student_id')->unique();

      foreach ($stud as $num) {
        $stu=  Mark::where(['student_id'=>$num,'klase_id'=>$klase_id,'term_id'=> $term_id,
        'session_id'=> $session_id])->get();
        // info($stu->avg('exam_total'));

        ExamRecord::where(['student_id'=>$num, 'term_id'=> $term_id, 'session_id'=>$session_id])->update([
          'klase_id'=> $klase_id,
          'student_id'=> $num,
          'session_id' => $session_id,
          'term_id' => $term_id,
          'total'=> $stu->sum('exam_total'),
          'avg' => $stu->avg('exam_total')
        ]);
      }

      if($term_id == 3 ){
        foreach ($stud as $num) {
          $cumTotal=  Mark::where(['student_id'=>$num,'klase_id'=>$klase_id,
          'session_id'=> $session_id])->get();
        
            ExamRecord::where(['student_id'=>$num,'term_id'=>$term_id,'session_id'=>$session_id])->update([ 
            'cum_total'=> $cumTotal->sum('exam_total'),
            'cum_avg' => $cumTotal->avg('exam_total')
          ]);

            Student::where(['id'=>$num,'session_id'=>$session_id])->update([ 
            'cum_avg' => $cumTotal->avg('exam_total')
          ]);
        
        }
     }

      // position ranking
      $studentM = ExamRecord::where(['klase_id'=>$klase_id,'term_id'=> $term_id,
        'session_id'=> $session_id])->get()->groupBy('klase_id')->map(function($subject){
          $rank = 0; $score =-1;
        
          return $subject->sortByDesc('total')
          ->map(function($record) use (&$rank, &$score){
            
          if($score != $record->getAttribute('total')){
              $score = $record->getAttribute('total');
              $rank++;
          }
          $record->setAttribute('position', $rank)->save();
          return $record->getAttributes();
        });
      });

      // grade 
      $grades = Grade::all();
      foreach ($grades as $grade) {
        Mark::where('exam_total', '>=',  $grade->mark_from)->Where('exam_total', '<=',  $grade->mark_to)->update([
        'grade_id'=> $grade->id
      ]);
      }
     
      // $b = Grade::where('id',2)->first();
      // Mark::where('exam_total', '>=',  $b->mark_from)->Where('exam_total', '<=',  $b->mark_to)->update([
      //   'grade_id'=> $b->id
      // ]);
      //  $c = Grade::where('id',3)->first();
      // Mark::where('exam_total', '>=',  $c->mark_from)->Where('exam_total', '<=',  $c->mark_to)->update([
      //   'grade_id'=> $c->id
      // ]);
      // Mark::where('exam_total', '>=',  45)->Where('exam_total', '<=',  50)->update([
      //   'grade_id'=> 4
      // ]);
      //   Mark::where('exam_total', '>=',  40)->Where('exam_total', '<=',  45)->update([
      //   'grade_id'=> 5
      // ]);
      // Mark::where('exam_total', '>=',  0)->Where('exam_total', '<=',  39)->update([
      //   'grade_id'=> 6
      // ]);


    }
}
