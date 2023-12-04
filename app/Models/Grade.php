<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'color',
        'grade_number'
    ];

    public function grade()
    {
        return $this->hasMany(Student::class, 'grade_id');
    }

    // Used for getting all students data from 1 class
    public function students()
    {
        return $this->hasMany(Student::class, 'grade_id');
    }
}
