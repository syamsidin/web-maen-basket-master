<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemModel extends Model
{
    use HasFactory;

    protected $table = 'items';
    protected $keyType = 'string';
    protected $guarded = [];  

    public function repository()
    {
        return $this->belongsTo(RepositoryModel::class, 'current_repository_id');
    }

    public function sub_sub_category_item()
    {
        return $this->belongsTo(SubSubCategoryItemModel::class, 'sub_sub_category_item_id');
    }

    public function item_images()
    {
        return $this->hasMany(ItemImageModel::class, 'item_id');
    }

    public function item_origin()
    {
        return $this->belongsTo(ItemOriginModel::class, 'item_origin_id');
    }

    public function item_condition()
    {
        return $this->belongsTo(ItemConditionModel::class, 'item_condition_id');
    }

    public function item_unit()
    {
        return $this->belongsTo(ItemUnitModel::class, 'item_unit_id');
    }

    public function category()
    {
        return $this->belongsTo(CategoryItemModel::class, 'category_id');
    }

    public function status()
    {
        return $this->belongsTo(StatusItemModel::class, 'current_status_id');
    }
}
