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

        Session::where('workspace_id', $workspace->id)->delete();
        Term::where('workspace_id', $workspace->id)->delete();
        Klase::where('workspace_id', $workspace->id)->delete();
        Subject::where('workspace_id', $workspace->id)->delete();
        Notice::where('workspace_id', $workspace->id)->delete();
        Event::where('workspace_id', $workspace->id)->delete();
        Timetable::where('workspace_id', $workspace->id)->delete();
        ExamTimetable::where('workspace_id', $workspace->id)->delete();
        Grade::where('workspace_id', $workspace->id)->delete();
        Mark::where('workspace_id', $workspace->id)->delete();
        Result::where('workspace_id', $workspace->id)->delete();
        // Notification::where('workspace_id', $workspace)->get()->delete();
        ExamRecord::where('workspace_id', $workspace->id)->delete();
        SetPromotion::where('workspace_id', $workspace->id)->delete();
        Promotion::where('workspace_id', $workspace->id)->delete();
        Payment::where('workspace_id', $workspace->id)->delete();
        PaymentRecord::where('workspace_id', $workspace->id)->delete();
        Section::where('workspace_id', $workspace->id)->delete();
        Package::where('workspace_id', $workspace->id)->delete();

        // users

        $teachers = Teacher::where('workspace_id', $workspace->id)->get();
        foreach ($teachers as $teacher) {
            $teacher->removeRole(4);
            $teacher->delete();
        }
        $students = Student::where('workspace_id', $workspace->id)->get();
        foreach ($students as $student) {
            $student->removeRole(7);
            $student->delete();
        }
        $accountants = Accountant::where('workspace_id', $workspace->id)->get();
        foreach ($accountants as $accountant) {
            $accountant->removeRole(5);
            $accountant->delete();
        }

        $guardians = Guardian::where('workspace_id', $workspace->id)->get();
        foreach ($guardians as $guardian) {
            $guardian->removeRole(8);
            $guardian->delete();
        }

        $user = User::where('email', $workspace->email)->first();
        Storage::delete('public/' . $args['workspaceId']);
        $user->removeRole(2);
        User::where('workspace_id', $workspace->id)->delete();

        return $workspace->delete();
    }
}
