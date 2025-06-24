<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemOriginModel extends Model
{
    use HasFactory;

    protected $table = 'item_origins';
    protected $guarded = [];  
    public $timestamps = false;

    public function items()
    {
        return $this->hasMany(ItemModel::class, 'item_origin_id');
    }
}
