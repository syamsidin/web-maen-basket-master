<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepositoryModel extends Model
{
    use HasFactory;

    protected $table = 'repositories';
    protected $keyType = 'string';
    protected $guarded = [];  
    public $timestamps = false;

    public function floor()
    {
        return $this->belongsTo(FloorModel::class, 'floor_id');
    }

    public function items()
    {
        return $this->hasMany(ItemModel::class, 'current_repository_id');
    }

    public function repository_images()
    {
        return $this->hasMany(RepositoryImageModel::class, 'repository_id');
    }
}
