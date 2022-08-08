<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class);
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
    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
    public function accountants()
    {
        return $this->hasMany(Accountant::class);
    }
    public function libarians()
    {
        return $this->hasMany(Libarian::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function guardians()
    {
        return $this->hasMany(Guardian::class);
    }
    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
    public function examRecords()
    {
        return $this->hasMany(ExamRecord::class);
    }
    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }
    public function setPromotions()
    {
        return $this->hasMany(SetPromotion::class);
    }
    public function examTimetables()
    {
        return $this->hasMany(ExamTimetable::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function paymentRecords()
    {
        return $this->hasMany(PaymentRecord::class);
    }
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
