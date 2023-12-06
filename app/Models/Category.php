<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug'
    ];

    public function item()
    {
        return $this->hasMany(Item::class, 'category_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'category_id');
    }

}
