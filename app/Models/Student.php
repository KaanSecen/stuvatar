<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'grade_id',
        'card',
        'points'
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
}
