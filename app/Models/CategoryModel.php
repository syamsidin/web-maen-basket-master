<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $guarded = [];  
    public $timestamps = false;

    public function field()
    {
        return $this->belongsTo(FieldModel::class, 'field_id');
    }

    public function sub_categories()
    {
        return $this->hasMany(SubCategoryModel::class, 'category_id');
    }
}
