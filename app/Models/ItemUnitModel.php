<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemUnitModel extends Model
{
    use HasFactory;

    protected $table = 'item_units';
    protected $guarded = [];  
    public $timestamps = false;

    public function items()
    {
        return $this->hasMany(ItemModel::class, 'item_unit_id');
    }
}
