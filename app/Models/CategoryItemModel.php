<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryItemModel extends Model
{
    use HasFactory;

    protected $table = 'category_items';
    protected $guarded = [];  
    public $timestamps = false;

    public function items()
    {
        return $this->hasMany(ItemModel::class, 'category_id');
    }
}
