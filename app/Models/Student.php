<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded= [];
 
    public function klase()
    {
        return $this->belongsTo(Klase::class);
    }
    public function guardian()
    {
        return $this->belongsTo(Guardian::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function term()
    {
        return $this->belongsTo(Term::class);
    }
     public function session()
    {
        return $this->belongsTo(Session::class);
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

}
