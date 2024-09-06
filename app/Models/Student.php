<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'grade_level',
    ];

    public function tutors(){
        return $this->belongsToMany(Tutor::class);
    }
}
