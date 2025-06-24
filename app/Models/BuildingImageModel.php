<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingImageModel extends Model
{
    use HasFactory;

    protected $table = 'building_images';
    protected $keyType = 'string';
    protected $guarded = [];  

    public function building()
    {
        return $this->belongsTo(BuildingModel::class, 'building_id');
    }
}
