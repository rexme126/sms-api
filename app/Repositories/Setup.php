<?php

namespace App\Repositories;

use App\Models\Student;
use App\Models\Subject;

class Setup
{
    public function getSubjectsByIDs($ids)
    {
        return Subject::whereIn('id', $ids)->orderBy('subject')->get();
    }

    public function getStudentsByIds($ids)
    {
        return Student::whereIn('id', $ids)->orderBy('last_name')->get();
    }
}
