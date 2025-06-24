<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FloorImageModel extends Model
{
    use HasFactory;

    protected $table = 'floor_images';
    protected $keyType = 'string';
    protected $guarded = [];  

    public function floor()
    {
        return $this->belongsTo(FloorModel::class, 'floor_id');
    }
}
