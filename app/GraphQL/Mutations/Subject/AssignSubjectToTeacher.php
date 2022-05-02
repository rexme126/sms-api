<?php

namespace App\GraphQL\Mutations\Subject;

use App\Models\Klase;
use App\Models\Subject;
use App\Models\Teacher;

final class AssignSubjectToTeacher
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {

        //  assign Teacher
        if(isset($args['teacher'])){
            $teacherId = $args['teacher'];
            $subjects = $args['subjects'];
            $teacher = Teacher::where('id', $teacherId)->first();
            $teacher->subjects()->syncWithoutDetaching($subjects);
           
        }
      
        if(isset($args['id'])){
            $id= $args['id'];
             $subject = Subject::where('id', $id)->first();
            $deleteSubjectsTeacher = $subject->teachers;
            info($deleteSubjectsTeacher);
             foreach ($deleteSubjectsTeacher as $key => $value) {
                 $subject->teachers()->toggle($value->id);
             }
             $subject->delete();
        }
    }
}
