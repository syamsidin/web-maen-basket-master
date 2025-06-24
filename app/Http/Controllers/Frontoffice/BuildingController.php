<?php

namespace App\Http\Controllers\Frontoffice;

use App\Http\Controllers\Controller;
use App\Models\BuildingModel;
use App\Models\FloorModel;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function show($id)
    {
        $items = FloorModel::where(['building_id' => $id, 'is_deleted' => 0])->get();

        $data = [
            "page_name" => "item",
            "data" => BuildingModel::find($id),
            "items" => $items,
            "path_image" => "/show-file/images/buildings/"
        ];

        return view('pages/frontoffice/building/detail', $data);
    }
}
