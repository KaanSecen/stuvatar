<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chest extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'price',
        'description',
        'is_available_for_sale'
    ];
}
