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

    //TODO Check if this is needed later on (since its unused
    public function students()
    {
        return $this->hasMany(Student::class, 'grade_id');
    }
}
