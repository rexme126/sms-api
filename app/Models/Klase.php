<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klase extends Model
{
    use HasFactory;

    protected $guarded= [];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
