<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [


    ];
    public function doctor()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
