<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded= [];

    public function term()
    {
        return $this->belongsTo(Term::class);
    }
    public function session()
    {
        return $this->belongsTo(Session::class);
    }
    public function klase()
    {
        return $this->belongsTo(Klase::class);
    }
}
