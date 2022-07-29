<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    protected $guarded= [];

     public function getExamTotalAttribute()
      {
        return $this->ca1 + $this->ca2 + $this->exam;
      }

    public function klase()
    {
        return $this->belongsTo(Klase::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
