<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemChest extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'chest_id',
        'rarity',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function chest()
    {
        return $this->belongsTo(Chest::class, 'chest_id');
    }
}
