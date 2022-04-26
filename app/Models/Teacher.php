<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

      public function country()
    {
        return $this->belongsTo(Country::class);
    }
     public function state()
    {
        return $this->belongsTo(State::class);
    }
     public function city()
    {
        return $this->belongsTo(City::class);
    }
     public function blood_group()
    {
        return $this->belongsTo(BloodGroup::class);
    }
     public function klases()
    {
        return $this->belongsToMany(Klase::class);
    }
         public function user()
    {
        return $this->belongsTo(User::class);
    }
}
