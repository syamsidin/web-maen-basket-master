<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoryModel extends Model
{
    use HasFactory;

    protected $table = 'sub_categories';
    protected $guarded = [];  
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }

    public function sub_sub_categories()
    {
        return $this->hasMany(SubSubCategoryModel::class, 'sub_category_id');
    }
}
