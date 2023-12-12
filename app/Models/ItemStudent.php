<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'item_id',
        'is_active',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
