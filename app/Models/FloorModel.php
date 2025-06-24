<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FloorModel extends Model
{
    use HasFactory;

    protected $table = 'floors';
    protected $guarded = [];  
    public $timestamps = false;

    public function building()
    {
        return $this->belongsTo(BuildingModel::class, 'building_id');
    }

    public function repositories()
    {
        return $this->hasMany(RepositoryModel::class, 'floor_id');
    }

    public function floor_images()
    {
        return $this->hasMany(FloorImageModel::class, 'floor_id');
    }
}
