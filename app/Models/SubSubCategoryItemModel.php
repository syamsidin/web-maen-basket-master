<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategoryItemModel extends Model
{
    use HasFactory;

    protected $table = 'sub_sub_category_items';
    protected $guarded = [];  
    public $timestamps = false;

    public function sub_sub_category()
    {
        return $this->belongsTo(SubSubCategoryModel::class, 'sub_sub_category_id');
    }
}
