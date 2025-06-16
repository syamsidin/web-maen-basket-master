<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepositoryItemModel extends Model
{
    use HasFactory;

    protected $table = 'history_repository_items';
    protected $guarded = [];  

    public function repository()
    {
        return $this->belongsTo(RepositoryModel::class, 'repository_id');
    }

    public function item()
    {
        return $this->belongsTo(ItemModel::class, 'item_id');
    }
}
