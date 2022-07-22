<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notices()
    {
        return $this->hasMany(Notice::class);
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
    public function klases()
    {
        return $this->hasMany(Klase::class);
    }
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
    public function sections()
    {
        return $this->hasMany(Section::class);
    }
    public function timetables()
    {
        return $this->hasMany(Timetable::class);
    }
}
