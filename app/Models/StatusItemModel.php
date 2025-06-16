<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusItemModel extends Model
{
    use HasFactory;

    protected $table = 'status_items';
    protected $guarded = [];  

    public function items()
    {
        return $this->hasMany(ItemModel::class, 'status_id');
    }
}
