<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }
    public function klase()
    {
        return $this->belongsTo(Klase::class);
    }
}
