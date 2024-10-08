<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;

    protected $fillable = [
        'avatar',
        'name',
        'email',
        'hourly_rate',
        'bio',
        'subjects',
    ];

    protected $casts = [
        'subjects' => 'array',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
