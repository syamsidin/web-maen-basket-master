<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategoryModel extends Model
{
    use HasFactory;

    protected $table = 'sub_sub_categories';
    protected $guarded = [];  
    public $timestamps = false;

    public function sub_category()
    {
        return $this->belongsTo(SubCategoryModel::class, 'sub_category_id');
    }

    public function sub_sub_category_items()
    {
        return $this->hasMany(SubSubCategoryItemModel::class, 'sub_sub_category_id');
    }
}
