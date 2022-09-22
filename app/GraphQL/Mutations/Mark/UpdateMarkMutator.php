<?php

namespace App\GraphQL\Mutations\Mark;

use App\Models\Mark;
use App\Models\Grade;
use App\Models\Student;
use App\Models\ExamRecord;
use App\Models\SetPromotion;
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
    $term_id = $args['term_id'];
    $session_id = $args['session_id'];
    $section_id = $args['section_id'];
    $workspaceId = $args['workspaceId'];



    // marks
    foreach ($marks as $mark) {
      $markid = $mark['markId'];

      $update = $mark;
      // return;
      unset($update['markId']);


      if (!empty($markid)) {
        $markModel = Mark::findOrFail($markid);

        $markModel->update($update);
      }
    }

    $marks = Mark::where([
      'klase_id' => $klase_id, 'term_id' => $term_id,
      'session_id' => $session_id, 'section_id' => $section_id, 'workspace_id' => $workspaceId
    ])->get();

    foreach ($marks as  $mark) {
      if ($mark->ca1 == null && $mark->ca2 == null && $mark->exam == null) {
        continue;
      } else {
        $mark->tca = $mark->ca1 + $mark->ca2;
        $mark->exam_total = $mark->ca1 + $mark->ca2 + $mark->exam;
        $mark->save();
      }
    }


    // subject ranking
    $studentMarks = Mark::where([
      'klase_id' => $klase_id, 'term_id' => $term_id,
      'session_id' => $session_id, 'section_id' => $section_id, 'workspace_id' => $workspaceId
    ])->get()->groupBy('subject_id')->map(function ($subject) {
      $rank = 0;
      $score = -1;

      return $subject->sortByDesc('exam_total')
        ->map(function ($record) use (&$rank, &$score) {

          if ($score != $record->getAttribute('exam_total')) {
            $score = $record->getAttribute('exam_total');
            $rank++;
          }
          $record->setAttribute('sub_position', $rank)->save();
          return $record->getAttributes();
        });
    });

    // total and avg score

    $stud = DB::table('marks')->where([
      'klase_id' => $klase_id, 'term_id' => $term_id,
      'session_id' => $session_id, 'section_id' => $section_id, 'workspace_id' => $workspaceId
    ])->get()->pluck('student_id')->unique();

    foreach ($stud as $num) {
      $stu =  Mark::where([
        'student_id' => $num, 'klase_id' => $klase_id, 'term_id' => $term_id,
        'session_id' => $session_id, 'section_id' => $section_id, 'workspace_id' => $workspaceId
      ])->get();

      // info($stu->avg('exam_total'));
      ExamRecord::where([
        'student_id' => $num, 'term_id' => $term_id, 'session_id' => $session_id,
        'workspace_id' => $workspaceId
      ])->update([
        'klase_id' => $klase_id,
        'student_id' => $num,
        'session_id' => $session_id,
        'section_id' => $section_id,
        'term_id' => $term_id,
        'total' => round($stu->sum('exam_total'), 0),
        'avg' => round($stu->avg('exam_total'), 0),
        'workspace_id' => $workspaceId
      ]);
    }

    // term term promotion

    if ($term_id == 3) {
      foreach ($stud as $num) {
        $cumTotal =  ExamRecord::where([
          'student_id' => $num, 'klase_id' => $klase_id,
          'session_id' => $session_id, 'section_id' => $section_id, 'workspace_id' => $workspaceId
        ])->get();

        ExamRecord::where([
          'student_id' => $num, 'term_id' => $term_id, 'session_id' => $session_id,
          'section_id' => $section_id, 'workspace_id' => $workspaceId
        ])->update([
          'cum_total' => round($cumTotal->sum('total', 0)),
          'cum_avg' => round($cumTotal->avg('total'), 0),
          'workspace_id' => $workspaceId
        ]);

        Student::where([
          'id' => $num, 'session_id' => $session_id, 'section_id' => $section_id,
          'workspace_id' => $workspaceId
        ])->update([
          'cum_avg' => $cumTotal->avg('total'),
          'status' => true,
          'promotion_term_id' => 3,
        ]);
        $setP = SetPromotion::where('workspace_Id', $args['workspaceId'])->first();
        ExamRecord::where([
          'student_id' => $num, 'term_id' => $term_id, 'session_id' => $session_id,
          'section_id' => $section_id, 'workspace_id' => $workspaceId
        ])->where('cum_avg', '>=', $setP->name)
          ->update([
            'ps' => 'Promoted'
          ]);
        ExamRecord::where([
          'student_id' => $num, 'term_id' => $term_id, 'session_id' => $session_id,
          'section_id' => $section_id, 'workspace_id' => $workspaceId
        ])->where('cum_avg', '<', $setP->name)
          ->update([
            'ps' => 'Failed'
          ]);
      }
    }

    // position ranking
    $studentM = ExamRecord::where([
      'klase_id' => $klase_id, 'term_id' => $term_id,
      'session_id' => $session_id,
      'section_id' => $section_id,
      'workspace_id' => $workspaceId
    ])->get()->groupBy('klase_id')->map(function ($subject) {
      $rank = 0;
      $score = -1;

      return $subject->sortByDesc('total')
        ->map(function ($record) use (&$rank, &$score) {

          if ($score != $record->getAttribute('total')) {
            $score = $record->getAttribute('total');
            $rank++;
          }
          $record->setAttribute('position', $rank)->save();
          return $record->getAttributes();
        });
    });

    // grade 
    // $grades = Grade::all();
    $grades = Grade::where('workspace_id', $workspaceId)->get();
    foreach ($grades as $grade) {
      Mark::where('workspace_id', $workspaceId)->where('exam_total', '>=',  $grade->mark_from)
        ->Where('exam_total', '<=',  $grade->mark_to)
        ->update([
          'grade_id' => $grade->id,
        ]);
    }
  }
}
