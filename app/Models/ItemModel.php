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

    public function category()
    {
        return $this->belongsTo(CategoryItemModel::class, 'category_id');
    }

    public function status()
    {
        return $this->belongsTo(StatusItemModel::class, 'current_status_id');
    }
}
