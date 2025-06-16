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

    public function items()
    {
        return $this->hasMany(ItemModel::class, 'current_repository_id');
    }
}
