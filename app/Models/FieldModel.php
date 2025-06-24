<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldModel extends Model
{
    use HasFactory;

    protected $table = 'fields';
    protected $guarded = [];  
    public $timestamps = false;

    public function categories()
    {
        return $this->hasMany(CategoryModel::class, 'field_id');
    }
}
