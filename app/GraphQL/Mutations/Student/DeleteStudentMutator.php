<?php

namespace App\GraphQL\Mutations\Student;

use App\Models\ExamRecord;
use App\Models\User;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\Mark;
use App\Models\PaymentRecord;
use App\Models\Promotion;
use App\Models\Result;
use Illuminate\Support\Facades\Storage;

final class DeleteStudentMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $userId = Student::find($args['id']);
        $guardian = Guardian::where('email', $userId->guardian_email)->first();

        Storage::delete('public/' . $args['workspaceId'] . '/students' . '/' . $userId->photo);
        $id = $userId->user_id;
        $gUserId = User::find($guardian->user_id);
        $gUserId->removeRole(8);
        $gUserId->delete();
        $StudentUser = User::find($id);
        $StudentUser->removerole(7);
        $StudentUser->delete();
        $guardian->delete();
       // return Student::find($args['id'])->delete();
       $student = Student::find($args['id']);
       ExamRecord::where('student_id', $student->id)->delete();
       Mark::where('student_id', $student->id)->delete();
       PaymentRecord::where('student_id', $student->id)->delete();
       Promotion::where('student_id', $student->id)->delete();
       Result::where('student_id', $student->id)->delete();
       return $student->delete();
    }
}
