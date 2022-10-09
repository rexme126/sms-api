<?php

namespace App\GraphQL\Mutations\Workspace;

use App\Models\Accountant;
use App\Models\Event;
use App\Models\ExamRecord;
use App\Models\ExamTimetable;
use App\Models\Grade;
use App\Models\Guardian;
use App\Models\Klase;
use App\Models\Mark;
use App\Models\Notice;
use App\Models\Notification;
use App\Models\Package;
use App\Models\Payment;
use App\Models\PaymentRecord;
use App\Models\Promotion;
use App\Models\Result;
use App\Models\SchoolAdmin;
use App\Models\Section;
use App\Models\Session;
use App\Models\SetPromotion;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Term;
use App\Models\Timetable;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Support\Facades\Storage;

final class DeleteSchoolWorkspace
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        //notification
        $users = User::where('workspace_id', $workspace->id)->get();

        foreach ($users as $user) {
            Notification::where('notifiable_id', $user->id)->delete();
        }
       

        Session::where('workspace_id', $workspace->id)->delete();
        Klase::where('workspace_id', $workspace->id)->delete();
        Subject::where('workspace_id', $workspace->id)->delete();
        Notice::where('workspace_id', $workspace->id)->delete();
        Event::where('workspace_id', $workspace->id)->delete();
        Timetable::where('workspace_id', $workspace->id)->delete();
        ExamTimetable::where('workspace_id', $workspace->id)->delete();
        Grade::where('workspace_id', $workspace->id)->delete();
        Mark::where('workspace_id', $workspace->id)->delete();
        Result::where('workspace_id', $workspace->id)->delete();
        ExamRecord::where('workspace_id', $workspace->id)->delete();
        SetPromotion::where('workspace_id', $workspace->id)->delete();
        Promotion::where('workspace_id', $workspace->id)->delete();
        Payment::where('workspace_id', $workspace->id)->delete();
        PaymentRecord::where('workspace_id', $workspace->id)->delete();
        Section::where('workspace_id', $workspace->id)->delete();
        Session::where('workspace_id', $workspace->id)->delete();

        // users

        $teachers = Teacher::where('workspace_id', $workspace->id)->get();
        foreach ($teachers as $teacher) {

            $user = User::where('id', $teacher->user_id)->first();
            $user->removeRole('teacher');
            $teacher->delete();
        }
      

        $students = Student::where('workspace_id', $workspace->id)->get();
        foreach ($students as $student) {
            $user = User::where('id', $student->user_id)->first();
            $user->removeRole('student');
            $student->delete();
        }

        $accountants = Accountant::where('workspace_id', $workspace->id)->get();
        foreach ($accountants as $accountant) {
            $user = User::where('id', $accountant->user_id)->first();
            $user->removeRole('accountant');
            $accountant->delete();
        }

        $guardians = Guardian::where('workspace_id', $workspace->id)->get();
        foreach ($guardians as $guardian) {
            $user = User::where('id', $guardian->user_id)->first();
            $user->removeRole('guardian');
            $guardian->delete();
        }
        

        $schoolAdmin = SchoolAdmin::where('workspace_id', $workspace->id)->first();
        $userAdmin = User::where('id', $schoolAdmin->user_id)->first();
        $userAdmin->removeRole('admin');
        $schoolAdmin->delete();

        $user = User::where('email', $workspace->email)->first();
        Storage::delete('public/' . $args['workspaceId']);
        $user->removeRole('main admin');
        User::where('workspace_id', $workspace->id)->delete();

        return $workspace->delete();
    }
}
