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

    public function grade(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function student(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Student::class, 'grade_id');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }
}
