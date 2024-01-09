<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChestStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'chest_id',
        'student_id',
        'used',
    ];

    public function chest()
    {
        return $this->belongsTo(Chest::class, 'chest_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
