<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingModel extends Model
{
    use HasFactory;

    protected $table = 'buildings';
    protected $guarded = [];  
    public $timestamps = false;

    public function floors()
    {
        return $this->hasMany(FloorModel::class, 'building_id');
    }

    public function building_images()
    {
        return $this->hasMany(BuildingImageModel::class, 'building_id');
    }
}
