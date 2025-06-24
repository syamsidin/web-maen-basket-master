<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepositoryImageModel extends Model
{
    use HasFactory;

    protected $table = 'repository_images';
    protected $keyType = 'string';
    protected $guarded = [];  

    public function repository()
    {
        return $this->belongsTo(RepositoryModel::class, 'repository_id');
    }
}
