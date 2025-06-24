<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemImageModel extends Model
{
    use HasFactory;

    protected $table = 'item_images';
    protected $keyType = 'string';
    protected $guarded = [];  

    public function item()
    {
        return $this->belongsTo(ItemModel::class, 'item_id');
    }
}
