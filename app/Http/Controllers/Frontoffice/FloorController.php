<?php

namespace App\Http\Controllers\Frontoffice;

use App\Http\Controllers\Controller;
use App\Models\FloorModel;
use App\Models\RepositoryModel;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    public function show($id)
    {
        $items = RepositoryModel::where(['floor_id' => $id, 'is_deleted' => 0])->get();

        $data = [
            "page_name" => "item",
            "data" => FloorModel::find($id),
            "items" => $items,
            "path_image" => "/show-file/images/floors/"
        ];

        return view('pages/frontoffice/floor/detail', $data);
    }
}
