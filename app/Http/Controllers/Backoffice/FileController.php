<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function show_file($file_type, $table_name, $id,  $name)
    {
        $storagePath = storage_path('app/public/uploads/'. $file_type .'/' . $table_name . '/' . $id . '/' . $name);
        return response()->file($storagePath);
    }
}
